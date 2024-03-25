#!/bin/bash

sudo apt-get update

#php and client
sudo apt install php8.1
sudo apt install php-cli

#extensions
sudo apt install php8.1-xml
sudo apt install php8.1-curl
sudo apt-get install php-mysql
sudo apt-get install php-mbstring
sudo apt-get install php-gd

#composer
sudo apt  install curl
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

echo "Php, extensions and composer has been installed."
