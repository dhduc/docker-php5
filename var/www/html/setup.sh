#!/bin/sh
NAME='note'
PROJECT=$NAME'.local'
IP='127.0.0.1'

ENDC=`tput setaf 7`
RED=`tput setaf 1`
GREEN=`tput setaf 2`

echo Start running $NAME

# Configure Nginx
if [ -s 'etc/nginx/conf.d/note.nginx' ]; then
	sudo rm etc/nginx/conf.d/${NAME}.nginx
fi	
sudo cp ${NAME}.conf /etc/nginx/conf.d/${NAME}.conf

# Edit config file
cp config-sample.php config.php

# Attempt to hosts files
CONDITION="grep -q '"$PROJECT"' /etc/hosts"
if eval $CONDITION; then
	CMD="sudo sed -i -r \"s/^ *[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+( +"$PROJECT")/"$IP" "$PROJECT"/\" /etc/hosts";
else
	CMD="sudo sed -i '\$a\\\\n# Added automatically by run.sh\n"$IP" "$PROJECT"\n' /etc/hosts";
fi

eval $CMD
if [ "$?" -ne 0 ]; then
	echo $RED ERROR: Could not update $PROJECT to hosts file. $ENDC
	exit 1
fi

# Restart Nginx
sudo service nginx restart

echo 'Go to' $GREEN 'http://'$PROJECT $ENDC