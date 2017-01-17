<?php
/**
 * update
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE
 * 
 */





 
 /**
* set headers
 */
header("Access-Control-Allow-Origin: *.".$_SERVER["HTTP_HOST"]);
$file = '/var/log/httpd/'.$_SERVER["HOST_NAME"].'.rest.log';

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
	

 
/*
* load the transport layer
*/


$RESTObj = new PLUGINS\REST\REST_STUB();

echo __FILE__.'@'.__LINE__.'<br>';

echo __FILE__.'@'.__LINE__.'RESTObj<pre>'.var_export($RESTObj, true).'</pre><br>';
echo __FILE__.'@'.__LINE__.'_REQUEST<pre>'.var_export($_REQUEST, true).'</pre><br>';

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