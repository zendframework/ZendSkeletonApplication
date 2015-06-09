require 'spec_helper'
describe 'mysql::server::monitor' do
  let :facts do
    { :osfamily => 'Debian', :root_home => '/root' }
  end
  let :pre_condition do
    "include 'mysql::server'"
  end
  let :params do
    {
      :mysql_monitor_username => 'monitoruser',
      :mysql_monitor_password => 'monitorpass',
      :mysql_monitor_hostname => 'monitorhost'
    }
  end

  it { should contain_database_user('monitoruser@monitorhost')}
end
