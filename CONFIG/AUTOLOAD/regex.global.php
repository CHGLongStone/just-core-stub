<?php 
/**
* some basic regex for common preg_* operations
* MATCHES:  preg_match, preg_match_all is all we ( being the framework ) care about here
* any other regular expressions are going to be context specific
* you can create your own stored settings under 
* 	FILTERS: preg_filter
* 	REPLACE: preg_replace, preg_replace_callback, preg_replace_callback_array
* 
* Access via:
* 	$GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'REGEX', '[CONTECT NAME]');
* 
* general resources
*	http://webcheatsheet.com/php/regular_expressions.php
*	http://www.tutorialspoint.com/php/php_regular_expression.htm
*	http://www.regular-expressions.info/email.html
*	http://home.deds.nl/~aeron/regex/
* 
* testing (PHP/PCRE compliance) 
* https://regex101.com/#pcre 
*	  see the "regex tester" and "regex library"
*	
*/
return array(
    'REGEX' => array(
		'MATCHES' => array(
			'IPV4' => '/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/',
			'IPV6' => '/^(((?=(?>.*?(::))(?!.+\3)))\3?|([\dA-F]{1,4}(\3|:(?!$)|$)|\2))(?4){5}((?4){2}|((2[0-4]|1\d|[1-9])?\d|25[0-5])(\.(?7)){3})\z/i',
			#'IPV6' => '/^(((?=.*(::))(?!.*\3.+\3))\3?|([\dA-F]{1,4}(\3|:\b|$)|\2))(?4){5}((?4){2}|(((2[0-4]|1\d|[1-9])?\d|25[0-5])\.?\b){4})\z/ai',
			'POSTAL' => '/[^a-zA-Z0-9]+/',
			'TOP_LEVEL_DOMAIN' => '/^(?:(?:http[s]?|ftp):\/)?\/?(?:[^:\/\s]+?\.)*([^:\/\s]+\.[^:\/\s]+)/',
			'EMAIL_EXT' =>'/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i',
			'PHONE' => '/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/',
			'PHONE_EXT' => '^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$',
		),
	),
);
