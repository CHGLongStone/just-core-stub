#!/bin/bash

#######################################
# 2016-02-20
# Create Release Script
# 
# 
# 
#######################################

APP_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

#######################################
# load the project settings script
#######################################
source "$APP_DIR/"cfg_settings.sh
echo  -e "${CYAN} ${0##*/} ${NC}";

function usage(){

	echo -e "
	"${GREEN}"usage: $0 [options]"${NC}"
	create a release tag
		- validate the args first
		- run pre_release_check as a sanity check
		- 
	
	${GREEN} OPTIONS:${NC}
	${GREEN}	-c ${NC}   		"[...]" commit message, quoted
	${GREEN}	-r ${NC}   		[v0.9.9] release tag 
	${GREEN}	none/-h ${NC}	Show this message
	
	"
}

cflag=
rflag=

while getopts ":c:r:h" name; do
	#echo -e "		${PURPLE}FLAG:" $name "VALUE: $OPTARG${NC}"
	case $name in
		c)  c_flag=1
			c_val="$OPTARG";;
		r)  r_flag=1
			r_val="$OPTARG";;
		h)   usage 
		exit 2;;
	esac
done

#######################################
#validate the input - check the environment is set
#######################################
if [ -z "$r_flag" ]; then
	echo -e "${RED}NO RELEASE TAG SET${NC}" 
	usage
	exit 2
else
	echo -e "${GREEN}RELEASE TAG:${NC}${BLUE}$r_val${NC}" 
fi

if [ -z "$c_flag" ]; then
	echo -e "${RED}NO RELEASE NOTES SET${NC}" 
	usage
	exit 2
else
	echo -e "${GREEN}RELEASE NOTES:${NC}${BLUE}$c_val${NC}" 
fi

#######################################
# START PRE-RELEASE CHECK  
#	- DB 
#	- Source Code
#	- Dependencies
#
#######################################
echo -e "${RED}"
echo  	" OK...BEFORE we start"
echo  	" did you check your shit?"
echo  	"	- merged any outstanding branches/projects/tickets "
echo  	"	- checked your own directories for outstanding changes "
echo  	" you will be reminded... "
echo -e "${NC}"
echo -e -n "${GREEN} PROCEED? ${NC}  [y|n] : "
read yn
if [ "$yn" != "y" ]; then
	exit 0
fi;

#######################################
# PRE-RELEASE CHECK - DB
# check the schema and create a sql diff (patch/revert)
# 
# see:
# 	this script https://github.com/CHGLongStone/just-core-scripts/blob/master/SchemaSyncWrapper.sh
# 
# ./SchemaSyncWrapper.sh -tdev -sprod -r/var/www/vhosts/blackwatch_dev/data/updates/vNUMBER
#
# 
#######################################
echo -e "${YELLOW}"
echo 	" START PRE-RELEASE CHECK " 
echo	" Check DB Schemas"
echo  	" you can commit the patch and revert files as you go (open a new shell) "
echo  	" you will be required to add them before completing the release script"
echo  	"	(you can do this after the dependency check)"
echo -e "${NC}"

for i in "${!JCORE_ENV_UPSTREAM[@]}"; do 
	echo -e "${YELLOW} generate schema diff from: ${JCORE_ENV_UPSTREAM[$i]} TO $i ${NC}"
	#$just_core_scripts/SchemaSyncWrapper.sh -t$i -s${JCORE_ENV_UPSTREAM[$i]} -r$APP_DIR/data/updates/ -d$APP_DIR/data/updates -n$r_val"_"$i
	#./SchemaSyncWrapper.sh -tdev -sprod -nvNUMBER -d/var/www/vhosts/blackwatch_dev/data/updates/
	$just_core_scripts/SchemaSyncWrapper.sh -t$i -s${JCORE_ENV_UPSTREAM[$i]} -d$APP_DIR/data/updates -n$r_val
done

#######################################
# add the patch and revert files to the repo
#######################################
echo -e "${YELLOW}"
echo  	" you SHOULD commit the patch and revert files NOW... "
echo  	" BEFORE you create and push the release tag"
echo  	" next step will check the project file system and "
echo  	" directories for outstanding changes "
echo  	" you will be reminded... "
echo -e "${NC}"
echo -e -n "${GREEN}PROCEED? ${NC}  [y|no] : "
read yn
if [ "$yn" != "y" ]; then
	exit 0
fi;

echo -e "${YELLOW}"
echo 	"Checking Outstanding commits in dependency repos"
echo -e "${NC}"

PRE_CHECK=`./pre_release_check.sh -ry`
echo -e "$PRE_CHECK " 
echo -e "${YELLOW} END PRE-RELEASE CHECK ${NC}" 


#######################################
## CONFIRM THE SETTINGS
#######################################
echo -e "${YELLOW}"
echo 	" everything clean?"
echo 	" dependencies all pass?"
echo 	" Required New/Untracked files: added...ie SQL changes?"
echo -e "${NC}"
echo -e "${GREEN}PROCEED?    [y|n] : ${NC}"
read yn
if [ "$yn" != "y" ]; then
        exit 0
fi;

#######################################
## sanity check the perms again
# assuming all the below is done 
# 	chmod -R 1755 /data APIS/ CONFIG/  HTTP_ASSETS/ SERVICES/
# 	git add APIS/ CONFIG/  HTTP_ASSETS/ SERVICES/
# 	git commit -m "COMMIT_MESSAGE"
# 	git pull origin integration
# 	git push origin integration
# 
#######################################

for i in "${!WORKING_DIRS[@]}"; do 
	echo `	chmod -R 1${WORKING_DIRS[$i]}	$i `
	dir_status=`git status $i `
	echo -e "${YELLOW} $i ${NC}"
	echo -e "${CYAN} $dir_status ${NC}"
done

#######################################
## SANITY CHECK
#######################################
echo -e "${RED}"
echo 	" At this point you are ready to commit to creating the release candidate"
echo 	" - all development branches merged to integration"
echo 	" - pushed to origin"
echo -e "${NC}"
echo -e "${GREEN}PROCEED?    [y|n] : ${NC}"
read yn
if [ "$yn" != "y" ]; then
        exit 0
fi;


#######################################

echo -e "${GREEN} fetch upstream changes ${NC}"
git fetch
git status

#######################################
echo -e "${GREEN} checkout master ${NC}"
git checkout master

#######################################
echo -e "${GREEN} merge origin/master ${NC}"
git merge origin/master

#######################################
echo -e "${GREEN} merge origin/integration ${NC}"
git merge origin/integration

#######################################
echo -e "${GREEN} push origin master ${NC}"
git push origin master

#######################################
echo -e "${GREEN}cut the tag $c_val ${NC}"
git tag -a $r_val -m "$c_val"

#######################################
echo -e "${GREEN}PUSH the tag $c_val ${NC}"
git push origin $r_val
# 
#######################################
echo -e "${GREEN} reset to integration branch ${NC}"
git checkout integration

echo -e "${CYAN}"
echo 	" release tag is pushed"
echo 	" Excute:"
echo -e "${NC}"

for i in "${!JCORE_ENV_UPSTREAM[@]}"; do 
	echo -e "${YELLOW} ./update_production.sh -t$r_val -e$i ${NC}"
done

exit 0	

echo -e "${RED}PUke and dIE here.. just because we haven't tested further ${NC}" 
exit 0	
##############################################################################
##############################################################################
##############################################################################
##############################################################################

#######################################
# IF THERE IS NO "FORCE" FLAG 
# PROMPT THE USER FOR OVER WRITE
#######################################
if [ -d $newDirPath ]; then 
	echo -e "\033[1m Directory EXISTS:\033[0m " $newDirPath
	#printf " \n $newDirPath         \n \n" $newDirPath
	if [ -z "$fflag" ]; then 
		echo -e -n "\033[1m OVERWRITE?\033[0m [yes|no] ?: "
		read yn
		if [ "$yn" != "y" ]; then
				exit 0
		fi;		
	fi
	logmsg="\033[1m REMOVING Directory:\033[0m $newDirPath  "
	bashlogger -m "$logmsg" -V $VERBOSE_OUT
	rm -R -f $newDirPath
else
	printf "\033[1m NO Directory:\033[0m $newDirPath  \n"
fi;
