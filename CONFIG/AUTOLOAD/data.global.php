<?php 
return array(
	"DSN" => array(
		/**
		* if you change the DSN key from JCORE 
		* you must also change the $DSN value in auth.{local/global}.php
		* where you can also specify different DSN for specific services
		*/
		"JCORE" => array(
			"dbType"=>"MySQL",
			#implementation=>"mysql",
			"host"=>"127.0.0.1",
			"port"=>3306,
			"database"=>"JCORE",
			"username"=>"jcore",
			"password"=>"jcore",
			"persistent"=>"true",
		)
	)
);
?>