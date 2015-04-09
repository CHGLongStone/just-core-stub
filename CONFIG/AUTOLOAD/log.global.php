<?php 

return array(
	"JCORE_LOG" => array(
		"JCORE" => array(
			"logFacility"=>"FILE",
			"writePath"=>"/var/log/httpd/",
			"logName"=>"JCORE_",
			"dateFormat"=>"Y-m-d H:i:s",
			"dateFormatFile"=>"Y-m-d",
			"logSuffix"=>"log",
			"stripWhitespace"=>TRUE,
			"bufferWrite"=>FALSE,
			#;blockSize=[4096]
		),
		"JCORE_DATA_LOG" => array(
			"logFacility"=>"FILE",
			"writePath"=>"/var/log/httpd/",
			"logName"=>"JCORE_DATALOG_",
			"dateFormat"=>"Y-m-d H:i:s",
			"dateFormatFile"=>"Y-m-d",
			"logSuffix"=>"log",
			"stripWhitespace"=>TRUE,
			"bufferWrite"=>FALSE,
			#;blockSize=[4096]
		),
		"JCORE_CACHE_LOG" => array(
			"logFacility"=>"FILE",
			"writePath"=>"/var/log/httpd/",
			"logName"=>"JCORE_CACHELOG_",
			"dateFormat"=>"Y-m-d H:i:s",
			"dateFormatFile"=>"Y-m-d",
			"logSuffix"=>"log",
			"stripWhitespace"=>TRUE,
			"bufferWrite"=>FALSE,
			#;blockSize=[4096]
		),
	)

);



?>