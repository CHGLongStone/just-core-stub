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
		/*
		* see constructor here:
		* https://github.com/hautelook/phpass/blob/master/src/Hautelook/Phpass/PasswordHash.php
		* http://www.openwall.com/phpass/
		*/
		'PHPASS' => array(
			'FORM1' => array( //these are profile sections 
				'iteration_count_log2' => 8, 
				'portable_hashes' => false,
				'DSN' =>	'blackwatch',
				'TABLE_NAME' =>	'client',
				'USR_COLUMN' =>	'user_name',
				'PWD_COLUMN' =>	'password',
				'FORM_USR' =>	'usr',
				'FORM_PWD' =>	'pwd',
			),
		),
    ),
);

?>