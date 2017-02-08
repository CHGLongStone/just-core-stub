<?php 
/**
*

GLOBAL_MANDATORY_STYLES
PAGE_LEVEL_PLUGIN_STYLES

*/
require_once 'harness.php';


function getHTMLHeader(){

	$TEMPLATER = $GLOBALS["TEMPLATER"];
	#$ps_template_service = '1service';
	$HTMLHeader = 'HTML_Header';
	$CFG = $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'STATIC_ASSETS_GLOBAL');
	$TEMPLATER->set_filenames(array($HTMLHeader => JCORE_TEMPLATES_DIR.'HTML/COMPONENTS/HEAD/head.html'));
	/*
	echo 'here: '.__FUNCTION__.'@'.__LINE__.' $CFG==<pre>'.var_export($CFG, true).'</pre><br>'.PHP_EOL;
	#$TEMPLATER->set_filenames(array($ps_template_service => JCORE_TEMPLATES_DIR.'JS/form_service_method.js'));
	*/
	if(!isset($GLOBALS["ASSETIC_WRAPPER"])){
		$GLOBALS["ASSETIC_WRAPPER"] = new JCORE\SERVICE\HTTP_OPTIMIZATION\ASSETIC\ASSETIC_WRAPPER(); 
	}
	
	$ASSETIC_WRAPPER = $GLOBALS["ASSETIC_WRAPPER"];
	$METRONIC_CFG = $CFG;
	
	
	
	$title = $_SERVER["SERVER_NAME"];
	if(isset($GLOBALS["view"])){
		$title = $GLOBALS["view"];
		if(isset($GLOBALS["subview"])){
			$title .= ':'.$GLOBALS["subview"];
		}
	}
	$TEMPLATER->assign_vars( array(	
		'TITLE' => $title,
		'HTML_DOC_DEF' => ' lang="en" class="no-js" ', //METRONIC default 
	));	

	#echo 'here: '.__FUNCTION__.'@'.__LINE__.' $CFG["META_TAGS"]<pre>'.var_export($CFG["META_TAGS"], true).'</pre><br>'.PHP_EOL;
	foreach($CFG["META_TAGS"] AS $key => $value){
		$TEMPLATER->assign_block_vars('META_TAGS', array(	
			'NAME'		 => $value["NAME"],
			'HTTP_EQUIV' => $value["HTTP_EQUIV"],
			'CONTENT' 	 => $value["CONTENT"],
		));
	}


	#$compiled = $ASSETIC_WRAPPER->checkCompiled();
	#echo __FILE__.__LINE__.'$ASSETIC_WRAPPER->checkCompiled<pre>['.var_export($compiled, true).']</pre>'.'<br>';
	#$METRONIC_CFG["GLOBAL_MANDATORY_STYLES"];
	#$TEST_CLASS = new Assetic\AssetManager();
	#echo __FILE__.__LINE__.'$TEST_CLASS instantiated <pre>['.var_export(get_class($TEST_CLASS), true).']</pre>'.'<br>';

	$cacheCSSArgs = array(
		'collection' => $METRONIC_CFG["GLOBAL_MANDATORY_STYLES"],
		'name' => 'GLOBAL_MANDATORY_STYLES',
		'route' => '',
	);
	


	/**
	* GLOBAL_MANDATORY_STYLES
	*/
	$httpPath = $ASSETIC_WRAPPER->getHttpPath().'GLOBAL_MANDATORY_STYLES.css';
	$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'GLOBAL_MANDATORY_STYLES.css';
	#echo __FILE__.__LINE__.'<b>$httpPath</b>['.$httpPath.']'.'<br>'.PHP_EOL;
	#echo __FILE__.__LINE__.'<b>$filePath</b>['.$filePath.']'.'<br>'.PHP_EOL;
	/**
	* this block is a bit clunky since we have to do a pass to get the compiled file
	* but the compiled file can't include external references...so
	* we need to flag some entries as NO_CACHE 
	* 
	*/
	if(true === file_exists($filePath)){
		#echo __FILE__.__LINE__.'<b>GOT IT....LETS DO THIS SHIT</b>'.'<br>'.PHP_EOL;

		foreach($CFG["GLOBAL_MANDATORY_STYLES"] AS $key => $value){
			#echo __FILE__.__LINE__.'<b>$KEY</b>['.$key.']  ['.$value["NO_CACHE"].']  ['.$value["REL"].'] '.'<br>'.PHP_EOL;
			if(isset($value["NO_CACHE"]) && 'TRUE' == $value["NO_CACHE"]){
				$TEMPLATER->assign_block_vars('GLOBAL_MANDATORY_STYLES', array(	
					'REL'	=> $value["REL"],
					'TYPE'	=> $value["TYPE"],
					'HREF'	=> $value["HREF"],
					'MEDIA'	=> $value["MEDIA"],
				));
			}
		}
		$TEMPLATER->assign_block_vars('GLOBAL_MANDATORY_STYLES', array(	
			'REL'	=> ' rel="stylesheet" ',
			'TYPE'	=> ' type="text/css" ',
			'HREF'	=> $httpPath,
			#'MEDIA'	=> $value["MEDIA"],
		));		
	}else{
		$cacheCSSArgs = array(
			'collection' => $METRONIC_CFG["GLOBAL_MANDATORY_STYLES"],
			'name' => 'GLOBAL_MANDATORY_STYLES',
			'route' => '',
		);
		$compiled = $ASSETIC_WRAPPER->cacheCSS($cacheCSSArgs);
		foreach($CFG["GLOBAL_MANDATORY_STYLES"] AS $key => $value){
			$TEMPLATER->assign_block_vars('GLOBAL_MANDATORY_STYLES', array(	
				'REL'	=> $value["REL"],
				'TYPE'	=> $value["TYPE"],
				'HREF'	=> $value["HREF"],
				'MEDIA'	=> $value["MEDIA"],
			));
		}
	}
	
	/**
	* THEME_STYLES
	*/
	$httpPath = $ASSETIC_WRAPPER->getHttpPath().'THEME_STYLES.css';
	$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'THEME_STYLES.css';
	#echo __FILE__.__LINE__.'<b>$finalFilename</b>['.$finalFilename.']'.'<br>'.PHP_EOL;
	if(true === file_exists($filePath)){
		#echo __FILE__.__LINE__.'<b>GOT IT....LETS DO THIS SHIT</b>'.'<br>'.PHP_EOL;
		$TEMPLATER->assign_block_vars('THEME_STYLES', array(	
			'REL'	=> ' rel="stylesheet" ',
			'TYPE'	=> ' type="text/css" ',
			'HREF'	=> $httpPath,
			#'MEDIA'	=> $value["MEDIA"],
		));
	}else{
		$cacheCSSArgs = array(
			'collection' => $METRONIC_CFG["THEME_STYLES"],
			'name' => 'THEME_STYLES',
			'route' => '',
		);
		$compiled = $ASSETIC_WRAPPER->cacheCSS($cacheCSSArgs);
		foreach($CFG["THEME_STYLES"] AS $key => $value){
			$TEMPLATER->assign_block_vars('THEME_STYLES', array(	
				'REL'	=> $value["REL"],
				'TYPE'	=> $value["TYPE"],
				'HREF'	=> $value["HREF"],
				'MEDIA'	=> $value["MEDIA"],
			));
		}
	}
	/**
	* ROUTES - PAGE_STYLES
	*/
	if(isset($GLOBALS["load_path"]) && isset($CFG["ROUTES"][$GLOBALS["load_path"]])){
		#$finalFilename = $ASSETIC_WRAPPER->getHttpPath().'route_'.$GLOBALS["load_path"].'.css';
		$httpPath = $ASSETIC_WRAPPER->getHttpPath().'route_'.$GLOBALS["load_path"].'.css';
		$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'route_'.$GLOBALS["load_path"].'.css';
		/*  $ASSETIC_WRAPPER->getCachePath().
		echo __FILE__.__LINE__.'<b>$finalFilename</b>['.$finalFilename.']     '.PHP_EOL.'
		<b>$GLOBALS["load_path"]</b>['.$GLOBALS["load_path"].']     '.PHP_EOL.'
		<b>$CFG["ROUTES"][$GLOBALS["load_path"]]</b>['.$CFG["ROUTES"][$GLOBALS["load_path"]].']     '.PHP_EOL.'
		<b>file_exists('.$finalFilename.')</b>['.file_exists($finalFilename).']     '.PHP_EOL.'
		'.'<br>'.PHP_EOL;
		/var/www/vhosts/dev.demasking.com/http_new/assets/cache/route.SearchLog.css
		*/
		if(true === file_exists($filePath)){
			#echo __FILE__.__LINE__.'<b>GOT IT....LETS DO THIS SHIT</b>'.'<br>'.PHP_EOL;
			$TEMPLATER->assign_block_vars('PAGE_STYLES', array(	
				'REL'	=> ' rel="stylesheet" ',
				'TYPE'	=> ' type="text/css" ',
				'HREF'	=> $httpPath,
				#'MEDIA'	=> $value["MEDIA"],
			));
		}else{
			
			$cacheCSSArgs = array(
				'collection' => $CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_STYLES"],
				'name' => 'route',
				'route' => $GLOBALS["load_path"],
			);
			#echo 'here: '.__FUNCTION__.'@'.__LINE__.' $CFG["ROUTES"]['.$GLOBALS["load_path"].']["PAGE_STYLES"]<pre>'.var_export($CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_STYLES"], true).'</pre><br>'.PHP_EOL;
			$compiled = $ASSETIC_WRAPPER->cacheCSS($cacheCSSArgs);
			foreach($CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_STYLES"] AS $key => $value){
				#echo ' '.__METHOD__.'@'.__LINE__.' $key['.$key.'] $value==<pre>'.var_export($value, true).'</pre><br>'.PHP_EOL;
				$TEMPLATER->assign_block_vars('PAGE_STYLES', array(	
					'REL'	=> $value["REL"],
					'TYPE'	=> $value["TYPE"],
					'HREF'	=> $value["HREF"],
					'MEDIA'	=> $value["MEDIA"],
				));
			}
			
		}
	}
		
		
		
	
	$getHTMLHeader = $TEMPLATER->sparse($HTMLHeader, true, $retvar = 'returnString');
	#echo 'here: '.__FUNCTION__.'@'.__LINE__.' $TEMPLATER==<pre>'.var_export($TEMPLATER, true).'</pre><br>'.PHP_EOL;
	return $getHTMLHeader;
}


$ASSETIC_WRAPPER = new JCORE\SERVICE\HTTP_OPTIMIZATION\ASSETIC\ASSETIC_WRAPPER();
/*
$compiled = $ASSETIC_WRAPPER->pauseCache();
*/
echo getHTMLHeader().'
<!-- 
FINISH getHTMLHeader
-->
';

?>

