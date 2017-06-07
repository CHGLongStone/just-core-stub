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
$DSN = 'JCORE';
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
		/*
		*/
		'LOGIN_SERVICE' => array(
			'AUTH_TYPE' => array(
				'USER' => array(
					'DSN' => $DSN,
					'table' => 'client_user',
					'pk_field' => 'client_user_pk',
					'foundation' => true,
					#'search' => array(
					#	'email' => $args["email"],
					#),
				),
				'SESSION' => array(
					'DSN' => $DSN,
					'table' => 'client_user',
					'pk_field' => 'client_user_pk',
					'foundation' => true,
					#'search' => array(
					#	'email' => $args["email"],
					#),
				),
				'API' => array(
					'DSN' => $DSN,
					'table' => 'client',
					'pk_field' => 'client_pk',
					'foundation' => true,
					#'search' => array(
					#	'email' => $args["email"],
					#),
				),
				
				
			),
		),
		'CRUDE_ACL_SCHEMES' => array(
			'VERY_STRICT' => array(
				'Order' => 'Deny,Allow',
				'Deny' => 'All',
				'Allow' => 'admin',
			),
			'MORE_STRICT' => array(
				'Order' => 'Deny,Allow',
				'Deny' => 'All',
				'Allow' => 'admin,super',
			),
			'STRICT' => array(
				'Order' => 'Deny,Allow',
				'Deny' => 'All',
				'Allow' => 'admin,super,legal_adviser,industry_adviser',
			),
			'PERMISSIVE' => array(
				'Order' => 'Allow,Deny',
				'Deny' => 'guest',
				'Allow' => 'All',
			),
			'VERY_PERMISSIVE' => array(
				'Order' => 'Allow,Deny',
				'Deny' => 'All',
				'Allow' => 'All',
			),
		),
		'ACL_ENTITY_CONTAINER' => array(
			'ROLE' => array(
				'DSN' => $DSN,
				'table' => 'user_role',
				'pk_field' => 'user_role_pk',
				'fk_field' => 'user_role_fk',
				'user_role' => 'role',
			),
			'RULE' => array(
				'DSN' => $DSN,
				'SELECT' => '*, rule_name AS rule',
				'table' => 'access_control_list',
				'pk_field' => 'access_control_list_pk',
				#'fk_field' => 'access_control_list_fk',
				'user_rule' => 'rule_name',
			),
		),
    ),
);

?>