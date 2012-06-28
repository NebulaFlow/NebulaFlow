#!/bin/sh

if [ ! -f ./src/NebulaFlow/bin/deploy.sh ]; then
	echo "Please run this script from the root directory of the NebulaFlow application"
	exit
fi

echo "Copying config..."
cp -f ./src/NebulaFlow/config/routing.yml ./app/config/
echo "NebulaFlow successfully updated it's config"