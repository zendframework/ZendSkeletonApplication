require 'spec_helper'
describe 'mysql::config' do

  let :constant_parameter_defaults do
    {
     :root_password                   => 'UNSET',
     :old_root_password               => '',
     :max_connections                 => '151',
     :bind_address                    => '127.0.0.1',
     :port                            => '3306',
     :etc_root_password               => false,
     :datadir                         => '/var/lib/mysql',
     :default_engine                  => 'UNSET',
     :ssl                             => false,
     :key_buffer                      => '16M',
     :max_allowed_packet              => '16M',
     :thread_stack                    => '256K',
     :thread_cache_size               => 8,
     :myisam_recover                  => 'BACKUP',
     :query_cache_limit               => '1M',
     :query_cache_size                => '16M',
     :max_binlog_size                 => '100M',
     :expire_logs_days                => 10,
     :character_set                   => 'UNSET',
     :tmp_table_size                  => 'UNSET',
     :max_heap_table_size             => 'UNSET',
     :table_open_cache                => 'UNSET',
     :long_query_time                 => 'UNSET',
     :server_id                       => 'UNSET',
     :sql_log_bin                     => 'UNSET',
     :log_bin                         => 'UNSET',
     :binlog_do_db                    => 'UNSET',
     :log_bin_trust_function_creators => 'UNSET',
     :replicate_ignore_table          => 'UNSET',
     :replicate_wild_do_table         => 'UNSET',
     :replicate_wild_ignore_table     => 'UNSET',
     :ft_min_word_len                 => 'UNSET',
     :ft_max_word_len                 => 'UNSET'
    }
  end

  describe 'with osfamily specific defaults' do
    {
      'Debian' => {
         :datadir         => '/var/lib/mysql',
         :service_name    => 'mysql',
         :config_file     => '/etc/mysql/my.cnf',
         :socket          => '/var/run/mysqld/mysqld.sock',
         :pidfile         => '/var/run/mysqld/mysqld.pid',
         :root_group      => 'root',
         :ssl_ca          => '/etc/mysql/cacert.pem',
         :ssl_cert        => '/etc/mysql/server-cert.pem',
         :ssl_key         => '/etc/mysql/server-key.pem'
      },
      'FreeBSD' => {
         :datadir         => '/var/db/mysql',
         :service_name    => 'mysql-server',
         :config_file     => '/var/db/mysql/my.cnf',
         :socket          => '/tmp/mysql.sock',
         :pidfile         => '/var/db/mysql/mysql.pid',
         :root_group      => 'wheel'
      },
      'RedHat' => {
         :datadir         => '/var/lib/mysql',
         :service_name    => 'mysqld',
         :config_file     => '/etc/my.cnf',
         :socket          => '/var/lib/mysql/mysql.sock',
         :pidfile         => '/var/run/mysqld/mysqld.pid',
         :root_group      => 'root',
         :ssl_ca          => '/etc/mysql/cacert.pem',
         :ssl_cert        => '/etc/mysql/server-cert.pem',
         :ssl_key         => '/etc/mysql/server-key.pem'
      }
    }.each do |osfamily, osparams|


      describe "when osfamily is #{osfamily}" do

        let :facts do
          {:osfamily => osfamily, :root_home => '/root'}
        end

        describe 'when config file should be managed' do
          let :params do
            {:manage_config_file => true}
          end

          it { should contain_file(osparams[:config_file]) }
        end

        describe 'when config file should not be managed' do
          let :params do
            {:manage_config_file => false}
          end

          it { should_not contain_file(osparams[:config_file]) }
        end

        describe 'when root password is set' do

          let :params do
           {:root_password => 'foo'}
          end

          it { should contain_exec('set_mysql_rootpw').with(
            'command'   => 'mysqladmin -u root  password \'foo\'',
            'logoutput' => true,
            'unless'    => "mysqladmin -u root -p\'foo\' status > /dev/null",
            'path'      => '/usr/local/sbin:/usr/bin:/usr/local/bin'
          )}

          it { should contain_file('/root/.my.cnf').with(
            'content' => "[client]\nuser=root\nhost=localhost\npassword='foo'\n",
            'require' => 'Exec[set_mysql_rootpw]'
          )}

        end

        describe 'when root password and old password are set' do
          let :params do
           {:root_password => 'foo', :old_root_password => 'bar'}
          end

          it { should contain_exec('set_mysql_rootpw').with(
            'command'   => 'mysqladmin -u root -p\'bar\' password \'foo\'',
            'logoutput' => true,
            'unless'    => "mysqladmin -u root -p\'foo\' status > /dev/null",
            'path'      => '/usr/local/sbin:/usr/bin:/usr/local/bin'
          )}

        end

        [
          {},
          {
            :service_name         => 'dans_service',
            :config_file          => '/home/dan/mysql.conf',
            :pidfile              => '/home/dan/mysql.pid',
            :socket               => '/home/dan/mysql.sock',
            :bind_address         => '0.0.0.0',
            :port                 => '3306',
            :datadir              => '/path/to/datadir',
            :default_engine       => 'InnoDB',
            :ssl                  => true,
            :ssl_ca               => '/path/to/cacert.pem',
            :ssl_cert             => '/path/to/server-cert.pem',
            :ssl_key              => '/path/to/server-key.pem',
            :key_buffer           => '16M',
            :max_allowed_packet   => '32M',
            :thread_stack         => '256K',
            :query_cache_size     => '16M',
            :character_set        => 'utf8',
            :max_connections      => 1000,
            :tmp_table_size       => '4096M',
            :max_heap_table_size  => '4096M',
            :table_open_cache     => 2048,
            :long_query_time      => 0.5,
            :ft_min_word_len      => 3,
            :ft_max_word_len      => 10
          }
        ].each do |passed_params|

          describe "with #{passed_params == {} ? 'default' : 'specified'} parameters" do

            let :parameter_defaults do
              constant_parameter_defaults.merge(osparams)
            end

            let :params do
              passed_params
            end

            let :param_values do
              parameter_defaults.merge(params)
            end

            it { should contain_exec('mysqld-restart').with(
              :refreshonly => true,
              :path        => '/sbin/:/usr/sbin/:/usr/bin/:/bin/',
              :command     => "service #{param_values[:service_name]} restart"
            )}

            it { should_not contain_exec('set_mysql_rootpw') }

            it { should contain_file('/root/.my.cnf')}

            it { should contain_file('/etc/mysql').with(
              'owner'  => 'root',
              'group'  => param_values[:root_group],
              'notify' => 'Exec[mysqld-restart]',
              'ensure' => 'directory',
              'mode'   => '0755'
            )}
            it { should contain_file('/etc/mysql/conf.d').with(
              'owner'  => 'root',
              'group'  => param_values[:root_group],
              'notify' => 'Exec[mysqld-restart]',
              'ensure' => 'directory',
              'mode'   => '0755'
            )}
            it { should contain_file(param_values[:config_file]).with(
              'owner'  => 'root',
              'group'  => param_values[:root_group],
              'notify' => 'Exec[mysqld-restart]',
              'mode'   => '0644'
            )}
            it 'should have a template with the correct contents' do
              content = param_value(subject, 'file', param_values[:config_file], 'content')
              expected_lines = [
                "port      = #{param_values[:port]}",
                "socket    = #{param_values[:socket]}",
                "pid-file  = #{param_values[:pidfile]}",
                "datadir   = #{param_values[:datadir]}",
                "max_connections = #{param_values[:max_connections]}",
                "bind-address        = #{param_values[:bind_address]}",
                "key_buffer          = #{param_values[:key_buffer]}",
                "max_allowed_packet  = #{param_values[:max_allowed_packet]}",
                "thread_stack        = #{param_values[:thread_stack]}",
                "thread_cache_size   = #{param_values[:thread_cache_size]}",
                "myisam-recover      = #{param_values[:myisam_recover]}",
                "query_cache_limit   = #{param_values[:query_cache_limit]}",
                "query_cache_size    = #{param_values[:query_cache_size]}",
                "expire_logs_days    = #{param_values[:expire_logs_days]}",
                "max_binlog_size     = #{param_values[:max_binlog_size]}"
              ]
              if param_values[:tmp_table_size] != 'UNSET'
                expected_lines = expected_lines | [ "tmp_table_size      = #{param_values[:tmp_table_size]}" ]
              end
              if param_values[:max_heap_table_size] != 'UNSET'
                expected_lines = expected_lines | [ "max_heap_table_size = #{param_values[:max_heap_table_size]}" ]
              end
              if param_values[:table_open_cache] != 'UNSET'
                expected_lines = expected_lines | [ "table_open_cache    = #{param_values[:table_open_cache]}" ]
              end
              if param_values[:long_query_time] != 'UNSET'
                expected_lines = expected_lines | [ "long_query_time     = #{param_values[:long_query_time]}" ]
              end
              if param_values[:ft_min_word_len] != 'UNSET'
                expected_lines = expected_lines | [ "ft_min_word_len = #{param_values[:ft_min_word_len]}" ]
              end
              if param_values[:ft_max_word_len] != 'UNSET'
                expected_lines = expected_lines | [ "ft_max_word_len = #{param_values[:ft_max_word_len]}" ]
              end
              if param_values[:default_engine] != 'UNSET'
                expected_lines = expected_lines | [ "default-storage-engine = #{param_values[:default_engine]}" ]
              else
                content.should_not match(/^default-storage-engine = /)
              end
              if param_values[:character_set] != 'UNSET'
                expected_lines = expected_lines | [ "character-set-server   = #{param_values[:character_set]}" ]
              end
              if param_values[:sql_log_bin] != 'UNSET'
                expected_lines = expected_lines | [ "sql_log_bin         = #{param_values[:sql_log_bin]}" ]
              end
              if param_values[:log_bin] != 'UNSET'
                expected_lines = expected_lines | [ "log-bin             = #{param_values[:log_bin]}" ]
              end
              if param_values[:binlog_do_db] != 'UNSET'
                expected_lines = expected_lines | [ "binlog-do-db        = #{param_values[:binlog_do_db]}" ]
              end
              if param_values[:log_bin_trust_function_creators] != 'UNSET'
                expected_lines = expected_lines | [ "log_bin_trust_function_creators = #{param_values[:log_bin_trust_function_creators]}" ]
              end
              if param_values[:replicate_ignore_table] != 'UNSET'
                expected_lines = expected_lines | [ "replicate-ignore-table          = #{param_values[:replicate_ignore_table]}" ]
              end
              if param_values[:replicate_wild_do_table] != 'UNSET'
                expected_lines = expected_lines | [ "replicate-wild-do-table         = #{param_values[:replicate_wild_do_table]}" ]
              end
              if param_values[:replicate_wild_ignore_table] != 'UNSET'
                expected_lines = expected_lines | [ "replicate-wild-ignore-table     = #{param_values[:replicate_wild_ignore_table]}" ]
              end
              if param_values[:ssl]
                expected_lines = expected_lines |
                  [
                    "ssl-ca    = #{param_values[:ssl_ca]}",
                    "ssl-cert  = #{param_values[:ssl_cert]}",
                    "ssl-key   = #{param_values[:ssl_key]}"
                  ]
              end
              (content.split("\n") & expected_lines).should == expected_lines
            end
          end
        end
      end
    end
  end

  describe 'when etc_root_password is set with password' do

    let :facts do
      {:osfamily => 'Debian', :root_home => '/root'}
    end

    let :params do
     {:root_password => 'foo', :old_root_password => 'bar', :etc_root_password => true}
    end

    it { should contain_exec('set_mysql_rootpw').with(
      'command'   => 'mysqladmin -u root -p\'bar\' password \'foo\'',
      'logoutput' => true,
      'unless'    => "mysqladmin -u root -p\'foo\' status > /dev/null",
      'path'      => '/usr/local/sbin:/usr/bin:/usr/local/bin'
    )}

    it { should contain_file('/root/.my.cnf').with(
      'content' => "[client]\nuser=root\nhost=localhost\npassword='foo'\n",
      'require' => 'Exec[set_mysql_rootpw]'
    )}

  end

  describe 'setting etc_root_password should fail on redhat' do
    let :facts do
      {:osfamily => 'RedHat', :root_home => '/root'}
    end

    let :params do
     {:root_password => 'foo', :old_root_password => 'bar', :etc_root_password => true}
    end

    it 'should fail' do
      expect { subject }.to raise_error(Puppet::Error, /Duplicate (declaration|definition)/)
    end

  end

  describe 'unset ssl params should fail when ssl is true on freebsd' do
    let :facts do
     {:osfamily => 'FreeBSD', :root_home => '/root'}
    end

    let :params do
     { :ssl => true }
    end

    it 'should fail' do
      expect { subject }.to raise_error(Puppet::Error, /required when ssl is true/)
    end

  end

end
