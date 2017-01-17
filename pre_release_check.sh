#!/bin/bash

#######################################
# 2016-02-20
# Pre Release Check Script
#######################################

APP_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

#######################################
# load the project settings script
#######################################
source "$APP_DIR/"cfg_settings.sh

echo  -e "${CYAN} ${0##*/} ${NC}";

function usage(){
	echo -e "${GREEN}"
	echo 	"usage: $0 [option]"
	echo -e "${NC}"

	echo -e "${BLUE}
			this script will run a number of checks required 
			PRIOR to creating a new release tag 
			
			${GREY} 1) set the project perms ${BLUE}
				run a permission setting against the list of WORKING_DIRS in cfg_settings.sh 
				Current:${CYAN}"
		for i in "${!WORKING_DIRS[@]}"; do 
			echo "			$i perm: ${WORKING_DIRS[$i]} "
		done	

		echo -e "
		${NC}
		${BLUE}
			${GREY} 2) ensure there are no outstanding *owned* dependency changes ${BLUE}
			ensure there are no outstanding changes from any client owned dependency repositories
			contained in JCORE_DEP_DIR_LIST and should be a line separated list of directories, 
			path relative from the execution of this script (APP_DIR set above) 
				Current:
					${GREEN}$APP_DIR${BLUE}
			
			${GREY} 3) ensure there are no outstanding upstream dependencies ${BLUE}
			run composer and look for changes in any composer loaded dependencies
				ie. something that could break on propagation like sub dependencies
	
		
		${GREEN} OPTIONS:${NC}
		${GREEN}	none/-h ${NC}	Show this message
		${GREEN}	-r ${NC}   		[any value] run the script
		
	"
	echo -e "${NC}"
		echo -e "${NC}"
}

rflag=

while getopts ":r:h" name; do
	#echo -e "		${PURPLE}FLAG:" $name "VALUE: $OPTARG${NC}"
	case $name in
		r)  rflag=1
			rval="$OPTARG";;
		h)   usage 
		exit 2;;
	esac
done

#######################################
#validate the input - check the environment is set
#######################################
if [ -z "$rflag" ]; then
	usage
	exit 2
fi


#######################################
# 1)
#######################################
echo -e "${YELLOW}Setting WORKING_DIRS permissions${NC}"
for i in "${!WORKING_DIRS[@]}"; do 
	echo -e "${GREEN}	$i perm: ${WORKING_DIRS[$i]} ${NC}"
	echo `chmod -R ${WORKING_DIRS[$i]} $i`
done	




#######################################
# 2)
#######################################
echo -e "${YELLOW}Checking Outstanding commits in dependency repos${NC}"
for i in $JCORE_DEP_DIR_LIST; do 
	cd $APP_DIR
	cd $i
	echo -e "${GREEN}" "$PWD" "${NC}"
	# encapsulate in a variable first to preserve line breaks in output
	# then display it in a quoted string 
	STATUS=`git status $i`
	echo -e "${CYAN} $STATUS ${NC}"
	echo ""
done


#######################################
# 3)
#######################################
echo -e "${YELLOW}Checking Composer dependencies${NC}"

curl -sS https://getcomposer.org/installer | php




php composer.phar self-update
php composer.phar install
php composer.phar update


