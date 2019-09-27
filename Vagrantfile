Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/bionic64"

  config.vm.network "forwarded_port", guest: 443, host: 4443
  config.vm.host_name = "usvn.dev"

  config.vm.synced_folder "./", "/var/sites/usvn",
    id: "vagrant-root",
    owner: "vagrant",
    group: "www-data",
    mount_options: ["dmode=775,fmode=664"]

  config.vm.synced_folder "./data/", "/var/svn",
    id: "svn-root",
    create: true,
    owner: "vagrant",
    group: "www-data",
    mount_options: ["dmode=775,fmode=664"]

  config.vm.provision "shell", inline: "
    apt-get update -y
    DEBIAN_FRONTEND=noninteractive apt-get install -y ansible
"

  config.vm.provision "ansible_local" do |ansible|
    ansible.compatibility_mode = "2.0"
    ansible.playbook = "provision/site.yml"
    ansible.inventory_path = "provision/inventories/develop/hosts"
    ansible.limit = "subversion"
  end

end
