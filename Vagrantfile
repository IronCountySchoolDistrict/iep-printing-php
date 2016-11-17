Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.provision "shell", path: "vagrant-provision.sh"
  config.vm.provision "shell", inline: "service apache2 restart", run: "always"

  config.vm.network :private_network, {
      ip: "192.168.10.10",
  }

  config.vm.synced_folder ".", "/vagrant", disabled: true
  config.vm.synced_folder ".", "/var/www/iep-printing-php", owner: "www-data", group: "www-data"

  config.vm.provider "virtualbox" do |v|
    v.memory = 512
    v.cpus = 1
  end
end
