<?php
/**
 * the point of this file is encapsulate things we have to do for most/every page 
 * - FIRST we set a hook on any configuration page like this that is HTTP accessible
 * 
 * - SECOND we do some basic flags to determine if we are in development of on production 
 * 
 * - THIRD we set the application root directory so we know were to find your "SERVICES"
 *   directory, this can be adjusted in APPLICATION_ROOT/composer.json in the 
 *   autoload:classmap section, see: 
 *		https://getcomposer.org/doc/04-schema.md#classmap
 * 		https://getcomposer.org/doc/03-cli.md#dump-autoload
 * 		
 * - THEN we add things specific to our implementation
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package JCORE\API\REST
 * 
 */
/**
* ***FIRST***
* repeat this block (or some semblance) for any file with HTTP access that 
* you don't want loaded directly
* exit with an error for automated testing
*/

if(
	$_SERVER['SCRIPT_NAME'] == strstr(__FILE__, $_SERVER['SCRIPT_NAME'])
	||
	$_SERVER['PHP_SELF'] == strstr(__FILE__, $_SERVER['PHP_SELF'])
){
	exit('FaakUff');
	exit(0);
 }
 
 
/**
 * ***SECOND***
 * Display all errors when APPLICATION_ENV is development.
 * set in .htaccess in this directory 
 * 
 */
if (isset($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] != 'production') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
	/** test.php needs a MAJOR UPDATE
	echo __FILE__.'@'.__LINE__.' 
		you need to read the notes above this line then comment it out<br>
		test your installation <a href="test.php" >here:</a>
	';
	ini_set("error_log", "/var/log/httpd/php_error.log");
	*/
}
/**
 * ***THIRD***
 * Set the APPLICATION_ROOT, calculated from current dir
 * each environment may differ, the application root is expected to be 
 * some where "below" the existing directory 
 * 
 */

$APPLICATION_ROOT = dirname(dirname(__DIR__)).'/';
chdir($APPLICATION_ROOT);

/**
* verify we want to display the page at all (is there an update notification?)
* 	
* 	see: 
*		$APPLICATION_ROOT.update_notice.php 
*		AND
* 	 	https://github.com/CHGLongStone/just-core-scripts/blob/master/update_production.sh
*/
if (file_exists('update.php')) {
	@include 'update.php';
}

/**
* init.php is the bootstrap located in the APPLICATION_ROOT directory
* configuration files are in  /CONFIG/AUTOLOAD directory
* these use the "return array()" format
* all configurations are retrieved and stored using CONFIG_MANAGER
* TEMPLATER_DATA below is a good example
* 
* 
* 
*/
if (file_exists('init.php')) {
    include 'init.php';
}else{
	die('
	application not initialized, your relative path<br>'.PHP_EOL.' 
	from your API to your base install has not been calculated correctly<br>'.PHP_EOL.'
	in the APPLICATION_ROOT variable
	');
}

/**
****************************************************************************************************
****************************************************************************************************
* 	*** THEN ***
*	THIS IS THE END OF THE DEFAULT SECTION
*	now add things that are specific to your implementation
* 
****************************************************************************************************
****************************************************************************************************
*/

session_start();
/**
* AUTH HOOK
* we test for session/cookie/nonce what ever here an do a redirect to our authentication page
* we add a condition to ensure we don't have an endless redirect with an unauthenticated user
* set some data
*/
$AUTH_HARNESS = new JCORE\AUTH\AUTH_HARNESS();
if(true !== $AUTH_HARNESS->register('JCORE\AUTH\IP_WHITELIST')){
	die('failed to load LOGIN_SERVICE');
}
if(true !== $AUTH_HARNESS->register('JCORE\SERVICE\AUTH\LOGIN_SERVICE')){
	die('failed to load LOGIN_SERVICE');
}



/**
* call our authentication method/service, we're only looking for a boolean response
* for a basic website, for an API we'll do a different hook forcing 
* authentication at the header level or in the transport request
* 
*/
$AUTH_TEST = true; //add your hook here



/*
$AUTH_TEST = $AUTH_HARNESS->authenticate(
	'JCORE\AUTH\IP_WHITELIST',
	array(
		'AUTH_TYPE' => 'IP_WHITELIST',
		'SERVICE_NAME' => 'GLOBAL'
	)
);
*/

#echo __METHOD__.__LINE__.'$AUTH_TEST<pre>['.var_export($AUTH_TEST, true).']</pre>'.PHP_EOL; 

/*
echo 'strstr('.$_SERVER["REQUEST_URI"].', '.$LOGIN_PAGE.')<pre>['.strstr($_SERVER["REQUEST_URI"], $LOGIN_PAGE).']</pre>'.PHP_EOL;
echo 'strstr('.$_SERVER["SCRIPT_NAME"].', '.$LOGIN_PAGE.')<pre>['.strstr($_SERVER["REQUEST_URI"], $LOGIN_PAGE).']</pre>'.PHP_EOL;
echo 'strstr('.$_SERVER["PHP_SELF"].', '.$LOGIN_PAGE.')<pre>['.strstr($_SERVER["REQUEST_URI"], $LOGIN_PAGE).']</pre>'.PHP_EOL;
*/
/**
* pages not to lock out
* login, signup, logout
* 
$PAGE_HOOKS = $GLOBALS["CONFIG_MANAGER"]->getSetting('AUTH','PAGE_FILTER_ALLOW_PUBLIC');

$WHITELIST_TEST = $AUTH_HARNESS->authenticate('JCORE\SERVICE\AUTH\PAGE_FILTER',$PAGE_HOOKS);
*/
$WHITELIST_TEST = $AUTH_HARNESS->authenticate(
	'JCORE\AUTH\IP_WHITELIST',
	array(
		'AUTH_TYPE' => 'GLOBAL',
		#'AUTH_TYPE' => 'IP_WHITELIST',
		#'SERVICE_NAME' => 'GLOBAL'
	)
);

/**
exit;
echo __METHOD__.__LINE__.'$WHITELIST_TEST<pre>['.var_export($WHITELIST_TEST, true).']</pre>'.PHP_EOL; 
echo __METHOD__.__LINE__.'$_SESSION<pre>['.var_export($_SESSION, true).']</pre>'.PHP_EOL; 
echo __METHOD__.__LINE__.'$_SERVER<pre>['.var_export($_SERVER, true).']</pre>'.PHP_EOL; 
*/

#######################################
/**
* setting this value here so it can be used later
*/
(isset($_SERVER['HTTPS']) && 'on' == $_SERVER['HTTPS'])? $httpype = 'https' : $httpype = 'http';
#echo ' restrictive mode...pass the white list first, then check credentials<br>'.PHP_EOL;
$authCheck = false;
//if(true === $WHITELIST_TEST){
	
	$authCheckType = 'API';
	if(isset($_REQUEST["PUBLIC_TOKEN"])){
		//authenticateUserSession  SESSION
		$authCheckType = 'TOKEN';
	}elseif(isset($_SERVER["HTTP_SESSIONID"])){
		$authCheckType = 'SESSION';
	}
	
	$AUTH_TEST = $AUTH_HARNESS->authenticate(
		'JCORE\SERVICE\AUTH\LOGIN_SERVICE',
		array(
			'AUTH_TYPE' => $authCheckType
		)
	);
	/*
	echo __METHOD__.__LINE__.'$authCheckType<pre>['.var_export($authCheckType, true).']</pre>'.PHP_EOL; 
	echo __METHOD__.__LINE__.'$_SERVER<pre>['.var_export($_SERVER, true).']</pre>'.PHP_EOL; 
	echo __METHOD__.__LINE__.'$AUTH_TEST<pre>['.var_export($AUTH_TEST, true).']</pre>'.PHP_EOL; 
	*/
	
	if(true === $AUTH_TEST){
		$authCheck = true;
	}
//}


if(false === $authCheck){
	#echo 'redirect<br>'.PHP_EOL;
	$response = array(
		'result' => null,
		'error' => array(
			'Code' => 100,
			'Message' => 'Failed To authenticate',
			'Data' => null,
		),
		'id' => null,
	
	);
	
	exit(json_encode($response));
}
#######################################
/*
if(false === $AUTH_TEST){
	if(true === $PAGE_TEST){
		echo 'IS WHITELIST';
	}elseif(false === $AUTH_TEST){
		echo 'redirect<br>'.PHP_EOL;
		echo __METHOD__.__LINE__.'$_SESSION<pre>['.var_export($_SESSION, true).']</pre>'.PHP_EOL; 
		exit;
		header('Location: http://'.$_SERVER['SERVER_NAME'].'/login.php');
	}
}
*/




?>
