<?php
if (file_exists('vendor/autoload.php')) {
	#echo __FILE__.'@@@@@@@@'.__LINE__.'<br>';
    $loader = include 'vendor/autoload.php';

	if(!isset($BOOTSTRAP)){	

		/**
		* --- make this value is not set in the API/[name]/config.php 
		* if you do not have an opcode cache installed
		*
		*/
		$BOOTSTRAP["CSN"] = "JCORE_SYSTEM_CACHE";		
		$BOOTSTRAP["CACHE_SERIALIZATION"] = 'JSON'; //
		$BOOTSTRAP["UNSERIALIZE_TYPE"] = 'ARRAY'; //CACHE_SERIALIZATION-JSON[OBJECT/ARRAY] for json_decode
	}
	$GLOBALS["CONFIG_MANAGER"] = new JCORE\LOAD\CONFIG_MANAGER($args=$BOOTSTRAP);	

	/***
	* load all of the config files
	*/
	$GLOBALS["CONFIG_MANAGER"]->loadConfig();
	
	/***
	* set up the loggers 
	*/
	$GLOBALS['LOG_ERROR'] = new JCORE\LOG\LOGGER(
		$GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE_LOG', $SECTION_NAME = 'JCORE')
	);
	$GLOBALS['LOG_DATA'] = new JCORE\LOG\LOGGER(
		$GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE_LOG', $SECTION_NAME = 'JCORE_DATA_LOG')
	);
	$GLOBALS['LOG_CACHE'] = new JCORE\LOG\LOGGER(
		$GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'JCORE_LOG', $SECTION_NAME = 'JCORE_CACHE_LOG')
	);

	/***
	* set up the cache 
	*/
	$CACHECFG = $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'CACHE_SOURCE'); //, $SECTION_NAME = 'FOUNDATION'
	

	$getCSN = $GLOBALS["CONFIG_MANAGER"]->getSetting('CACHE','JCORE_SYSTEM_CACHE');
	$GLOBALS["CONFIG_MANAGER"]->setCache($getCSN);
	#echo __FILE__.'@'.__LINE__.'$GLOBALS["CONFIG_MANAGER"]->getSetting()<pre>'.var_export($GLOBALS["CONFIG_MANAGER"]->getSetting(), true).'</pre><br>';

	

	/***
	* initialize the DB connectors 
	*/	
	$getDSN = $GLOBALS["CONFIG_MANAGER"]->getSetting('DSN');


	$GLOBALS['DATA_API'] = new JCORE\DATA\API\DATA_API($getDSN);

	
	/*









	echo __FILE__.'@'.__LINE__.'$GLOBALS["DATA_API"]<pre>'.var_export($GLOBALS["DATA_API"], true).'</pre><br>';
	*/
	
}
?>