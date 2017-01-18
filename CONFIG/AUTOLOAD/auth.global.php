<?php 
/**
* examples using local host and standard internal network IP's 
* integrated this project as a user auth baseline
* https://github.com/hautelook/phpass
*
* TODO:
* write a regex to compare by subnet mask rather than specific IP's
*
*/

return array(
    'AUTH' => array(
		'IP_WHITELIST' => array(
			'GLOBAL' => array(
				'127.0.0.1',
				'192.168.0.1',
				'10.0.0.1',
			),
			'SERVICES' => array(
				'SERVICE\CRUD\CRUD' => array(
					'127.0.0.1',
					'192.168.0.1',
					'10.0.0.1',
				),
			),
		),
		'PAGE_FILTER_ALLOW_PUBLIC' => array(
			'FILTER_TYPE' => 'WHITELIST',
			'ALLOW' => array(
				'login.php',
				'logout.php',
				'signup.php',
			),
			'DENY' => array(),
		),
		/*
		*/
		'PAGE_FILTER_DENY_PUBLIC' => array(
			'FILTER_TYPE' => 'BLACKLIST',
			'DENY' => array(
				'profile.php',
				'history.php',
				'personal.php',
			),
		),
		
    ),
);

?>