<?php 
/**
*
*/
require_once 'harness.php';

/**
echo 'here: '.__FILE__.'@'.__LINE__.' $view==<pre>'.var_export($GLOBALS["view"], true).'</pre><br>';
echo 'here: '.__FILE__.'@'.__LINE__.' $subview==<pre>'.var_export($GLOBALS["subview"], true).'</pre><br>';
echo 'here: '.__FILE__.'@'.__LINE__.' $route==<pre>'.print_r($GLOBALS, true).'</pre><br>';
echo 'here: '.__FILE__.'@'.__LINE__.' $_ENV==<pre>'.var_export($_ENV, true).'</pre><br>';
echo 'here: '.__FILE__.'@'.__LINE__.' $_SERVER==<pre>'.var_export($_SERVER, true).'</pre><br>';
*/

$loadPath = 'default';

if(isset($GLOBALS["view"])){
	$loadPath = $GLOBALS["view"];
	if(isset($GLOBALS["subview"])){
		$loadPath .= '/'.$GLOBALS["subview"];
	}
}


#echo 'here: '.__FILE__.'@'.__LINE__.' $load_path==<pre>'.var_export($GLOBALS["load_path"], true).'</pre><br>';
/*
echo 'here: '.__FILE__.'@'.__LINE__.' $route==<pre>'.var_export($GLOBALS["route"], true).'</pre><br>';
#echo 'here: '.__FILE__.'@'.__LINE__.' SERVICE\WIKI\WIKI::isWIKIPage()==<pre>'.\SERVICE\WIKI\WIKI::isWIKIPage().'</pre><br>';
echo 'here: '.__FILE__.'@'.__LINE__.' $load_path==['.$_SERVER["DOCUMENT_ROOT"].'/'.$load_path.'.php'.']<br>';
*/
if(file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$load_path.'.php')){
	/**
	* load the php file, have it load the tempalte
	*/
	#echo 'here: '.__FILE__.'@'.__LINE__.' ['.$_SERVER["DOCUMENT_ROOT"].'/'.$load_path.'.php'.']<br>'.PHP_EOL;
	require_once $_SERVER["DOCUMENT_ROOT"].'/'.$load_path.'.php';
	
}else{
	$WIKI = new JCORE\SERVICE\UI\WIKI();
	if(true === $WIKI->isWIKIPage()){
		echo 'isWIKIPage'.PHP_EOL;
		echo '
		<div class="row">
			<div class="col-md-9">
				<div class="portlet light wikimg">
		';
		echo $WIKI->loadWIKIPage();
		echo '
				</div>
			</div>
		</div>
		';
		
	}else{
		/**
		* load the template direct, don't do any processing
		#echo '@'.__LINE__.'$loadPath['.$loadPath.'.php]';
		*/
		#echo 'here: '.__FILE__.'@'.__LINE__.' $loadPath==<pre>'.var_export($_SERVER["DOCUMENT_ROOT"].'/'.$loadPath.'.html', true).'</pre><br>';
		$loadPath = JCORE_TEMPLATES_DIR.'HTML/'.$loadPath.'.html';
		#echo 'here: '.__FILE__.'@'.__LINE__.' $load_path==<pre>'.var_export($GLOBALS["load_path"], true).'</pre><br>';
		echo file_get_contents( $loadPath);
		if(isset($GLOBALS["view"]) && 'Search' == $GLOBALS["view"]){
			$loadPath = JCORE_TEMPLATES_DIR.'HTML/Search/_templates.html';
			echo file_get_contents( $loadPath);

		}
	}
	
	
	
	
}
	
	

?>