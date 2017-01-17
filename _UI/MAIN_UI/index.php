<?php
/**
 * update
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE
 * @subpackage	API_STUB_AJAX
 */
 /**
echo 'here: '.__FILE__.'@'.__LINE__.' $GLOBALS==<pre>'.var_export($_SERVER, true).'</pre><br>';
exit;
echo '*************DAFUQ!!!!!!!!!!!!!!!!!!!!!!!!!!!!'.PHP_EOL;
 */
if('/' == $_SERVER["REQUEST_URI"]){
		#$loadPath = JCORE_TEMPLATES_DIR.'METRONIC/'.$loadPath.'.html';
		$loadPath = 'index.html';
		#echo 'here: '.__FILE__.'@'.__LINE__.' $load_path==<pre>'.var_export($GLOBALS["load_path"], true).'</pre><br>';
		echo file_get_contents( $loadPath);
		exit(0);
}

require_once 'harness.php';

#$TEMPLATER->set_filenames(array($ps_template_body 	=> JCORE_TEMPLATES_DIR.'HTML/blackwatch/admin_body.html'));
#echo 'here: '.__FILE__.'@'.__LINE__.' $_SESSION==<pre>'.var_export($_SESSION, true).'</pre><br>';

#password_hash("rasmuslerdorf", PASSWORD_DEFAULT)

$USER_ENTITY = new SERVICE\USER\USER_ENTITY();
/**
$args = array(
	'HASH' => array(),
	'IDCOMPONENTS' => array(),
);
			$USER_ENTITY = new SERVICE\USER\USER_ENTITY();
			$_SESSION['user_id'] = $authCheck["user_id"];
			$_SESSION['user_email'] = $_POST["email"];
			$_SESSION['SESSIONID'] = $USER_ENTITY->getSessionID(null);
$args = array(
	'user_id' 		=> $_SESSION['user_id'],
	'user_email' 	=> $_SESSION['user_email'],
);
*/
$test2 = $USER_ENTITY->getSessionID($args);
/**
$args2 = array(
	'hash'			=> $test2,
);
$test3 = $USER_ENTITY->checkSessionID($args2).'<br>'.PHP_EOL;
$args3 = array(
	
	#'user_id' 		=> $_SESSION['user_id'],
	#'user_email' 	=> $_SESSION['user_email'],
	
	'hash'			=> $test2,
	'IDCOMPONENTS'	=> array(
		$_SESSION["user_id"],
		$_SESSION["user_email"],
	)
);
$test4 = $USER_ENTITY->checkSessionID($args3).'<br>'.PHP_EOL;
*/
$routeInfo = array();
if(isset($_SERVER["REDIRECT_URL"])){
	$routeInfo = explode('/', $_SERVER["REDIRECT_URL"]) ;
	
}

	if(1 <= count($routeInfo)){
		#echo 'here: '.__FILE__.'@'.__LINE__.' $routeInfo==<pre>'.var_export($routeInfo, true).'</pre><br>';
		if(isset($routeInfo[1])){
			$view = $routeInfo[1];
		}
		
		if(isset($routeInfo[2])){
			$subview = $routeInfo[2];
		}
		
		if(isset($_REQUEST["action"])){
			#require_once '_'.$_REQUEST["action"].'.php';

		}else{

		}
		
	}
	$route = 'default';
	$load_path = 'default';
	
	if(isset($GLOBALS["view"])){
		$route = $GLOBALS["view"];
		$load_path = $GLOBALS["view"];
		if(isset($GLOBALS["subview"])){
			$route .= '/'.$GLOBALS["subview"];
			$load_path .= '_'.$GLOBALS["subview"];
		}
	}
	
	
	#$buildNum = @include 'build.txt';
	$buildNum = file_get_contents( 'build.txt');
	/*
	$TEMPLATER->assign_vars( array(	
		'TITLE' => $BODY_TITLE.'--'.$buildNum
	));	

	

	* Do the final rendering routine
	* just echo out the results [parsed template an vars -> rendered HTML as string ]
	* or save it to a variable to echo later
	if ($header_footer_set){ 
		echo $TEMPLATER->sparse($ps_template_header, true, $retvar = 'returnString');
	};
	echo $TEMPLATER->sparse($ps_template_body, true, $retvar = 'returnString');
	
	#echo '<hr>'.$TEMPLATER->render($ps_template_body2, 'FLUSH').'<hr>';
	if ($header_footer_set){ 
		echo $TEMPLATER->sparse($ps_template_footer, true, $retvar = 'returnString');
	};	
	*/
#require_once 'index.html';
#echo 'here: '.__FILE__.'@'.__LINE__.' $view==<pre>'.var_export($view, true).'</pre><br>';
if(isset($view) && 'login' == $view){
	require_once 'clean_login.php';
	
}else{
#echo 'clean: '.__FILE__.'@'.__LINE__.' $route==<pre>'.var_export($route, true).'</pre><br>';
	require_once 'clean.php';
	
}

?>
