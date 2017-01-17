<?php
/**
 * update
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE
 * 
 */

 
if(!isset($_SERVER['HTTPS']) || 'on' != $_SERVER['HTTPS']){
	header('Location: https://'.$_SERVER['SERVER_NAME'].'/login.php');	
}
require_once 'harness.php';



$LOGIN_SERVICE = new JCORE\SERVICE\AUTH\LOGIN_SERVICE(); //$AUTH_HARNESS

	if(isset($_REQUEST["email"])){
		$authCheck = $LOGIN_SERVICE->authenticateUserLogin($_POST);

		if(isset($authCheck["status"]) && "OK" == $authCheck["status"]){

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
			
			#header('Location: '.$httpype.'://'.$_SERVER['SERVER_NAME'].'/Home');
			header('Location: https://'.$_SERVER['SERVER_NAME'].'/Home');
			#echo __METHOD__.__LINE__.'$_SESSION<pre>['.var_export($_SESSION, true).']</pre>'.'<br>'.PHP_EOL;
			exit();
		}else{
			die($authCheck["error"]);
		}

	}
$view = 'login';
$load_path = 'login';
#require_once 'index.html';
#echo 'here: '.__FILE__.'@'.__LINE__.'load_path['.$load_path.'] $view==<pre>'.var_export($view, true).'</pre><br>';
require_once 'clean_login.php';
#	$loadPath = JCORE_TEMPLATES_DIR.'JCORE/'.$loadPath.'.html';
#	echo file_get_contents( $loadPath);
?>
