<?php 

return array(
	"CACHE" => array(
		"JCORE_SYSTEM_CACHE" => array( //this maps to the CSN [Cache Source Name]
			"CSN" => "JCORE_SYSTEM_CACHE",
			"INSTANCE"=>"\JCORE\CACHE\FILECACHE_API", //see examples in cache.php 
			"IMPLEMENTATION"=>"any", //STATIC|any
			"TYPE"=>"FILECACHE", //see examples in cache.php  
			"STATIC"=>FALSE, //see examples in cache.php  
			"CACHE_SERIALIZATION"=>'JSON', //see examples in cache.php  
			"UNSERIALIZE_TYPE"=>'ARRAY', //see examples in cache.php  
			"DIRECTORIES"=>array( // contents are specific to the cache type, see in cache.php 
				"CACHE" => array(
					"PATH"=>"CACHE/FILE/", //relative to install requires $APPLICATION_ROOT be set 
					"RELATIVE"=>TRUE, 
				),
			),
		),	
	)

);



?>