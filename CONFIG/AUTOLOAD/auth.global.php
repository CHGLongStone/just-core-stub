<?php 
/**
* examples using local host and standard internal network IP's 
* TODO:
* write a regex to compare by subnet mask rather than specific IP's
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
    ),
);

?>