<?php 

/* 
* test DB object
echo __FILE__.'@'.__LINE__.'$GLOBALS["DATA_API"]<pre>'.var_export($GLOBALS["DATA_API"], true).'</pre><br>';
*/
$DSN = 'TL';
$tableName = 'order';
$query = 'SELECT * FROM ContactType;';
$result = $GLOBALS["DATA_API"]->retrieve($DSN, $query, $args=array('returnArray' => true));
echo __FILE__.'@'.__LINE__.'$result<pre>'.var_export($result, true).'</pre><br>';
#echo __FILE__.'@'.__LINE__.'$GLOBALS["DATA_API"]<pre>'.var_export($GLOBALS["DATA_API"], true).'</pre><br>';
/**
$tableDef = $GLOBALS["DATA_API"]->introspectTable($DSN, $tableName);
*/
#echo __FILE__.'@'.__LINE__.'$tableDef<pre>'.var_export($tableDef, true).'</pre><br>';

$config = array(
	"DSN" => "TL",
	#"database" => "hvs_dev",
	"table" => "ContactType",
	"pk_field" => "id",
	"pk" => 1,
);

#exit;
#echo __FILE__.'@'.__LINE__.'$config<pre>'.var_export($config, true).'</pre><br>';
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
	"DSN" => "TL",
	"table" => "ContactType",
	"table" => "Status",
	/*
	"pk_field" => "id",
	"pk" => 1,
	*/
);
$DAO2 = new JCORE\DAO\DAO($config);
$DAO2->initialize($config["DSN"], $config["table"]);

/**
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
*/
#JCORE DATE FORMAT_TIMESTAMP

$DATE_FORMATS =  $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE', $SECTION_NAME = 'DATE');

$timestamp = date($DATE_FORMATS["FORMAT_TIMESTAMP"]);

echo __FILE__.'@'.__LINE__.'$timestamp<pre>'.var_export($timestamp, true).'</pre><br>';

//Id`,`status`,`sortOrder`
$field = 'status'; 
$value = 'omgwdf';
$DAO2->set($config["table"], $field, $value);

$field = 'sortOrder'; 
$value = 10;
$DAO2->set($config["table"], $field, $value);

echo __FILE__.'@'.__LINE__.'$DAO2<pre>'.var_export($DAO2, true).'</pre><br>';


/*
--> { "method": "echo", "params": ["Hello JSON-RPC"], "id": 1}
<-- { "result": "Hello JSON-RPC", "error": null, "id": 1}
*/
?>