<?php 

return array(
	"JCORE_LOG" => array(
		"JCORE" => array(
			"logFacility"=>"FILE",
			"writePath"=>"/var/log/",
			"logName"=>"JCORE_",
			"dateFormat"=>"Y-m-d H:i:s",
			"logSuffix"=>"log",
			"stripWhitespace"=>TRUE,
			"bufferWrite"=>FALSE,
			#;blockSize=[4096]
		),
		"JCORE_DATA_LOG" => array(
			"logFacility"=>"FILE",
			"writePath"=>"/var/log/",
			"logName"=>"JCORE_DATALOG_",
			"dateFormat"=>"Y-m-d H:i:s",
			"logSuffix"=>"log",
			"stripWhitespace"=>TRUE,
			"bufferWrite"=>FALSE,
			#;blockSize=[4096]
		),
		"JCORE_CACHE_LOG" => array(
			"logFacility"=>"FILE",
			"writePath"=>"/var/log/",
			"logName"=>"JCORE_CACHELOG_",
			"dateFormat"=>"Y-m-d H:i:s",
			"logSuffix"=>"log",
			"stripWhitespace"=>TRUE,
			"bufferWrite"=>FALSE,
			#;blockSize=[4096]
		),
		/*
		* settings per log type
		*-------------------------------
		* FILE
		*[DATA] 				LOGGING SERIVCE NAME
		*serviceType="FILE" 	DEFAULT "FILE" IF UNDEFINED

		*writePath="LOGS/db"	"FILE" [LOCAL] WRITE PATH, SHOULD BE UNDER /var/log/webkinz....
		*-------------------------------
		* UDP
		*serviceType="UDP" 
		*port=10050
		*host="127.0.0.1"
		*persist = FALSE/TRUE
		*------------------------------- 
		* SYSLOG
		*serviceType="SYSLOG" 	
		* 
		*-------------------------------
		*/
	)

);



?>