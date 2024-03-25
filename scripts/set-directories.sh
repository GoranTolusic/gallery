#!/bin/bash

mkdir ../public/background-picture;
mkdir ../public/images;
mkdir ../public/profile-picture;
mkdir ../public/thumbnails;

chmod -R +w ../public/background-picture
chmod -R +w ../public/images
chmod -R +w ../public/profile-picture
chmod -R +w ../public/thumbnails

echo "Public directories created.";
