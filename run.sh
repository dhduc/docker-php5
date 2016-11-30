#!/bin/bash

docker-compose up -d

NGINX_HOSTNAME='nginx'
PROJECT='blog_test.local'

# find IP of nginx container
NGINX_CONTAINER_ID=$(docker ps | grep $NGINX_HOSTNAME | awk '{print $1}')
if [ -z "$NGINX_CONTAINER_ID" ]; then
	echo ERROR: Container \"$PROJECT\" could not be started.
	exit 1
fi

IP=$(docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $NGINX_CONTAINER_ID)
if [ -z "$IP" ]; then
	echo ERROR: Could not find the IP address of container \"$PROJECT\".
	echo $IP
	exit 1
fi

echo
echo \"$PROJECT\" loaded at $IP
echo

# update HOSTS file
echo Attempting to update HOSTS file...
CONDITION="grep -q '"$PROJECT"' /etc/hosts"
if eval $CONDITION; then
	CMD="sudo sed -i -r \"s/^ *[0-9]+\.[0-9]+\.[0-9]+\.[0-9]+( +"$PROJECT")/"$IP" "$PROJECT"/\" /etc/hosts";
else
	CMD="sudo sed -i '\$a\\\\n# added automatically by docker-lamp run.sh\n"$IP" "$PROJECT"\n' /etc/hosts";
fi

eval $CMD
if [ "$?" -ne 0 ]; then
	echo ERROR: Could not update HOSTS file.
	exit 1
fi