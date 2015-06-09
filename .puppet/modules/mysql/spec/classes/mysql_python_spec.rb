require 'spec_helper'

describe 'mysql::python' do

  describe 'on a debian based os' do
    let :facts do
      { :osfamily => 'Debian', :root_home => '/root'}
    end
    it { should contain_package('python-mysqldb').with(
      :name   => 'python-mysqldb',
      :ensure => 'present'
    )}
  end

  describe 'on a freebsd based os' do
    let :facts do
      { :osfamily => 'FreeBSD', :root_home => '/root'}
    end
    it { should contain_package('python-mysqldb').with(
      :name   => 'databases/py-MySQLdb',
      :ensure => 'present'
    )}
  end

  describe 'on a redhat based os' do
    let :facts do
      {:osfamily => 'RedHat', :root_home => '/root'}
    end
    it { should contain_package('python-mysqldb').with(
      :name   => 'MySQL-python',
      :ensure => 'present'
    )}
    describe 'when parameters are supplied' do
      let :params do
        {:package_ensure => 'latest', :package_name => 'python-mysql'}
      end
      it { should contain_package('python-mysqldb').with(
        :name   => 'python-mysql',
        :ensure => 'latest'
      )}
    end
  end

  describe 'on any other os' do
    let :facts do
      {:osfamily => 'foo', :root_home => '/root'}
    end

    it 'should fail' do
      expect { subject }.to raise_error(/Unsupported osfamily: foo/)
    end
  end

end
