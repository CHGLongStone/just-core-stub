<?php
/**
 * update
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE\API\JSON_RPC
 */



/**
ini_set ("xdebug.auto_trace" , "On");
#ini_set('xdebug.scream', 1);	//disable the @ UN-Suppress errors 
ini_set ("xdebug.trace_output_name" , "trace.%s_%u");
ini_set('xdebug.trace_options', 0); //overwrite
* https://xdebug.org/docs/all#trace_options
* https://github.com/derickr/xdebug/blob/master/contrib/tracefile-analyser.php
* This file is not an Xdebug trace file made with format option '1' and version 2 to 4.
ini_set('xdebug.xdebug.trace_format', 1); 
ini_set('xdebug.show_local_vars', 1);
#ini_set('xdebug.dump_globals', 1);
ini_set('xdebug.collect_assignments', 1);
ini_set('xdebug.collect_includes', 1);
ini_set('xdebug.collect_params', 4);
ini_set('xdebug.collect_return', 4);
ini_set('xdebug.show_mem_delta', 1);
ini_set('xdebug.show_exception_trace', 1);
ini_set('xdebug.trace_output_dir', "/var/www/vhosts/'.$_SERVER["HOST_NAME"].'/CACHE/FILE/");
ini_set('xdebug.profiler_output_name', "%p-%s-%R");
ini_set('xdebug.profiler_enable_trigger', 1);
xdebug_start_trace(null, XDEBUG_TRACE_COMPUTERIZED);
********
$profileDataDir = "/var/www/vhosts/'.$_SERVER["HOST_NAME"].'/CACHE/FILE/";
ini_set('xhprof.output_dir', $profileDataDir);
xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
*/

require_once 'harness.php';



 
 /**
* set headers
 */
header("Access-Control-Allow-Origin: *.".$_SERVER["HTTP_HOST"]);
$file = '/var/log/httpd/'.$_SERVER["HOST_NAME"].'.ajax.log';
$raw_data = file_get_contents('php://input');
if("%5C" == substr($raw_data, 0,2) ){
	
}
$raw_data = urldecode($raw_data);

file_put_contents($file, 'raw_data::'.$raw_data."\r\n", FILE_APPEND);

/*
* dump it all if you really need to see it...
#echo __FILE__.'@'.__LINE__.'$_POST['.var_dump($_POST,true).']'.PHP_EOL;
echo __FILE__.'@'.__LINE__.'$_GET<pre>['.var_dump($_GET,true).']</pre>'.PHP_EOL;
echo __FILE__.'@'.__LINE__.'$_REQUEST<pre>['.var_dump($_REQUEST,true).']</pre>'.PHP_EOL;
echo __FILE__.'@'.__LINE__.'$_SERVER<pre>['.var_dump($_SERVER,true).']</pre>'.PHP_EOL;
echo __FILE__.'@'.__LINE__.'$GLOBALS<pre>['.var_dump($GLOBALS,true).']</pre>'.PHP_EOL;
echo __FILE__.'@'.__LINE__.'$GLOBALS<pre>['.var_dump(array_keys ($GLOBALS),true).']</pre>'.PHP_EOL;
#echo phpinfo();
#exit;
*/

$SERVICECALL = new \JCORE\TRANSPORT\JSON\JSONRPC_1_0_API;

	/**
	* parse out the service name
	*/
	$replace = array("_"); 
	$search  = array(
		"\\",
		'-',
		'.',
		':',
	); 
	
	$serviceName = str_replace($search, $replace, $SERVICECALL->getServiceName() );
	$profiler_namespace = $_SERVER["HOST_NAME"].'_'.$serviceName;
	
	/**
	require_once 'APIS/xhprof_lib/utils/xhprof_lib.php';
    require_once 'APIS/xhprof_lib/utils/xhprof_runs.php';
    $xhprof_data = xhprof_disable();
    $xhprof_runs = new XHProfRuns_Default($profileDataDir);
    $run_id = $xhprof_runs->save_run($xhprof_data, $profiler_namespace);
	#echo '$SERVICECALL->getServiceName()'.$SERVICECALL->getServiceName();
	******
	xdebug_stop_trace();
	*/









?>