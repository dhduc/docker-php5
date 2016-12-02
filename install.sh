# Define variable
ROOT_DIR='public/blog'
GIT_REMOTE='git@github.com:WordPress/WordPress.git'
GIT_OPTIONS=''

ENDC=`tput setaf 7`
RED=`tput setaf 1`
GREEN=`tput setaf 2`
YELLOW=`tput setaf 3`
NORMAL=`tput sgr0`
BOLD=`tput bold`

init() {
	echo 'Install and setup wordpress project'
}

clone()
{
	echo 'Create and clone project to' $ROOT_DIR
	if [ -d $ROOT_DIR ]; then
		echo $RED'NOTICE: Exist folder ' $ROOT_DIR $ENDC
	else
		git clone $GIT_OPTIONS $GIT_REMOTE $ROOT_DIR	
	fi
}

setAcl() {
	echo 'Setup ownership and permissions for' $ROOT_DIR

	cd $ROOT_DIR
	git config core.fileMode false

	HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
	sudo chown -R `whoami`:"$HTTPDUSER" .
	find . -type d -exec chmod 775 {} \; && find . -type f -exec chmod 664 {} \;

	echo $GREEN'Clone project successful' $ENDC
}


init
clone
setAcl