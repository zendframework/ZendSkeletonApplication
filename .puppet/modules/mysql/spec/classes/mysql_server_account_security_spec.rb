require 'spec_helper'

describe 'mysql::server::account_security' do

  let :facts do {
    :fqdn     => 'myhost.mydomain',
    :hostname => 'myhost',
    :root_home => '/root'
  }
  end

  it 'should remove Database_User[root@myhost.mydomain]' do
    should contain_database_user('root@myhost.mydomain').with_ensure('absent')
  end
  it 'should remove Database_User[root@myhost]' do
    should contain_database_user('root@myhost').with_ensure('absent')
  end
  it 'should remove Database_User[root@127.0.0.1]' do
    should contain_database_user('root@127.0.0.1').with_ensure('absent')
  end
  it 'should remove Database_User[root@::1]' do
    should contain_database_user('root@::1').with_ensure('absent')
  end
  it 'should remove Database_User[@myhost.mydomain]' do
    should contain_database_user('@myhost.mydomain').with_ensure('absent')
  end
  it 'should remove Database_User[@myhost]' do
    should contain_database_user('@myhost').with_ensure('absent')
  end
  it 'should remove Database_User[@localhost]' do
    should contain_database_user('@localhost').with_ensure('absent')
  end
  it 'should remove Database_User[@%]' do
    should contain_database_user('@%').with_ensure('absent')
  end

  it 'should remove Database[test]' do
    should contain_database('test').with_ensure('absent')
  end

end
