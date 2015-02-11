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
		#$BOOTSTRAP["CSN"] = JCORE_SYSTEM_CACHE;		
		$BOOTSTRAP["CACHE_SERIALIZATION"] = 'JSON'; //
		$BOOTSTRAP["UNSERIALIZE_TYPE"] = 'ARRAY'; //CACHE_SERIALIZATION-JSON[OBJECT/ARRAY] for json_decode
	}
	$GLOBALS["CONFIG_MANAGER"] = new JCORE\LOAD\CONFIG_MANAGER($args=$BOOTSTRAP);	
	#echo __FILE__.'@'.__LINE__.'GLOBALS["CONFIG_MANAGER"]<pre>'.var_export($GLOBALS["CONFIG_MANAGER"], true).'</pre><br>';
	$GLOBALS["CONFIG_MANAGER"]->loadConfig();
	
	#echo __FILE__.'@'.__LINE__.'GLOBALS["CONFIG_MANAGER"]<pre>'.var_export($GLOBALS["CONFIG_MANAGER"]->getSetting(), true).'</pre><br>';
	
	$LOAD_ID='EXT'; 
	$FILE_NAME='/home/jason/HVS/HVS_APPLICATION/CONFIG/AUTOLOAD';
	
	$GLOBALS["CONFIG_MANAGER"]->loadConfig($LOAD_ID, $FILE_NAME);
	
	#echo __FILE__.'@'.__LINE__.'GLOBALS["CONFIG_MANAGER"]<pre>'.var_export($GLOBALS["CONFIG_MANAGER"]->getSetting(), true).'</pre><br>';

}
?>