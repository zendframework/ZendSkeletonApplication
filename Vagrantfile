Vagrant.configure("2") do |config|
    config.vm.box = "precise64"

    config.vm.network :forwarded_port, guest: 80, host: 8080
    config.vm.network :forwarded_port, guest: 8080, host: 9090
    config.vm.network :private_network, ip: "192.168.56.101"

    config.ssh.forward_agent = true

    config.vm.provider :virtualbox do |v, override|
	    override.vm.box_url = "http://files.vagrantup.com/precise64.box"
	
        v.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
        v.customize ["modifyvm", :id, "--memory", 1024]
    end

    config.vm.provider :vmware_workstation do |v, override|
        override.vm.box_url = "http://files.vagrantup.com/precise64_vmware.box"

        v.vmx["memsize"] = "1024"
    end
    
    config.vm.synced_folder ".", "/vagrant", nfs: true
    config.vm.provision :shell, :inline => "if [[ ! -f /apt-get-run ]]; then sudo apt-get update && sudo touch /apt-get-run; fi"

    config.vm.provision :puppet do |puppet|
        puppet.manifests_path = ".puppet/manifests"
        puppet.module_path = ".puppet/modules"
        puppet.options = ['--verbose']
    end

    # Message
    config.vm.post_up_message = "West of House
You are standing in an open field west of a white house, with a boarded front door.
There is a small mailbox here.

>open mailbox
Opening the small mailbox reveals a leaflet.

>read leaflet
(Taken)
\"WELCOME TO ZendSkeletonApplication!

SSH to the VM: vagrant ssh
Change to synced folder on the VM: cd /vagrant
Run Apigility in a browser on the host: http://localhost:8080/ \"
 "

end
