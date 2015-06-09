require 'spec_helper'

describe 'mysql::server::config', :type => :define do
  filename = '/etc/mysql/conf.d/test_config.cnf'

  let :facts do
    { :osfamily => 'Debian', :root_home => '/root'}
  end

  let(:title) { File.basename(filename, '.cnf') }

  let(:params) {
    { 'settings' => {
        'mysqld' => {
          'bind-address' => '0.0.0.0'
        }
      }
    }
  }

  it 'should notify the mysql daemon' do
    should contain_file(filename).with_notify('Exec[mysqld-restart]')
  end

  it 'should contain config parameter in content' do
    should contain_file(filename).with_content("### MANAGED BY PUPPET ###\n[mysqld]\nbind-address = 0.0.0.0\n\n")
  end

  it 'should not notify the mysql daemon' do
    params.merge!({ 'notify_service' => false })
    should contain_file(filename).without_notify
  end

  it 'should require on the mysql-server package' do
    should contain_file(filename).with_require('Package[mysql-server]')
  end
end
