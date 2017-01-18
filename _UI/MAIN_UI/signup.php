<?php
/**
* signup 
* 
* @author	Jason Medland<jason.medland@gmail.com>
* @package	JCORE\UI\MAIN
*/

/**
	echo 'here: '.__FILE__.'@'.__LINE__.' $_SERVER==<pre>'.var_export($_SERVER, true).'</pre><br>';
	exit;
	 
	echo 'here: '.__FILE__.'@'.__LINE__.'process the form <pre>'.var_export($_POST, true).'</pre><br>'.PHP_EOL;
	exit;
*/

require_once 'harness.php';
/**
echo  \password_hash('TestSignUp1', PASSWORD_DEFAULT);
TestSignUp1@gene5.com
*/



/*
* this is a closed system so here is an example how to leverage 
* JCORE\SERVICE\AUTH\PAGE_FILTER.authenticateTOKEN
* 
* $PUBLIC_TOKEN = 'something arbitrary to give an access token for the signup form';
* echo md5 ( $PUBLIC_TOKEN ); //c3efb3f48d69cce6cd073c2999397493
* $TOKEN_AUTH_SERVICE = new JCORE\SERVICE\AUTH\PAGE_FILTER(); //$AUTH_HARNESS extended 
* 
	echo md5 ( $W = 'what' ).PHP_EOL; //4a2028eceac5e1f4d252ea13c71ecec6
	echo md5 ( $T = 'the' ).PHP_EOL; //8fc42c6ddf9966db3b09e84365034357
	echo md5 ( $F = 'fuck' ).PHP_EOL; //99754106633f94d350db34d548d6091a
	all together now 
	echo md5 ( $WTF = $W.$T.$F ); //ec5883451bb7d0aa6b5950e39ed5f16d

		// A crude example below for the TOKEN_HAYSTACK authentication in JCORE\SERVICE\AUTH\PAGE_FILTER:
		JCORE\SERVICE\AUTH\PAGE_FILTER.authenticateTOKEN
		JCORE\SERVICE\AUTH\PAGE_FILTER->authenticateTOKEN($args)
			$args["TOKEN"] = array(
				'TOKEN_SCOPE' => '_REQUEST', //_POST,_GET,_REQUEST, ...
				'TOKEN_NAME' => 'PUBLIC_TOKEN',
				'TOKEN_VALUE' => 'TOKEN_VALUE',
				'TOKEN_HAYSTACK' => array( 
					// a filtered result set prepared by whatever (extended class etc.) 
					// is calling this service method 
					// this is passed as an NON INDEXED OR ORDINALLY INDEXED array
				),
			);
				
*/
/*


	$W =  md5 ( 'what' ); 	//4a2028eceac5e1f4d252ea13c71ecec6
	$T =  md5 ( 'the' ); 	//8fc42c6ddf9966db3b09e84365034357
	$F =  md5 ( 'fuck' ); 	//99754106633f94d350db34d548d6091a
	//all together now 
	$WTF =  md5 ( $W.$T.$F ); //3b587cf4a2c6dfd607fd90a39bbd3aca
	
	$tokenAuthArgs["TOKEN"] = array(
		'TOKEN_SCOPE' => '_REQUEST', //_POST,_GET,_REQUEST, ...
		'TOKEN_NAME' => 'PUBLIC_TOKEN',
		'TOKEN_VALUE' => '3b587cf4a2c6dfd607fd90a39bbd3aca',
		'TOKEN_HAYSTACK' => array( 
			// a filtered result set prepared by whatever (extended class etc.) 
			// is calling this service method 
			$W,
			$T,
			$W,
			$WTF,
		),
	);
	
$TOKEN_AUTH_SERVICE = new JCORE\SERVICE\AUTH\PAGE_FILTER();
$tokenCheck = $TOKEN_AUTH_SERVICE->authenticateTOKEN($tokenAuthArgs);
if('OK' == $tokenCheck["status"]){
	#$TOKEN_VALUE = 'd41d8cd98f00b204e9800998ecf8427e';
	echo 'here: '.__FILE__.'@'.__LINE__. PHP_EOL
	.' 	  $tokenCheck <pre>'.var_export($tokenCheck, true).'</pre>'.PHP_EOL
	.'	  $tokenAuthArgs["TOKEN"]["TOKEN_VALUE"]:['.$tokenAuthArgs["TOKEN"]["TOKEN_VALUE"].'] '.PHP_EOL
	.'    TOKEN_HAYSTACK==<pre>'.var_export($tokenAuthArgs["TOKEN"]["TOKEN_HAYSTACK"], true).'</pre>'.PHP_EOL
	.'<br>';
}
	
*/
	$AUTH_TEST = $AUTH_HARNESS->authenticate(
		'JCORE\SERVICE\AUTH\LOGIN_SERVICE',
		array(
			'AUTH_TYPE' => 'TOKEN'
		)
	);
	/*
	echo __METHOD__.__LINE__.'$AUTH_TEST<pre>['.var_export($AUTH_TEST, true).']</pre>'.PHP_EOL; 
	echo __METHOD__.__LINE__.'$_SERVER<pre>['.var_export($_SERVER, true).']</pre>'.PHP_EOL; 
	*/
	
	if(false === $AUTH_TEST){
		header('Location: https://'.$_SERVER['SERVER_NAME'].'/login.php');
		exit;
	}

/**
	if(isset($_REQUEST["email"])){
		$authCheck = $LOGIN_SERVICE->authenticateUserLogin($_POST);
		if(isset($authCheck["status"]) && "OK" == $authCheck["status"]){
			#echo 'here: '.__FILE__.'@'.__LINE__.'authenticateUser<pre>['.var_export($LOGIN_SERVICE->authenticateUserLogin($_POST), true).']</pre> <br>'.PHP_EOL; 
			echo 'here: '.__FILE__.'@'.__LINE__.' $authCheck==<pre>'.var_export($authCheck, true).'</pre><br>';
			
			$USER_ENTITY = new SERVICE\USER\USER_ENTITY();
			$_SESSION['user_id'] = $authCheck["user_id"];
			$_SESSION['comp_id'] = $authCheck["comp_id"];
			$_SESSION['role_id'] = $authCheck["role_id"];
			$_SESSION['user_email'] = $_POST["email"];
			$args = array(
				'user_id' => $authCheck["user_id"],
				'user_email' => $_POST["email"],
			);
			$_SESSION['SESSIONID'] = $USER_ENTITY->getSessionID($args);
		
		
		
			session_write_close();
			
			header('Location: '.$httpype.'://'.$_SERVER['SERVER_NAME'].'');
			#echo __METHOD__.__LINE__.'$_SESSION<pre>['.var_export($_SESSION, true).']</pre>'.'<br>'.PHP_EOL;
			exit();
		}else{
			die($authCheck["error"]);
		}

	}
*/
$view = 'signup';
$load_path = 'signup';
#require_once 'index.html';
#echo 'here: '.__FILE__.'@'.__LINE__.'load_path['.$load_path.'] $view==<pre>'.var_export($view, true).'</pre><br>';
require_once 'clean_signup.php';
#	$loadPath = JCORE_TEMPLATES_DIR.'METRONIC/'.$loadPath.'.html';
#	echo file_get_contents( $loadPath);
?>
