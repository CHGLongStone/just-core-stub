<?php
/*****
$_SERVER<pre>[array (
  'SHELL' => '/bin/sh',
  'USER' => 'user',
  'PATH' => '/usr/bin:/bin',
  'PWD' => '/home/user',
  'LANG' => 'en_US',
  'SHLVL' => '1',
  'HOME' => '/home/user',
  'LOGNAME' => 'user',
  '_' => '/usr/local/bin/php',
  'PHP_SELF' => '[path to]/just-core/APIS/CLI/test.php',
  'SCRIPT_NAME' => '[path to]/just-core/APIS/CLI/test.php',
  'SCRIPT_FILENAME' => '[path to]/just-core/APIS/CLI/test.php',
  'PATH_TRANSLATED' => '[path to]/just-core/APIS/CLI/test.php',
  'DOCUMENT_ROOT' => '',
  'REQUEST_TIME' => 1482890161,
  'argv' => 
  array (
    0 => '/var/www/vhosts/just-core/APIS/CLI/test.php',
  ),
  'argc' => 1,
*/
if (php_sapi_name() != "cli") {
	echo ' php_sapi_name['.php_sapi_name().']'.PHP_EOL;
	exit('FaakUff');
} 

if (isset($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] != 'production') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

$APPLICATION_ROOT = dirname(dirname(__DIR__)).'/';
chdir($APPLICATION_ROOT);

if (file_exists('init.php')) {
    include 'init.php';
}else{
	die('
	application not initialized, your relative path<br>'.PHP_EOL.' 
	from your API to your base install has not been calculated correctly<br>'.PHP_EOL.'
	in the APPLICATION_ROOT variable
	');
}

echo 'DO JOBs '.date("Y-m-d H:i:s").PHP_EOL;
echo __METHOD__.__LINE__.'$_ENV<pre>['.var_export($_ENV, true).']</pre>'.PHP_EOL;  
echo __METHOD__.__LINE__.'$_SERVER<pre>['.var_export($_SERVER, true).']</pre>'.PHP_EOL.PHP_EOL.PHP_EOL;  

?>