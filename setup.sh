#!/bin/bash

cd scripts/;
sudo bash php-installer.sh
sudo bash set-directories.sh

cd ..
# Source environment variables from .env file
if [ -f .env ]; then
    source .env
else
    echo ".env file not found. Make sure it exists in the same directory as the script. Look for .env.examples"
    exit 1
fi

sudo chown -R $OWNER:$OWNER public/
php artisan install:app

echo "DONE"

