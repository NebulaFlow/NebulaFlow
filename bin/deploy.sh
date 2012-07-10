#!/bin/sh

if [ ! -f ./src/NebulaFlow/bin/deploy.sh ]; then
	echo "Please run this script from the root directory of the NebulaFlow application"
	exit
fi

echo "Configuring framework"
cp -f ./src/NebulaFlow/config/AppKernel.php ./app/
cp -f ./src/NebulaFlow/config/routing.yml ./app/config/
cp -f ./src/NebulaFlow/config/routing_dev.yml ./app/config/
cp -f ./src/NebulaFlow/config/base.html.twig ./app/Resources/views/
echo "	Config updated"
if [ -h ./web/bundles/nebulaflowmainbundle ]; then
	echo "	OK (already linked)"
else
	echo "	Link established"
	ln -s ../../src/NebulaFlow/MainBundle/Resources/public ./web/bundles/nebulaflowmainbundle
fi

echo ""
echo -n "If you have set up your app/config/parameters.yml I can set up your database. Do you want me to install the database for you? [N]: "
read -n 1 installDB
echo ""
if [ "${installDB}" == "Y" -o "${installDB}" == "y" ]; then
	echo "	Installing..."
	php app/console doctrine:database:create
	echo "	Done."
else
	echo "	Skipping"
fi
