#!/bin/bash

OWNER=${whoami}

sudo mkdir ../public/background-picture;
sudo mkdir ../public/images;
sudo mkdir ../public/profile-picture;
sudo mkdir ../public/thumbnails;

sudo chmod -R +w ../public/background-picture
sudo chmod -R +w ../public/images
sudo chmod -R +w ../public/profile-picture
sudo chmod -R +w ../public/thumbnails

echo "Public directories created.";
