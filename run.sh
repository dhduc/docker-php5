#!/bin/bash

PROJECT='note.local'
WEB='note'
MYSQL_ROOT_PASSWORD='root123'
MYSQL_DATABASE='note'
MYSQL_USER='root'
MYSQL_PASSWORD='root123'
ADMINER_PORT='8080'

ENDC=`tput setaf 7`
RED=`tput setaf 1`
GREEN=`tput setaf 2`
YELLOW=`tput setaf 3`
NORMAL=`tput sgr0`
BOLD=`tput bold`

apache_conf() {
	SERVER_CONTAINER_ID=$(docker ps | grep 'httpd' | awk '{print $1}')
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

web_config() {
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

	echo $GREEN MySQL server loaded at $DB_IP $ENDC
}

apache_conf
web_config