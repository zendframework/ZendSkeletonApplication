require 'spec_helper_system'

describe 'mysql class' do
  describe 'running puppet code' do
    # Using puppet_apply as a helper
    it 'should work with no errors' do
      pp = <<-EOS
        class { 'mysql': }
      EOS

      # Run it twice and test for idempotency
      puppet_apply(pp) do |r|
        r.exit_code.should_not == 1
        r.refresh
        r.exit_code.should be_zero
      end
    end
  end

  describe package('mysql') do
    it { should be_installed }
  end

  describe service('mysql') do
    it { should_not be_running }
    it { should_not be_enabled }
  end
end
