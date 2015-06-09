require 'spec_helper'

describe 'mysql::ruby' do

  describe 'on a debian based os' do
    let :facts do
      { :osfamily => 'Debian', :root_home => '/root'}
    end
    it { should contain_package('ruby_mysql').with(
      :name     => 'libmysql-ruby',
      :ensure   => 'present',
      # TODO is this what we want? does this actually work
      # if the provider is blank
      :provider => ''
    )}
  end

  describe 'on a freebsd based os' do
    let :facts do
      { :osfamily => 'FreeBSD', :root_home => '/root'}
    end
    it { should contain_package('ruby_mysql').with(
      :name     => 'ruby-mysql',
      :ensure   => 'present',
      :provider => 'gem'
    )}
  end

  describe 'on a redhat based os' do
    let :facts do
      {:osfamily => 'RedHat', :root_home => '/root'}
    end
    it { should contain_package('ruby_mysql').with(
      :name   => 'ruby-mysql',
      :ensure => 'present',
      :provider => 'gem'
    )}
    describe 'when parameters are supplied' do
      let :params do
        {:package_ensure   => 'latest',
         :package_provider => 'zypper',
         :package_name     => 'mysql_ruby'}
      end
      it { should contain_package('ruby_mysql').with(
        :name     => 'mysql_ruby',
        :ensure   => 'latest',
        :provider => 'zypper'
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
