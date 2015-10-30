# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

$script = <<SCRIPT
  sudo apt-get update

  # Utils and fun bits
  sudo apt-get install -y curl git
  sudo apt-get install -y avahi-daemon
  sudo apt-get install -y openssh-client openssh-server
  sudo apt-get install -y memcached

echo -e "\e[7m OS and core software installed \e[27m"

  # MySQL and friends
  sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
  sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
  sudo apt-get install -y mysql-server

  # PHP with all the fixins
  sudo apt-get install -y php5 php5-apcu php5-cli php5-curl php5-gd php5-imagick php5-json php5-mcrypt php5-memcache php5-memcached php5-mysql php5-oauth php5-readline php5-sqlite php5-xdebug php5-xhprof php5-xmlrpc

echo -e "\e[7m MySQL and PHP installed \e[27m"

  # Install apache and screw mightily with permissions
  sudo apt-get install -y apache2 libapache2-mod-php5

  sudo echo "<VirtualHost *:80>" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "  ServerName avse.local" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "  ServerAdmin webmaster@localhost" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "  DocumentRoot /var/www/html" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "  ErrorLog ${APACHE_LOG_DIR}/error.log" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "  CustomLog ${APACHE_LOG_DIR}/access.log combined" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "  <Directory /var/www>" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "    AllowOverride All" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "  </Directory>" >> /etc/apache2/sites-available/wordpress.conf
  sudo echo "</VirtualHost>" >> /etc/apache2/sites-available/wordpress.conf

  sudo a2dissite 000-default
  sudo a2ensite wordpress
  sudo a2enmod rewrite
  sudo service apache2 restart

echo -e "\e[7m Apache installed \e[27m"

  # Create the database, clean up after Apache, install front end requirements.
  mysql -uroot -proot -e "create database wordpress;"
  if [ -f "/vagrant/initial.sql" ]
  then
    mysql -uroot -proot wordpress < /vagrant/initial.sql
    mysql -uroot -proot wordpress -e "UPDATE hc_options SET option_value = 'http://avse.local' WHERE option_name IN ('siteurl', 'home');"
    echo -e "\e[7m Database imported \e[27m"
  fi

  rm /vagrant/www/index.html

echo "66.155.40.188 api.wordpress.org" >> /etc/hosts
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp

echo -e "\e[7m Wordpress bits installed \e[27m"

echo -e "\e[7m Go forth and Nerd \e[27m"

SCRIPT

  config.vm.box = "ubuntu/trusty32"

  config.vm.provider "virtualbox" do |v|
    v.memory = 2048
    v.cpus = 2
    v.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  end

  config.vm.network "private_network", type: "dhcp"
  config.vm.hostname = "avse"
  config.vm.synced_folder "www/", "/var/www/html", owner: "www-data", group: "www-data", create: true
  config.vm.synced_folder "logs/", "/var/log/apache2", create: true

  config.vm.provision "shell", inline: $script

end
