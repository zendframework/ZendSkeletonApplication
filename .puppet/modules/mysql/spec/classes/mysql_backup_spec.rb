require 'spec_helper'

describe 'mysql::backup' do

  let(:default_params) {
    { 'backupuser'         => 'testuser',
      'backuppassword'     => 'testpass',
      'backupdir'          => '/tmp',
      'backuprotate'       => '25',
      'delete_before_dump' => true,
    }
  }
  context 'standard conditions' do
    let(:params) { default_params }

    it { should contain_database_user('testuser@localhost')}

    it { should contain_database_grant('testuser@localhost').with(
      :privileges => %w(Select_priv Reload_priv Lock_tables_priv Show_view_priv)
    )}

    it { should contain_cron('mysql-backup').with(
      :command => '/usr/local/sbin/mysqlbackup.sh',
      :ensure  => 'present'
    )}

    it { should contain_file('mysqlbackup.sh').with(
      :path   => '/usr/local/sbin/mysqlbackup.sh',
      :ensure => 'present'
    ) }

    it { should contain_file('mysqlbackupdir').with(
      :path   => '/tmp',
      :ensure => 'directory'
    )}

    it 'should have compression by default' do
      verify_contents(subject, 'mysqlbackup.sh', [
        ' --all-databases | bzcat -zc > ${DIR}/${PREFIX}`date +%Y%m%d-%H%M%S`.sql.bz2',
      ])
    end

    it 'should have 25 days of rotation' do
      # MySQL counts from 0 I guess.
      should contain_file('mysqlbackup.sh').with_content(/.*ROTATE=24.*/)
    end
  end

  context 'with compression disabled' do
    let(:params) do
      { :backupcompress => false }.merge(default_params)
    end

    it { should contain_file('mysqlbackup.sh').with(
      :path   => '/usr/local/sbin/mysqlbackup.sh',
      :ensure => 'present'
    ) }

    it 'should be able to disable compression' do
      verify_contents(subject, 'mysqlbackup.sh', [
        ' --all-databases > ${DIR}/${PREFIX}`date +%Y%m%d-%H%M%S`.sql',
      ])
    end
  end
end
