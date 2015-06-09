require 'spec_helper'

describe 'mysql::php' do

  describe 'on a debian based os' do
    let :facts do
      { :osfamily => 'Debian', :root_home => '/root'}
    end
    it { should contain_package('php-mysql').with(
      :name   => 'php5-mysql',
      :ensure => 'present'
    )}
  end

  describe 'on a freebsd based os' do
    let :facts do
      { :osfamily => 'FreeBSD', :root_home => '/root'}
    end
    it { should contain_package('php-mysql').with(
      :name   => 'php5-mysql',
      :ensure => 'present'
    )}
  end

  describe 'on a redhat based os' do
    let :facts do
      {:osfamily => 'Redhat', :root_home => '/root'}
    end
    it { should contain_package('php-mysql').with(
      :name   => 'php-mysql',
      :ensure => 'present'
    )}
    describe 'when parameters are supplied' do
      let :params do
        {:package_ensure => 'latest', :package_name => 'php53-mysql'}
      end
      it { should contain_package('php-mysql').with(
        :name   => 'php53-mysql',
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
