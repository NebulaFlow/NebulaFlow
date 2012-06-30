#!/bin/sh

if [ ! -f ./src/NebulaFlow/bin/deploy.sh ]; then
	echo "Please run this script from the root directory of the NebulaFlow application"
	exit
fi

echo "Copying config..."
cp -f ./src/NebulaFlow/config/AppKernel.php ./app/
cp -f ./src/NebulaFlow/config/routing.yml ./app/config/
cp -f ./src/NebulaFlow/config/routing_dev.yml ./app/config/
cp -f ./src/NebulaFlow/config/base.html.twig ./app/Resources/views/
echo "NebulaFlow successfully updated it's config"
