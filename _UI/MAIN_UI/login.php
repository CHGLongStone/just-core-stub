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
 
		echo 'here: '.__FILE__.'@'.__LINE__.'process the form <pre>'.var_export($_POST, true).'</pre><br>'.PHP_EOL;
		exit;
 */
 
if(!isset($_SERVER['HTTPS']) || 'on' != $_SERVER['HTTPS']){
	header('Location: https://'.$_SERVER['SERVER_NAME'].'/login.php');	
}
require_once 'harness.php';



$LOGIN_SERVICE = new JCORE\SERVICE\AUTH\LOGIN_SERVICE(); //$AUTH_HARNESS

	if(isset($_REQUEST["email"])){
		$authCheck = $LOGIN_SERVICE->authenticateUserLogin($_POST);
		#echo 'here: '.__FILE__.'@'.__LINE__.' $_POST==<pre>'.var_export($_POST, true).'</pre><br>';
		#exit;
		if(isset($authCheck["status"]) && "OK" == $authCheck["status"]){
			#echo 'here: '.__FILE__.'@'.__LINE__.'authenticateUser<pre>['.var_export($LOGIN_SERVICE->authenticateUserLogin($_POST), true).']</pre> <br>'.PHP_EOL; 
			#echo 'here: '.__FILE__.'@'.__LINE__.' $authCheck==<pre>'.var_export($authCheck, true).'</pre><br>';
			/**
				_POST array (
				  'email' => 'jason.medland@gmail.com',
				  'password' => 'BlackWatch3',
				  'canvas_fingerprint' => '27f3d5d0735aaa5ded885ee4adf269b8',
				  'digital_fingerprint' => '2839368766',
				  'ipv4' => '0.0.0.0',
				)
				
				
				  'user_id' => '1',
				  'comp_id' => '1',
				  'role_id' => '1',
				  'user_email' => 'jason.medland@gmail.com',
				  'SESSIONID' => '$2y$10$FM98yiYX0EY8/YJU0d75nu4kesnmhMKrmgPsO/EH7TvJdF5EmUCRq',
			*/
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
#	$loadPath = JCORE_TEMPLATES_DIR.'METRONIC/'.$loadPath.'.html';
#	echo file_get_contents( $loadPath);
?>
