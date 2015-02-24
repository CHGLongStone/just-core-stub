<?php
if (file_exists('vendor/autoload.php')) {
	#echo __FILE__.'@@@@@@@@'.__LINE__.'<br>';
    $loader = include 'vendor/autoload.php';
	#echo __FILE__.'@'.__LINE__.'loader<pre>'.var_export($loader, true).'</pre><br>';
	
	
	
	
	if(!isset($BOOTSTRAP)){
		
		/**
		* --- make this value is not set in the API/[name]/config.php 
		* if you do not have an opcode cache installed
		*
		*/
		#$BOOTSTRAP["CSN"] = JCORE_SYSTEM_CACHE;		
		$BOOTSTRAP["CACHE_SERIALIZATION"] = 'JSON'; //
		$BOOTSTRAP["UNSERIALIZE_TYPE"] = 'ARRAY'; //CACHE_SERIALIZATION-JSON[OBJECT/ARRAY] for json_decode
	}
	$GLOBALS["CONFIG_MANAGER"] = new JCORE\LOAD\CONFIG_MANAGER($args=$BOOTSTRAP);	
	#echo __FILE__.'@'.__LINE__.'GLOBALS["CONFIG_MANAGER"]<pre>'.var_export($GLOBALS["CONFIG_MANAGER"], true).'</pre><br>';
	$GLOBALS["CONFIG_MANAGER"]->loadConfig();
	
	#echo __FILE__.'@'.__LINE__.'GLOBALS["CONFIG_MANAGER"]<pre>'.var_export($GLOBALS["CONFIG_MANAGER"]->getSetting(), true).'</pre><br>';
	
	/*
	$LOAD_ID='EXT'; 
	$FILE_NAME='/home/jason/HVS/HVS_APPLICATION/CONFIG/AUTOLOAD';
	
	$GLOBALS["CONFIG_MANAGER"]->loadConfig($LOAD_ID, $FILE_NAME);
	*/
	
	echo __FILE__.'@'.__LINE__.'GLOBALS["CONFIG_MANAGER"]<pre>'.var_export($GLOBALS["CONFIG_MANAGER"]->getSetting(), true).'</pre><br>';
	$GLOBALS['LOG_ERROR'] = new JCORE\LOG\LOGGER(
		$GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE_LOG', $SECTION_NAME = 'JCORE')
	);
	$GLOBALS['LOG_DATA'] = new JCORE\LOG\LOGGER(
		$GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE_LOG', $SECTION_NAME = 'JCORE_DATA_LOG')
	);
	$GLOBALS['LOG_CACHE'] = new JCORE\LOG\LOGGER(
		$GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE_LOG', $SECTION_NAME = 'JCORE_CACHE_LOG')
	);

	$CACHECFG = $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'CACHE_SOURCE'); //, $SECTION_NAME = 'FOUNDATION'
	
	$getDSN = $GLOBALS["CONFIG_MANAGER"]->getSetting('DSN');
	#echo __FILE__.'@'.__LINE__.'DSN<pre>'.var_export($getDSN, true).'</pre><br>';
	$GLOBALS['DATA_API'] = new JCORE\DATA\API\DATA_API($getDSN);
	#echo __FILE__.'@'.__LINE__.'$GLOBALS["DATA_API"]<pre>'.var_export($GLOBALS["DATA_API"], true).'</pre><br>';
	
	/*
	#$getDSN = $GLOBALS["CONFIG_MANAGER"]->getSetting();
	#echo __FILE__.'@'.__LINE__.'DSN<pre>'.var_export($DSN, true).'</pre><br>';
	$GLOBALS["DSN"] = array();
	foreach($getDSN as $key => $value){
		echo __FILE__.'@'.__LINE__.'$key['.$key.']<pre>'.var_export($value, true).'</pre><br>';
		$GLOBALS["DSN"][$key] = $value;
	}
	echo __FILE__.'@'.__LINE__.'$GLOBALS["DSN"]<pre>'.var_export($GLOBALS["DSN"], true).'</pre><br>';
	$DATA_API = new JCORE\DATA\API\DATA_API($getDSN);
	echo __FILE__.'@'.__LINE__.'$DATA_API<pre>'.var_export($DATA_API, true).'</pre><br>';
	*/
	
}
?>