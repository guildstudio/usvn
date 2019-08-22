Vagrant.configure("2") do |config|

  config.vm.box = "ubuntu/bionic64"

  config.vm.network :forwarded_port, guest: 80, host: 8080
  config.vm.host_name = "usvn.dev"

  config.vm.synced_folder "./", "/var/sites/usvn",
    id: "vagrant-root",
    owner: "vagrant",
    group: "www-data",
    mount_options: ["dmode=775,fmode=664"]

=begin
  config.vm.provision "shell", inline: "
  apt-get update
  DEBIAN_FRONTEND=noninteractive apt-get install -y apache2 php libapache2-mod-php mysql-server php-xml php-mysql subversion libapache2-svn zend-framework

cat > /etc/apache2/sites-available/usvn.conf <<EOF
Alias /usvn /var/sites/usvn/src/public
<Directory \"/var/sites/usvn/src/public\">
Options +SymLinksIfOwnerMatch
AllowOverride All
Require all granted
</Directory>
EOF

a2enmod rewrite
a2ensite usvn
/etc/init.d/apache2 restart
"
=end

end
