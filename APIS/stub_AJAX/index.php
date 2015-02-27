<?php
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
/**
* config.php is specific for the API, can/should be shared with loadable files in ths directory
* JCORE specific settings are in the JCORE/CORE/CONFIG dir in ini files
* settings in this config file are specific to the files loaded in this directory
*/

#echo __FILE__.'@'.__LINE__.'<br>';
#require_once('config.php');
$pluginList = array(
	'AJAX_STUB',
	'THEMEMANAGER'
	
);
/**
echo __FILE__.'@'.__LINE__.'dirname<pre>'.var_export(dirname(__DIR__), true).'</pre><br>';
echo __FILE__.'@'.__LINE__.'dirname->dirname<pre>'.var_export(dirname(dirname(__DIR__)), true).'</pre><br>';

echo __FILE__.'@'.__LINE__.'__DIR__::'.__DIR__.'<br>';
echo __FILE__.'@'.__LINE__.'getcwd()::'.getcwd().'<br>';
*/
$APPLICATION_ROOT = dirname(dirname(__DIR__)).'/';
chdir($APPLICATION_ROOT);
/**
echo __FILE__.'@'.__LINE__.'__DIR__::'.__DIR__.'<br>';
echo __FILE__.'@'.__LINE__.'getcwd()::'.getcwd().'<br>';
*/


if (file_exists('init.php')) {
    include 'init.php';
}
#echo __FILE__.'@'.__LINE__.'loader<pre>'.var_export($loader, true).'</pre><br>';
#echo __FILE__.'@'.__LINE__.'loader get_class_methods<pre>'.var_export(get_class_methods($loader), true).'</pre><br>';

echo __FILE__.'@'.__LINE__.'<br>';
/*
* load the transport layer
*/

/*
* load the  service layer
*/

#$AJAXObj = new AJAX_STUB();
#$loader->add('JCORE\TRANSPORT\JSON\JSONRPC_1_0_API', 'vendor/just-core/foundation/CORE');
#$loader->loadClass('JCORE\TRANSPORT\JSONRPC_1_0_API');
#$JSONRPC_1_0_API = new JCORE\TRANSPORT\JSON\JSONRPC_1_0_API();

#echo __FILE__.'@'.__LINE__.'<br>';

#echo __FILE__.'@'.__LINE__.'AJAXObj<pre>'.var_export($AJAXObj, true).'</pre><br>';

/*
echo __FILE__.'@'.__LINE__.'$_SERVER["QUERY_STRING"]<pre>'.print_r($_SERVER["QUERY_STRING"], true).'</pre><br>';
echo __FILE__.'@'.__LINE__.'<br>';
echo __FILE__.'@'.__LINE__.'<br>';

echo __FILE__.'@'.__LINE__.'__DIR__::'.__DIR__.'<br>';
echo __FILE__.'@'.__LINE__.'dirname(__DIR__)::'.dirname(__DIR__).'<br>';
echo __FILE__.'@'.__LINE__.'dirname(dirname(__DIR__))::'.dirname(dirname(__DIR__)).'<br>';

$pattern = '/CONFIG/AUTOLOAD/{,*.}{global,local}.php';
$pattern = dirname(dirname(__DIR__)).'/CONFIG/AUTOLOAD/{,*.}{global,local}.php';
$pattern = dirname(dirname(__DIR__)).'/CONFIG/AUTOLOAD/*{global,local}.php';
echo __FILE__.'@'.__LINE__.'pattern::'.$pattern.'<br>';

echo __FILE__.'@'.__LINE__.'pattern::'.preg_replace('/(\*|\?|\[)/', '[$1]', $pattern).'<br>';
/home/jason/orgrepo/just-core-stub/CONFIG/AUTOLOAD/
/home/jason/orgrepo/just-core-stub/CONFIG/AUTOLOAD/{,*.}{global,local}.php
echo __FILE__.'@'.__LINE__.'pattern::'.$pattern.'<br>';
$fileList = glob($pattern,GLOB_BRACE);

$pattern = dirname(dirname(__DIR__)).'/CONFIG/AUTOLOAD/*{global,local}.php';
echo __FILE__.'@'.__LINE__.'pattern::'.$pattern.'<br>';
$fileList = glob($pattern,GLOB_BRACE);
echo __FILE__.'@'.__LINE__.'fileList<pre>'.var_export($fileList, true).'</pre><br>';
*/

/*****
* test error object
$error =  array();
$error['Code'] = 32700;
$error['Code'] = 32001;
$error['Message'] = 'some shit';
#$error['Data'] = 'put data here, test flag for back trace';
$error['Data'] = null;
echo __FILE__.'@'.__LINE__.'<br>';
$ERROR = new JCORE\EXCEPTION\ERROR($error);
echo __FILE__.'@'.__LINE__.'$ERROR<pre>'.var_export($ERROR->getError($AsJSON = true), true).'</pre><br>';
if( is_array($ERROR->getError($AsJSON = false)) ){
	echo 'is_array';
	
}
*/


/* 
* test DB object
echo __FILE__.'@'.__LINE__.'$GLOBALS["DATA_API"]<pre>'.var_export($GLOBALS["DATA_API"], true).'</pre><br>';
*/
$DSN = 'HVS';
$tableName = 'order';
$query = 'SELECT * FROM client;';
$result = $GLOBALS["DATA_API"]->retrieve($DSN, $query, $args=array('returnArray' => true));
echo __FILE__.'@'.__LINE__.'$result<pre>'.var_export($result, true).'</pre><br>';
#echo __FILE__.'@'.__LINE__.'$GLOBALS["DATA_API"]<pre>'.var_export($GLOBALS["DATA_API"], true).'</pre><br>';
/**
$tableDef = $GLOBALS["DATA_API"]->introspectTable($DSN, $tableName);
*/
#echo __FILE__.'@'.__LINE__.'$tableDef<pre>'.var_export($tableDef, true).'</pre><br>';

$config = array(
	"DSN" => "HVS",
	#"database" => "hvs_dev",
	"table" => "client",
	"pk_field" => "id",
	"pk" => 1,
);

#exit;
echo __FILE__.'@'.__LINE__.'$config<pre>'.var_export($config, true).'</pre><br>';
$DAO = new JCORE\DAO\DAO($config);



/*
 * $OBJECT->get(table, field);				//entity
 * $OBJECT->set(table, field, value); 		//entity
 *
 *
 
$config = array(
	"DSN" => "HVSPROD",
	#"database" => "hvs_dev",
	"table" => "cross_dock_location",
	"table" => "client",
	
	#"pk_field" => "id",
	#"pk" => 1,
);
 
$DAO2 = new JCORE\DAO\DAO($config);
$DAO2->initialize($config["DSN"], $config["table"]);

$table ='client';
$field = 'short_name'; 
$value = 'short_name';
$DAO2->set($table, $field, $value);

$field = 'long_name'; 
$value = 'long_name';
$DAO2->set($table, $field, $value);

$field = 'description'; 
$value = 'description';
$DAO2->set($table, $field, $value);
echo __FILE__.'@'.__LINE__.'$DAO2<pre>'.var_export($DAO2, true).'</pre><br>';
#$DAO2->save($table);
*/

$config = array(
	"DSN" => "HVSPROD",
	"table" => "client",
	"table" => "address",
	/*
	"pk_field" => "id",
	"pk" => 1,
	*/
);
$DAO2 = new JCORE\DAO\DAO($config);
$DAO2->initialize($config["DSN"], $config["table"]);


$field = 'client_id'; 
$value = 1;
$DAO2->set($config["table"], $field, $value);

$field = 'address'; 
$value = '123 some street';
$DAO2->set($config["table"], $field, $value);

$field = 'city'; 
$value = 'suckville';
$DAO2->set($config["table"], $field, $value);

$field = 'postal_code'; 
$value = '12345';
$DAO2->set($config["table"], $field, $value);


$field = 'region'; 
$value = 'east';
$DAO2->set($config["table"], $field, $value);


$field = 'country'; 
$value = 'CA';
$DAO2->set($config["table"], $field, $value);
#JCORE DATE FORMAT_TIMESTAMP

$DATE_FORMATS =  $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE', $SECTION_NAME = 'DATE');

$timestamp = date($DATE_FORMATS["FORMAT_TIMESTAMP"]);

echo __FILE__.'@'.__LINE__.'$timestamp<pre>'.var_export($timestamp, true).'</pre><br>';

$field = 'created'; 
$value = $timestamp;
$DAO2->set($config["table"], $field, $value);

$field = 'updated'; 
$value = $timestamp;
$DAO2->set($config["table"], $field, $value);

echo __FILE__.'@'.__LINE__.'$DAO2<pre>'.var_export($DAO2, true).'</pre><br>';


/*
--> { "method": "echo", "params": ["Hello JSON-RPC"], "id": 1}
<-- { "result": "Hello JSON-RPC", "error": null, "id": 1}
*/













?>