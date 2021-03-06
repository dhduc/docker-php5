#!/bin/bash

PROJECT='php5.local'
MYSQL_ROOT_PASSWORD='root'
MYSQL_DATABASE='php5'
MYSQL_USER='root'
MYSQL_PASSWORD='root'

ENDC=`tput setaf 7`
RED=`tput setaf 1`
GREEN=`tput setaf 2`
YELLOW=`tput setaf 3`
NORMAL=`tput sgr0`
BOLD=`tput bold`

nginx_conf() {
	SERVER_CONTAINER_ID=$(docker ps | grep 'nginx' | awk '{print $1}')
	if [ -z "$SERVER_CONTAINER_ID" ]; then
		echo $RED ERROR: Container \"$PROJECT\" could not be started. $ENDC
		exit 1
	fi

	IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $SERVER_CONTAINER_ID)
	if [ -z "$IP" ]; then
		echo $RED ERROR: Could not find the IP address of container \"$PROJECT\". $ENDC
		exit 1
	fi

	echo Attempting to update hosts file...

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

	echo $GREEN http://$PROJECT loaded at $IP $ENDC
}

mysql_conf() {
	MARIADB_ID=$(docker ps | grep 'mariadb' | awk '{print $1}')
	if [ -z "$MARIADB_ID" ]; then
		echo $RED ERROR: Could not start MySQL container. $ENDC
		exit 1
	fi

	DB_IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $MARIADB_ID)
	if [ -z "$IP" ]; then
		echo $RED ERROR: Could not find the IP address of MySQL container $ENDC
		exit 1
	fi

	if [ -s 'var/www/html/config.php' ]; then
		perl -pi -e "s/host_here/$DB_IP/g" var/www/html/config.php
	fi

	echo $GREEN MySQL server loaded at $DB_IP $ENDC
}

nginx_conf
mysql_conf