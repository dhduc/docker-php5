#!/bin/bash

PROJECT='blog.local'
ADMINER='adminer.local'
WEB='public/blog'
MYSQL_ROOT_PASSWORD='root123'
MYSQL_DATABASE='blog'
MYSQL_USER='root'
MYSQL_PASSWORD='root123'
ADMINER_PORT='8080'

ENDC=`tput setaf 7`
RED=`tput setaf 1`
GREEN=`tput setaf 2`
YELLOW=`tput setaf 3`
NORMAL=`tput sgr0`
BOLD=`tput bold`

nginx_conf() {
	NGINX_CONTAINER_ID=$(docker ps | grep 'nginx' | awk '{print $1}')
	if [ -z "$NGINX_CONTAINER_ID" ]; then
		echo $RED ERROR: Container \"$PROJECT\" could not be started. $ENDC
		exit 1
	fi

	IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $NGINX_CONTAINER_ID)
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
	echo $GREEN http://$ADMINER loaded at $IP $ENDC
}

adminer_config() {
	CONDITION_ADMINER="grep -q '"$ADMINER"' /etc/hosts"
	if eval $CONDITION_ADMINER; then
		CMD_ADMINER="sudo sed -i -r \"s/^ *[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+( +"$ADMINER")/"$IP" "$ADMINER"/\" /etc/hosts";
	else
		CMD_ADMINER="sudo sed -i '\$a\\\\n# Added automatically by run.sh\n"$IP" "$ADMINER"\n' /etc/hosts";
	fi

	eval $CMD_ADMINER
	if [ "$?" -ne 0 ]; then
		echo $RED ERROR: Could not update $ADMINER to hosts file. $ENDC
		exit 1
	fi
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

	cd $WEB
	if [ -s wp-config.php ]; then
		rm wp-config.php
	fi	
	cp wp-config-sample.php wp-config.php
	
	if [ -s 'wp-config.php' ]; then
		perl -pi -e "s/database_name_here/$MYSQL_DATABASE/g" wp-config.php
		perl -pi -e "s/username_here/$MYSQL_USER/g" wp-config.php
		perl -pi -e "s/password_here/$MYSQL_PASSWORD/g" wp-config.php
		perl -pi -e "s/localhost/$DB_IP/g" wp-config.php
	fi

	echo Update wp-config.php successful
	echo $GREEN MySQL server loaded at $DB_IP $ENDC
}

nginx_conf
adminer_config
web_config