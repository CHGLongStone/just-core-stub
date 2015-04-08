<?php
/**
 * update
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE
 * @subpackage	API_STUB_AJAX
 */



/**
 * update
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE
 * @subpackage	API_STUB_AJAX
 */
 
/**
 * Display all errors when APPLICATION_ENV is development.
 */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
if (isset($_SERVER['APPLICATION_ENV']) && $_SERVER['APPLICATION_ENV'] != 'production') {
	echo __FILE__.'@'.__LINE__.'<br>';
}

$APPLICATION_ROOT = dirname(dirname(dirname(__DIR__))).'/';
chdir($APPLICATION_ROOT);
#echo __FILE__.'@'.__LINE__.'APPLICATION_ROOT'.var_export($APPLICATION_ROOT, true).PHP_EOL;
/**
 * the harness
 */
if (file_exists('init.php')) {
    include 'init.php';
}
/***
* example files
*/

require_once('DAO_example.php');





?>