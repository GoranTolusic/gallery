#!/bin/bash

cd scripts/;
sudo bash php-installer.sh
sudo bash set-directories.sh

cd ..
php artisan install:app

echo "DONE"

