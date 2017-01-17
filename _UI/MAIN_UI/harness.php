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
 * @package	JCORE
 * @subpackage	API_STUB_AJAX
 */
/**
* ***FIRST***
* repeat this block (or some semblance) for any file with HTTP access that 
* you don't want loaded directly
* exit with an error for automated testing
*/
/*
echo 'strstr('.__FILE__.', '.$_SERVER['REQUEST_URI'].')<pre>['.strstr(__FILE__, $_SERVER["REQUEST_URI"]).']['.is_bool(strstr(__FILE__, $_SERVER["REQUEST_URI"])).']</pre>'.PHP_EOL;
echo 'strstr('.__FILE__.', '.$_SERVER['SCRIPT_NAME'].')<pre>['.strstr(__FILE__, $_SERVER["SCRIPT_NAME"]).']</pre>'.PHP_EOL;
echo 'strstr('.__FILE__.', '.$_SERVER['PHP_SELF'].')<pre>['.strstr(__FILE__, $_SERVER["PHP_SELF"]).']</pre>'.PHP_EOL;
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
 * *** TEST_APPLICATION_INSTALL ***
 * Display all errors when APPLICATION_ENV is development.
 * set in .htaccess in this directory 
 * 
 */
if (
	isset($_SERVER['APPLICATION_ENV']) 
	&& 
	(
		strtolower($_SERVER['APPLICATION_ENV']) == 'development'
		||
		strtolower($_SERVER['APPLICATION_ENV']) == 'dev'
	)
	
) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
	/*
	echo __FILE__.'@'.__LINE__.' $_SERVER["APPLICATION_ENV"] ['.$_SERVER['APPLICATION_ENV'].']<br>'.PHP_EOL;
	echo __FILE__.'@'.__LINE__.' 
		you need to read the *TEST_APPLICATION_INSTALL* notes above this line then comment this out<br><br>
		test your installation <a href="test.php" >here:</a>
	';
	*/
	
}elseif(!isset($_SERVER['APPLICATION_ENV'])){
	/*
	echo __FILE__.'@'.__LINE__.' 
		check your .htaccess file and make sure the APPLICATION_ENV is set'.PHP_EOL.'
		COMMENT THIS SECTION AFTER INSTALLATION
	';
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
* verify we want to display the page at all, then move on to something useful 
*/
if (file_exists('update.php')) {
	@include 'update.php';
}

/**
* init.php is the bootstrap located in the APPLICATION_ROOT dir
* configuration files are in  /CONFIG/AUTOLOAD dir 
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
* 	***THEN***
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
if(true !== $AUTH_HARNESS->register('JCORE\SERVICE\AUTH\LOGIN_SERVICE')){
	die('failed to load LOGIN_SERVICE');
}
if(true !== $AUTH_HARNESS->register('JCORE\SERVICE\AUTH\PAGE_FILTER')){
	die('failed to load PAGE_FILTER');
}



/**
* call our authentication method/service, we're only looking for a boolean response
* for a basic website, for an API we'll do a different hook forcing 
* authentication at the header level or in the transport request
* 
*/
$AUTH_TEST = true; //add your hook here
/*
	$authCheckType = 'SESSION';
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
*/	
$AUTH_TEST = $AUTH_HARNESS->authenticate(
	'JCORE\SERVICE\AUTH\LOGIN_SERVICE',
	array(
		'AUTH_TYPE' => 'SESSION'
	)
);
	

/*
echo 'strstr('.$_SERVER["REQUEST_URI"].', '.$LOGIN_PAGE.')<pre>['.strstr($_SERVER["REQUEST_URI"], $LOGIN_PAGE).']</pre>'.PHP_EOL;
echo 'strstr('.$_SERVER["SCRIPT_NAME"].', '.$LOGIN_PAGE.')<pre>['.strstr($_SERVER["REQUEST_URI"], $LOGIN_PAGE).']</pre>'.PHP_EOL;
echo 'strstr('.$_SERVER["PHP_SELF"].', '.$LOGIN_PAGE.')<pre>['.strstr($_SERVER["REQUEST_URI"], $LOGIN_PAGE).']</pre>'.PHP_EOL;
*/
/**
* pages not to lock out
* login, signup, logout
* 
*/
$PAGE_HOOKS = $GLOBALS["CONFIG_MANAGER"]->getSetting('AUTH','PAGE_FILTER_ALLOW_PUBLIC');

$PAGE_TEST = $AUTH_HARNESS->authenticate('JCORE\SERVICE\AUTH\PAGE_FILTER',$PAGE_HOOKS);
#######################################
/**
* setting this value here so it can be used later
*/
(isset($_SERVER['HTTPS']) && 'on' == $_SERVER['HTTPS'])? $httpype = 'https' : $httpype = 'http';
#echo ' restrictive mode...pass the white list first, then check credentials<br>'.PHP_EOL;
if(true === $PAGE_TEST){
	#$passed = true;
}else{
	#echo ' run a secondary auth test<br>'.PHP_EOL;
	if(false === $AUTH_TEST){
		/**
		echo 'redirect<br>'.PHP_EOL;
		echo __METHOD__.__LINE__.'$_SESSION<pre>['.var_export($_SESSION, true).']</pre>'.PHP_EOL; 
		exit;
		*/
		/**
		* force the login to go to HTTPS, everything subsequent will be forced to HTTPS
		*/
		header('Location: https://'.$_SERVER['SERVER_NAME'].'/login.php');
		exit;
	}
}

/**
* We've added the application level auth harness and verified the user is allowed access
* now we'll add a VERY BASIC RBAC (Role Based Access Control)
* 
	$GLOBALS["RBAC"]->authorize($params);
	$params = array(
		'order' => 'allow',
		'role' => 'super',
		'rule' => 'admin_access',
	);
*/

$RBAC = new JCORE\AUTH\CRUDE_ACL();

/**
* We'll also add an Audit service here 
* now we'll add a VERY BASIC RBAC (Role Based Access Control)
* 
	$GLOBALS["RBAC"]->authorize($params);
	$params = array(
		'order' => 'allow',
		'role' => 'super',
		'rule' => 'admin_access',
	);

$CLIENT_LOG = new SERVICE\ADMIN\AUDIT();
#echo __METHOD__.__LINE__.'$GLOBALS["CONFIG_MANAGER"]->getSetting("AUTH","AUDIT","CLIENT_LOG")<pre>['.var_export($GLOBALS["CONFIG_MANAGER"]->getSetting('AUTH','AUDIT','CLIENT_LOG'), true).']</pre>'.PHP_EOL; 

$CLIENT_LOG->init(
	$GLOBALS["CONFIG_MANAGER"]->getSetting('AUTH','AUDIT','CLIENT_LOG')
);
*/


/*
password_hash("rasmuslerdorf", PASSWORD_DEFAULT)
setcookie(
	$name = session_name(),
	$value = session_id(),
	$expire = time()+600,
	$path = '/',
	$domain = $_SERVER['SERVER_NAME'],
	$secure = true,
	$httponly = FALSE,
);
*/
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


/**
* TEMPLATE SET UP
* we test for session/cookie/nonce what ever here an do a redirect to our authentication page
* we add a condition to ensure we don't have an endless redirect with an unauthenticated user
* set some data
*/

	$TEMPLATER_DATA = $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'TEMPLATER');
	define ("JCORE_TEMPLATES_DIR", 	$TEMPLATER_DATA["TEMPLATES_DIR"]);

	$TEMPLATER = new JCORE\TEMPLATER\TEMPLATER();
	/*



	* MUST DEFINE TEMPLATE NAME SPACE
	* subtemplates?
	* 
	$ps_template_header = 'header';
	$ps_template_body 	= 'body';
	$ps_template_footer = 'footer';
	$ps_template_service = '1service';

	$header_footer_set = true;

	$TEMPLATER->set_filenames(array($ps_template_header => JCORE_TEMPLATES_DIR.'HTML/BASIC/header.html'));
	$TEMPLATER->set_filenames(array($ps_template_footer => JCORE_TEMPLATES_DIR.'HTML/BASIC/footer.html'));
	$TEMPLATER->set_filenames(array($ps_template_service => JCORE_TEMPLATES_DIR.'JS/form_service_method.js'));
	


	
	$TEMPLATER->assign_vars( array(	
		'FOOTER' => 'FOOTER'
	));	

	$TEMPLATER->assign_block_vars('HEAD_SCRIPT', array(	
		'SRC'	=> '  src="./assets/js/jquery-2.1.4.min.js"', 
		#'TYPE'	=> ' type="text/javascript" ',
		'BODY'	=> ''
	));
	$TEMPLATER->assign_block_vars('HEAD_SCRIPT', array(	
		'SRC'	=> '  src="./assets/js/bootstrap.min.js"', 
		#'TYPE'	=> ' type="text/javascript" ',
		'BODY'	=> ''
	));

	*/ 
#echo 'here: '.__FILE__.'@'.__LINE__.' $GLOBALS==<pre>'.var_export($_SERVER, true).'</pre><br>';


$GLOBALS["ASSETIC_WRAPPER"] = new JCORE\SERVICE\HTTP_OPTIMIZATION\ASSETIC\ASSETIC_WRAPPER(); 

$GLOBALS["ASSETIC_WRAPPER"]->flushCache();
$GLOBALS["ASSETIC_WRAPPER"]->pauseCache();
/*
$GLOBALS["ASSETIC_WRAPPER"]->enableCache();
*/
?>
