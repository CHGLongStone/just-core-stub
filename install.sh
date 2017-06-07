#!/bin/bash


#######################################
# 2015-04-06
# Just core install script
# - install composer 
# - self update
# - install dependencies 
#
# safe to re-run 
# 
# Composer home: 			https://getcomposer.org
# interactive quick ref:  	http://composer.json.jolicode.com/
# 
#######################################


APP_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

#######################################
# load the project settings script
#######################################
source "$APP_DIR/"cfg_settings.sh
echo  -e "${CYAN} ${0##*/} ${NC}";


AUTOLOAD="add my new class to the auto load "
UPDATE="check upstream changes"
INSTALL="force a fresh composer install"
SCEX="Because I want this file to be included in the .gitignore list "

A="dump-autoload (regenerate the class maps)"
U="self-update, install, dump-autoload"
I="install composer from scratch then update"

INCLUDE="I want to ${GREEN}install${CYAN} the ./data/schema/schema.sql example${NC}"
FORCE="${CYAN}I've already added my current credentials in ./CONFIG/AUTOLOAD/data.${YELLOW}global${CYAN}.php${NC}"
FORCELOCAL="${CYAN}I've already added my current credentials in ./CONFIG/AUTOLOAD/data.${YELLOW}local${CYAN}.php${NC}"
WRITE="I want to ${RED}OVER WRITE${CYAN} defaults in ./CONFIG/AUTOLOAD/data.${YELLOW}global${CYAN}.php${NC}"
WRITELOCAL="I want to ${RED}OVER WRITE${CYAN} defaults in ./CONFIG/AUTOLOAD/data.${YELLOW}local${CYAN}.php${NC}"
WRITE_MASK="global"

SCHEMA_PATH="./data/schema/schema.sql"
CFG_PATH=""
CFG_TEMPLATE=$(cat <<-END
<?php 
return array(
	"DSN" => array(
		"JCORE" => array(
			"dbType"=>"MYSQL",
			#implementation=>"mysql",
			"host"=>"127.0.0.1",
			"port"=>3306,
			"database"=>"JCORE",
			"username"=>"jcore",
			"password"=>"jcore",
			"persistent"=>"true",
		)
	)
);
?>
END
)



declare -A DB_CREDS
DB_CREDS["DSN"]="JCORE"
DB_CREDS["DB_TYPE"]="MYSQL"
 
	

function usage(){

	echo -e "
	"${GREEN}"usage: $0 [options]"${NC}"
		${CYAN}install or update the current application
		  COMPOSER actions are executed FIRST
		  DATABASE actions are executed NEXT
		  ${NC}
		
	${GREEN} OPTIONS:${NC}
	${GREEN}	-c ${CYAN}COMPOSER ACTIONS${NC}:
		  ${CYAN} A ${NC}- $A
		  ${CYAN} U ${NC}- $U
			${GREEN}then A${NC} $A
		  ${CYAN} I ${NC}- $I
			${GREEN}then A${NC} $I
			${GREEN}then U${NC} $A
			
	${GREEN}	-d ${CYAN}DATABASE ACTIONS ${NC}:
		   ${CYAN}FORCE ${NC}- $INCLUDE 
			$FORCE
		   ${CYAN}WRITE ${NC}- $WRITE
			AND $FORCE
		   ${CYAN}WRITELOCAL ${NC}- $INCLUDE 
			$WRITELOCAL
			AND $FORCELOCAL
	${GREEN}	none/-h ${NC} Show this message
	
	${GREEN}	-r ${NC}   	might add something later...
	
	
	
${GREEN}Common usages, I want to:${NC}
	
		${GREEN}- $AUTOLOAD${NC}
			./install.sh -cA
		${GREEN}- $UPDATE ${NC}
			./install.sh -cU
		${GREEN}- $INSTALL ${NC}
			./install.sh -cI
		${GREEN}- Create a ${CYAN}Fresh${GREEN} install the Stub Application ${CYAN}$INCLUDE${NC}
			${GREEN}- ${CYAN}AND I've UPDATED DB Access credentials${GREEN}  in ./CONFIG/AUTOLOAD/data.${YELLOW}global${GREEN}.php${NC}
				./install.sh -cU -dFORCE
			${GREEN}- I want to enter my current credentials and ${RED}OVER WRITE${GREEN} ./CONFIG/AUTOLOAD/data.${YELLOW}global${GREEN}.php${NC}
				./install.sh -cU -dWRITE
			${GREEN}- I want to enter my current credentials and ${CYAN}CREATE${GREEN} ./CONFIG/AUTOLOAD/data.${YELLOW}local${GREEN}.php${NC}
				./install.sh -cU -dWRITELOCAL
	
	"
}



# regenerate the class map
function composerClassmap(){
	echo -e "${GREEN} dump-autoload (regenerate the class maps) ${NC}" 
	if [ ! -f composer.phar ]; then
		composerInstall
	fi 
	php composer.phar dump-autoload --optimize 	
}

# update dependencies under composer
function composerUpdate(){
	echo -e "${GREEN} self-update, install, update ${NC}" 
	
	if [ ! -f composer.phar ]; then
		composerInstall
	fi 
	php composer.phar self-update
	php composer.phar install
	php composer.phar update
	composerClassmap
}

# (re) install composer
function composerInstall(){
	echo -e "${GREEN} install composer from scratch then update ${NC}" 
	curl -sS https://getcomposer.org/installer | php
	composerUpdate
}



function databaseGetCreds(){
	##################################################
	# LOAD USER CREDENTIALS
	##################################################
	#echo -e "${GREEN} WRITE_MASK $WRITE_MASK ${NC}" 
	local_val=false
	if [ "local" == $WRITE_MASK ]; then
		local_val=true
	fi
	DB_CREDS["host"]=`php -r "require 'dbcreds.php'; getCred('host',$local_val);"`
	DB_CREDS["port"]=`php -r "require 'dbcreds.php'; getCred('port',$local_val);"`
	DB_CREDS["database"]=`php -r "require 'dbcreds.php'; getCred('database',$local_val);"`
	DB_CREDS["username"]=`php -r "require 'dbcreds.php'; getCred('username',$local_val);"`
	DB_CREDS["password"]=`php -r "require 'dbcreds.php'; getCred('password',$local_val);"`
	DB_CREDS["persistent"]=`php -r "require 'dbcreds.php'; getCred('persistent',$local_val);"`
	#echo -e "${GREEN} host ${DB_CREDS[host]} ${NC}" 

}

function databaseSetConfig(){
	CFG_TEMPLATE='<?php 
return array(
	"DSN" => array(
		"'${DB_CREDS["DSN"]}'" => array(
			"dbType"=>"'${DB_CREDS["DB_TYPE"]}'",
			#implementation=>"mysql",
			"host"=>"'${DB_CREDS["host"]}'",
			"port"=>'${DB_CREDS["port"]}',
			"database"=>"'${DB_CREDS[database]}'",
			"username"=>"'${DB_CREDS["username"]}'",
			"password"=>"'${DB_CREDS["password"]}'",
			"persistent"=>"'${DB_CREDS["persistent"]}'",
		)
	)
);
?>
	'
	#echo -e "${GREEN} CFG_TEMPLATE  ${CYAN}$CFG_TEMPLATE${NC}" 
}

function databaseSetCreds(){
	#echo -e "${GREEN} host [${DB_CREDS[host]}] port [${DB_CREDS[port]}] database [${DB_CREDS[database]}]${NC}" 
	#echo -e "${GREEN} username [${DB_CREDS[username]}] password [${DB_CREDS[password]}] persistent [${DB_CREDS[persistent]}]${NC}" 

	echo -e "${CYAN}DSN (Data Store Name): ${DB_CREDS[DSN]}
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"
	
	read set_dsn
	if [ "$set_dsn"  == "y" ]; then
		echo -e "${CYAN}Enter DSN ${NC}" 
		read DSN	
		DB_CREDS["DSN"]=$DSN
	fi;
	

	echo -e "${CYAN}DB Type: ${DB_CREDS[DB_TYPE]}
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"

	read set_db_type
	if [ "$set_db_type"  == "y" ]; then
		echo -e "${CYAN}Enter DB_TYPE ${NC}" 
		read DB_TYPE	
		DB_CREDS["DB_TYPE"]=$DB_TYPE
	fi;
	
	
	# HOST
	echo -e "${CYAN} Host: "${DB_CREDS[host]} "
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"
	read set_host
	if [ "$set_host" == "y" ]; then
		echo -e "${CYAN}Enter host ${NC}" 
		read host	
		DB_CREDS["host"]=$host
	fi;
	
	# PORT
	echo -e "${CYAN} Port:  "${DB_CREDS[port]}"
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"
	read set_port
	if [ "$set_port"  == "y" ]; then
		echo -e "${CYAN}Enter port ${NC}" 
		read port	
		DB_CREDS["port"]=$port
	fi;
	
	
	# DB NAME
	echo -e "${CYAN} database:  "${DB_CREDS[database]}"
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"
	read set_database
	if [ "$set_database"  == "y" ]; then
		echo -e "${CYAN}Enter database ${NC}" 
		read database	
		DB_CREDS["database"]=$database
	fi;
	
	# USR	
	echo -e "${CYAN} username:  "${DB_CREDS[username]}"
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"
	read set_username
	if [ "$set_username"  == "y" ]; then
		echo -e "${CYAN}Enter username ${NC}" 
		read username	
		DB_CREDS["username"]=$username
	fi;
	
	# PWD
	echo -e "${CYAN} password:  "${DB_CREDS[password]}"
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"
	read set_password
	if [ "$set_password"  == "y" ]; then
		echo -e "${CYAN}Enter password ${NC}" 
		read password	
		DB_CREDS["password"]=$password
	fi;
	
	# PERSISTENT
	echo -e "${CYAN} persistent:  "${DB_CREDS[persistent]}"
 ${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"
	read set_persistent
	if [ "$set_persistent"  == "y" ]; then
		echo -e "${CYAN}Enter persistent ${NC}" 
		read persistent	
		DB_CREDS["persistent"]=$persistent
	fi;
	
}

function databaseForce(){
	echo -e "${GREEN} Ready to install $SCHEMA_PATH ${NC}" 
	echo -e "${CYAN} CHANGE FILE? 
${GREEN}y${NC} to CHANGE ${CYAN}[enter]${NC} to continue ${NC}"

	read change_data_path
	if [ "$change_data_path" == "y" ]; then
		echo -e "${CYAN}Enter File path ${NC}" 
			read new_file_path
			$SCHEMA_PATH=$new_file_path
	fi;
	
	
	
	echo $SCHEMA_PATH'  | mysql --port='${DB_CREDS[port]}' --host='${DB_CREDS[host]}'  -u'${DB_CREDS[username]}' -p'${DB_CREDS[password]}' '${DB_CREDS[database]}';'
	cat $SCHEMA_PATH  | mysql --port=${DB_CREDS[port]} --host=${DB_CREDS[host]} -u${DB_CREDS[username]} -p${DB_CREDS[password]} ${DB_CREDS[database]}
	#echo 'drop database `dev-auth`;' | mysql -uganz-db -pganz-db
	#echo 'create database `dev-auth`;' | mysql -uganz-db -pganz-db
	#cat /tmp/auth.sql  | mysql -uganz-db -pganz-db dev-auth
	#echo "auth done"

}
function databaseWrite(){
	echo -e "${GREEN} -- overwrite defaults in ./CONFIG/AUTOLOAD/data.${CYAN}$WRITE_MASK${GREEN}.php then FORCE ${NC}" 
	databaseGetCreds
	databaseSetCreds
	
	CFG_PATH="./CONFIG/AUTOLOAD/data.${WRITE_MASK}.php"
	echo -e "${GREEN} Check your Values
	DSN ["${DB_CREDS[DSN]}"]
	  DB_TYPE ["${DB_CREDS[DB_TYPE]}"]
		host ["${DB_CREDS[host]}"] 
		port ["${DB_CREDS[port]}"] 
		database ["${DB_CREDS[database]}"]
		username ["${DB_CREDS[username]}"] 
		password ["${DB_CREDS[password]}"] 
		persistent ["${DB_CREDS[persistent]}"]
	
	CFG_PATH [${CFG_PATH}]
	${NC}" 
	
	echo -e "${CYAN}All good? 
	${GREEN}y to accept and continue
	${RED}n to re-enter values${NC}
	"
	
	read rewrite_creds
	if [ "$rewrite_creds" != "y" ]; then
			databaseSetCreds
	fi;
	
	databaseSetConfig
	echo "$CFG_TEMPLATE"  >$CFG_PATH

	echo -e "${GREEN}Updated Db credentials written to ${CYAN}$CFG_PATH${NC}" 
	
	databaseForce
}
function databaseWriteLocal(){
	echo -e "${GREEN} - overwrite defaults in ./CONFIG/AUTOLOAD/data.${CYAN}local${GREEN}.php then FORCE ${NC}" 
	WRITE_MASK="local"
	
	
	databaseWrite
}


cflag=
dflag=

while getopts ":c:d:r:h" name; do
	echo -e "		${PURPLE}FLAG:" $name "VALUE: $OPTARG${NC}"
	case $name in
		c)  c_flag=1
			c_val="$OPTARG";;
		d)  d_flag=1
			d_val="$OPTARG";;
		r)  r_flag=1
			r_val="$OPTARG";;
		:) 	usage
			echo -e "${RED}Option -$OPTARG : requires an argument.${NC}" >&2
			exit 2;;
		h)  echo -e "${RED}Option -$OPTARG h requires an argument.${NC}" >&2
			usage 
			exit 2;;
		?)  echo -e "${RED}Option -$OPTARG ? requires an argument.${NC}" >&2
			usage 
			exit 2;;
		*)  echo -e "${RED}Option -$OPTARG * requires an argument.${NC}" >&2
			usage 
			exit 2;;
	esac
done







#######################################
#validate the input - check the environment is set
#######################################
if [ -z "$c_flag" ] && [ -z "$d_flag" ]; then
	#echo -e "${RED}NO REQUIRED ARGS SET${NC}" 
	usage
	exit 2
else
	echo -e "${GREEN}executing: ${NC}" 
	#echo -e "${CYAN}	Composer: $c_val ${NC}" 
	#echo -e "${CYAN}	Database: $d_val ${NC}" 
fi



if [ ! -z "$c_flag" ]; then
	echo -e "${GREEN}COMPOSER OPERATIONS  ${CYAN}$c_val ${NC}" 
	case $c_val in
		A)  #echo -e "${GREEN} dump-autoload (regenerate the class maps) ${NC}" 
			composerClassmap;;
		U)  #echo -e "${GREEN} self-update, install, dump-autoload ${NC}" 
			composerUpdate;;
		I)  #echo -e "${GREEN} install composer from scratch then update ${NC}" 
			composerInstall;;
	esac
fi





if [ ! -z "$d_flag" ]; then
	case $d_val in
		"FORCE")  echo -e $FORCE
			;;
		"WRITE")  echo -e $WRITE
			;;
		"WRITELOCAL")  echo -e $WRITELOCAL
			;;
	esac
	echo -e "${RED}Are you SURE? ${GREEN}y${NC} to continue ${NC}"
	
	read yn
	if [ "$yn" != "y" ]; then
			exit 0
	fi;

fi

if [ ! -z "$d_flag" ]; then
	echo -e "${GREEN}DATABASE OPERATIONS ${CYAN}$d_val${NC}" 

	
	case $d_val in
		"FORCE")  #echo -e "${GREEN} install the ./data/schema/schema.sql to the database defined in ./CONFIG/AUTOLOAD/data.global.php${NC}" 
			databaseForce;;
		"WRITE")  #echo -e "${GREEN} WRITE ${NC}" 
			databaseWrite;;
		"WRITELOCAL")  #echo -e "${GREEN} WRITELOCAL ${NC}" 
			databaseWriteLocal;;
		
	esac
fi
 



exit





        test $VERBOSE && echo "Identifying dump database..."
        DUMPDB=`echo 'select DATABASE()' | mysql --defaults-file=$SRC_CNF | grep -v DATABASE`
        test -z $DUMPDB && echo "ERROR: Unable to determine name of dump database, exiting." && exit 2
        test $VERBOSE && echo "dump database is: $DUMPDB"
		
		
#BASH SPACE DELINIATED LIST			
for tablename in `cat $DIR/skiptableslist`; do 	echo -n "--ignore-table=$DBNAME.$tablename " 
done

#BASH multi line feed
cat <<EOUSAGE
stuff...
EOUSAGE

	echo " 
<?php

$ENVPATH = '$DIR';
$CACHEPATH = $dval'/CACHE';

$PLUGINSPATH = $dval'/PLUGINS';
$PACKAGESPATH = 'PACKAGES';
$LOGPATH = '/var/log/apache2/';
?>	
	
	" > $dval/env.php
	
	
	
	[client]
	host=your_db_hostname
	database=my_database
	user=my_username
	password="my_secret_passord"
	
                [client]
                host=your_db_hostname
                database=my_database
                user=my_username
                password="my_secret_passord"

