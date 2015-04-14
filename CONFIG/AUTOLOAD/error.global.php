<?php 

return array(
    'ERROR' => array(
		'0' => 'Undefined Error',
		'1' => 'test error',
		// JCORE
		'100' => 'AUTH ERROR',
		'110' => 'CACHE ERROR',
		'120' => 'DAO ERROR',
		'130' => 'DATA ERROR',
		'140' => 'LOG ERROR',
		'150' => 'LOAD ERROR',
		'160' => 'TRANSPORT ERROR',
		'170' => 'SERVICE ERROR',
		
		// User
		'1000' => 'User does not exist',
		//Application
		'2000' => 'User does not exist',
		//network
		'3000' => 'User does not exist',
		//JSON-RPC 2.0
		'32700' => 'Parse error	Invalid JSON was received by the server. An error occurred on the server while parsing the JSON text.',
		'32600' => 'Invalid Request	The JSON sent is not a valid Request object.',
		'32601' => 'Method not found	The method does not exist / is not available.',
		'32602' => 'Invalid params	Invalid method parameter(s).',
		'32603' => 'Internal error	Internal JSON-RPC error.',
		'32000' => 'Server error	Reserved for implementation-defined server-errors.',
		'32001' => '......',
		'32099' => '/ENDServer error',

		
    ),

);

?>