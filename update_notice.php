<?php 
/**
* make the contents of this page what ever you want
* or make multiple versions (per API) 
* the release script(1) will copy this file to update.php, if update.php exists 
* the API's harness.php should call this file before doing anything else
* 1) just-core-scripts/update_production.sh
* 
*/

 /**
* set headers
 */
header("Access-Control-Allow-Origin: *.".$_SERVER["HTTP_HOST"]);
$file = '/var/log/httpd/'.$_SERVER["SERVER_NAME"].'.ajax.log';
$raw_data = file_get_contents('php://input');
if('' != $raw_data ){
	echo '{ "result": null, "error": {"msg":"'.$_SERVER["SERVER_NAME"].' is updating, sorry for the inconvenience"}, "id": 1}';
	exit('{"result": null, "error": {"code": -32600, "message": "INVALID_REQUEST:SCAN_TYPE ", "data": '.json_encode($args).'},  "id": null}');
	
}else{
	exit ''.$_SERVER["SERVER_NAME"].' is updating, sorry for the inconvenience'.PHP_EOL;
	
}
$raw_data = urldecode($raw_data);

file_put_contents($file, 'raw_data::'.$raw_data."\r\n", FILE_APPEND);

/*
echo __FILE__.'@'.__LINE__.'$raw_data['.var_export($raw_data,true).']'.PHP_EOL;

*/
?>