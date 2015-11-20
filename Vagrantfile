# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/trusty64"
    config.vm.provision :shell, path: "bootstrap.sh"
    config.vm.network :private_network, {
        ip: "192.168.10.10",
    }

    config.vm.provider :virtualbox do |machine|
        machine.customize [
            "modifyvm",
            :id,
            "--accelerate3d",
            "off",
        ]
        machine.customize [
            "modifyvm",
            :id,
            "--cpus",
            "1",
        ]
        machine.customize [
            "modifyvm",
            :id,
            "--memory",
            "2048",
        ]
        machine.customize [
            "modifyvm",
            :id,
            "--vtxvpid",
            "off",
        ]
    end
end
