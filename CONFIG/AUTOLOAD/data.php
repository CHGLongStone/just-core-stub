<?php




/**
* this file is just explanatory 
* you must create a data.local.php or data.global.php file 
* 
* 
* 
* 
* basic ini to store all the DB config info
* Copy this file to DATA.ini (same dir) and apply your own settings
* BOOTSTRAP will look for  "DATA.ini" first and will load "DATA.default.ini" 
* if the *real one* doesn't exist
*
* put your DB's (DSN's) on different ports so your persistent connections don't clobber
*
* MUST FOLLOW THIS STRUCTURE
*----------------------------
*-----MySQL------
-----------------------------
*[EXAMPLE]
*dbType="MYSQL"							
*host="217.0.0.1"	
*username="username"
*password="password"
*database="dbName"
*persistent="true"
*
*
*----------------------------
*[EXPLANATION] [STATS, AUTH, APPLICATION_DATA etc...]
*dbType="MYSQL"							this will use the standard MySQL connection object [DATA_API_MySQL.class.php]
*											*** over ridden by "implementation" but leave it as a back up if your class isn't propagated
***implementation="DATA_API_Postgres"	NOT NOTED ABOVE
*											this will allow the use of an override of the standard DATA_API connection object [DATA_API_[MySQL/POSTGRES].class.php]
*											it MUST be in the sub directory from DATA_API [i.e. JCORE/DATA/[MySQL/POSTGRES]]
*host="127.0.0.1"	this can include the server port instandard format [host="10.10.10.10:5506"]
*username="username"
*password="password"
*database="database"
*persistent="true" MUST BE SET TO string "false" TO OVERRIDE // ONLY SET A VALUE FOR TRUE, PUT IN QUOTES OR IT WILL EVAL TO '1' 
* and not TRUE (on ===), we'll cast this in  DATA_API_->set_connection($persistent)
*----------------------------
*
* END MySQL
*
*
*----------------------------
*----POSTGRES-----
*----------------------------

*[EXAMPLE]
* dbType="POSTGRES"
* implementation="DATA_API_Postgres"	
* host="127.0.0.1"
* port=5432
* dbname="JCORE"
* username="username"
* password="password"
* persistent="true"
*
*----------------------------
*[EXPLANATION] [JCORE, etc]
***dbType="POSTGRES"  						this will use the standard postgres connection object [DATA_API_Postgres.class.php] 
*											*** over ridden by "implementation"
***implementation="DATA_API_Postgres"	this will allow the use of an override of the standard DB connection object [DATA_API_[MySQL/Postgres].class.php]
*											it MUST be in the sub directory from DATA_API [i.e. JCORE/DATA/[MySQL/POSTGRES]]
*host="127.0.0.1"
*port=5432 ... different from MySQL, have to put some eception handling so we can transition to using ports too
*dbname="JCORE"
*username="username"
*password="password"
*persistent="true" see MySQL above
*----------------------------
* END POSTGRES
*
* POSTGRES IMPLEMENTATION
* CONNECTION STRING OPTIONS
* 		THIS FORMAT 		keyword = value (pairs separated by white space)
* 		THIS ORDER			host , hostaddr , port , dbname , user , password , 
*							connect_timeout , options , tty  (ignored), sslmode , 
*							requiressl  (deprecated in favor of sslmode ), and service .
*
* resource pg_connect  ( string $connection_string  [, int $connect_type  ] )
* 	$conn_string = "host=sheep port=5432 dbname=test user=lamb password=bar";
* 	$connect_type = PGSQL_CONNECT_FORCE_NEW a new connection is created, even if the connection_string  is identical to an existing connection. 
* $dbconn4 = pg_connect($conn_string);
* PERSISTENT
* resource pg_pconnect  ( string $connection_string  [, int $connect_type  ] )
*

[JCORE]
dbType="MySQL"
*implementation="mysql"
host="127.0.0.1"
port=3306
database="JCORE"
username="jcore"
password="jcore"
persistent="true"
*connection_string="host=127.0.0.1 port=5432 dbname=dbname user=user password=pwd"
* do the connection strinf in the dbConnection class
*/


?>