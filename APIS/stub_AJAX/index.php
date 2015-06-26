<?php
/**
 * update
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE
 * @subpackage	API_STUB_AJAX
 */
 
/**
 * Display all errors when APPLICATION_ENV is development.
 * set in .htaccess in this directory 
 * 
 */
if (isset($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] != 'production') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
	/*
	*/
	echo __FILE__.'@'.__LINE__.' 
		you need to read the notes above this line then comment it out<br>
		test your installation <a href="test.php" >here:</a>
	';
	
}
/**
 * Set the APPLICATION_ROOT, calculated from current dir
 */

$APPLICATION_ROOT = dirname(dirname(__DIR__)).'/';
chdir($APPLICATION_ROOT);



/**
* init.php is the bootstrap located in the APPLICATION_ROOT dir
* configuration files are in  /CONFIG/AUTOLOAD dir 
* these use the "return array()" format
* all configurations are retrieved and stored using CONFIG_MANAGER
*/
if (file_exists('init.php')) {
    include 'init.php';
}



/**
* throw the auth harness in here
* put a hook in for HTTP basic, IP whitelist or full ACL
*/

 
 /**
* set headers
 */
header("Access-Control-Allow-Origin: *.teamleads.com");
$file = '/var/log/httpd/ajax.log';
$raw_data = file_get_contents('php://input');
if("%5C" == substr($raw_data, 0,2) ){
	
}
$raw_data = urldecode($raw_data);

file_put_contents($file, $raw_data."\r\n", FILE_APPEND);

/*
#echo __METHOD__.__LINE__.'$raw_data['.var_export($raw_data,true).']'.PHP_EOL;
#echo __METHOD__.__LINE__.'$_POST['.var_dump($_POST,true).']'.PHP_EOL;
echo __METHOD__.__LINE__.'$_GET<pre>['.var_dump($_GET,true).']</pre>'.PHP_EOL;
echo __METHOD__.__LINE__.'$_REQUEST<pre>['.var_dump($_REQUEST,true).']</pre>'.PHP_EOL;
echo __METHOD__.__LINE__.'$_SERVER<pre>['.var_dump($_SERVER,true).']</pre>'.PHP_EOL;
echo __METHOD__.__LINE__.'$GLOBALS<pre>['.var_dump($GLOBALS,true).']</pre>'.PHP_EOL;
echo __METHOD__.__LINE__.'$GLOBALS<pre>['.var_dump(array_keys ($GLOBALS),true).']</pre>'.PHP_EOL;
*/

$SERVICECALL = new \JCORE\TRANSPORT\JSON\JSONRPC_1_0_API;

$responseString = var_export($SERVICECALL, true);
#$file = '/var/log/httpd/ajax.log';
file_put_contents($file, $responseString."\r\n", FILE_APPEND);















?>