<?php 

return array(
	"CACHE" => array(
		/*
		"COMMON" => array( //this maps to the CSN [Cache Source Name]
			"CACHE_SERIALIZATION"=>"JSON", //JSON|NATIVE (PHP|Cache Lib)
			"UNSERIALIZE_TYPE"=>"ARRAY", //ARRAY|OBJECT
			"TYPE"=>"FILECACHE", //see examples below 
			"STATIC"=>FALSE, //use a static or concrete instance
		),
		
		"FILECACHE" => array( //this maps to the CSN [Cache Source Name]
			"DIRECTORIES"=>array( // contents are specific to the cache type, see below
				"CACHE" => array(
					"PATH"=>"CACHE/FILE/", //relative to install
					"RELATIVE"=>TRUE, 
				),
				"TEMP" => array(
					"PATH"=>"/var/tmp/", //absolute
					"RELATIVE"=>FALSE, 
				),
			),
		),
		
		"MEMCACHED" => array(
			[CACHE_POOL]
			CPN[] = "USER_OBJECT"
			;CPN[] = "FRAMEWORK_DATA"


			; to use the cache pools you must define 
			[USER_OBJECT]
			; we can include some high level settings for the cache pool here
			; whether or not to use settings in the named file CACHE_POOL/USER_OBJECT
			ACTIVE="TRUE" 
			; 
			STATUS="PROD" ; PROD/DEBUG/DEV
			; we may use something other than memcached
			CACHE_TYPE="MEMCACHED"
			; By default the Memcached instances are destroyed at the end of the request. 
			; To create an instance that persists between requests, use persistent_id to 
			; specify a unique ID for the instance. All instances created with the same 
			; persistent_id will share the same connection. 
			; http://us2.php.net/manual/en/memcached.construct.php
			; if PERSISTENT is set to TRUE (as a string) below this section name will be used 
			; as the  persistent_id 
			PERSISTENT="TRUE"
			DISTRIBUTION="DISTRIBUTION_CONSISTENT" ;DISTRIBUTION_MODULA
			OPT_LIBKETAMA_COMPATIBLE="TRUE"
			OPT_BINARY_PROTOCOL="TRUE"
			ACTIVE_SERVERS=2
			
			"SERVERS" => array(
				0 => array(
					"host" =>"127.0.0.1",
					"port" =>11211,
					"weight" =>"50" #weight in pool %
				),
				1 => array(
					"host" =>"192.168.0.1",
					"port" =>11211,
					"weight" =>"50" #weight in pool %
				), //...order MUST be consistent on all servers
			),
		),
		"REDIS" => array(
			
		),
		"OPCODE" => array(
			"EACCELERATOR" => array(),
			"APC" => array(),
			"XCACHE" => array(),
		),
		
		*/
		
	)

);



?>