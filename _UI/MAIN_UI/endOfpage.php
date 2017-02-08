<?php 
/**
*
*/
require_once 'harness.php';
/*
echo 'here: '.__FILE__.'@'.__LINE__.' $TEMPLATER==<pre>'.var_export($TEMPLATER, true).'</pre><br>';
echo 'here: '.__FILE__.'@'.__LINE__.' $GLOBALS["TEMPLATER"]==<pre>'.var_export($GLOBALS["TEMPLATER"], true).'</pre><br>';


END_OF_PAGE_CORE_PLUGINS
END_OF_PAGE_SCRIPTS

ROUTES
	PAGE_LEVEL_PLUGINS
	PAGE_LEVEL_SCRIPTS
ONLOAD
	END_OF_PAGE_ONLOAD
	PAGE_LEVEL_ONLOAD
*/

function getEndOfPageScripts(){
	
	$TEMPLATER = $GLOBALS["TEMPLATER"];
	$ps_template_service = '1service';
	$end_of_page_scripts = 'end_of_page_scripts';
	$CFG = $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'STATIC_ASSETS_GLOBAL');
	#echo 'here: '.__FUNCTION__.'@'.__LINE__.' $CFG==<pre>'.var_export($CFG["ROUTES"], true).'</pre><br>'.PHP_EOL;
	#echo 'here: '.__FUNCTION__.'@'.__LINE__.' $CFG==<pre>'.var_export(array_keys($CFG["ROUTES"]), true).'</pre><br>'.PHP_EOL;
		
	$TEMPLATER->set_filenames(array($ps_template_service => JCORE_TEMPLATES_DIR.'JS/form_service_method.js'));
	$TEMPLATER->set_filenames(array($end_of_page_scripts => JCORE_TEMPLATES_DIR.'HTML/COMPONENTS/ENDOFPAGE/endofpage.v1.html'));
	
	if(!isset($GLOBALS["ASSETIC_WRAPPER"])){
		$GLOBALS["ASSETIC_WRAPPER"] = new JCORE\SERVICE\HTTP_OPTIMIZATION\ASSETIC\ASSETIC_WRAPPER(); 
	}
	
	$ASSETIC_WRAPPER = $GLOBALS["ASSETIC_WRAPPER"];
	$JUST_CORE_CFG = $CFG;
	
	/*
	echo 'here: '.__FILE__.'@'.__LINE__.' $TEMPLATER==<pre>'.var_export($TEMPLATER, true).'</pre><br>';
	$SERVICE_CALL = '\\\SERVICE\\\USER\\\TECH_CONTACT_PROFILE.UPDATE';
	map to the menu??
	$TEMPLATER->assign_vars( array(	
		'SERVICE_CALL' => $SERVICE_CALL,
	));	

	$servicejs = $TEMPLATER->sparse($ps_template_service, true, $retvar = 'returnString');
	$TEMPLATER->assign_block_vars('FOOTER_SCRIPT', array(	
		'BODY'	=> $servicejs
	));
	*/
	$TEMPLATER->assign_block_vars('PAGE_LEVEL_ONLOAD', array(	
		'BODY'	=> '
	SESSIONID = "'.$_SESSION["SESSIONID"].'";
	user_id = "'.$_SESSION["user_id"].'";
	user_email = "'.$_SESSION["user_email"].'";
	comp_id = "'.$_SESSION["comp_id"].'";
	role_id = "'.$_SESSION["role_id"].'";
	fPrintOptions = {excludeLanguage : true};
	canvas_fingerprint = "";
	new Fingerprint2(fPrintOptions).get(function(result){
		console.log("result:"+result);
		//$("#canvas_fingerprint").val(result);
		JCORE.canvas_fingerprint = result;
		console.log("JCORE.canvas_fingerprint:"+JCORE.canvas_fingerprint);
	});
	
	
	//canvas_fingerprint = JCORE.canvas_fingerprint;
	//console.log("canvas_fingerprint:"+canvas_fingerprint);

	digital_fingerprint = new Fingerprint({canvas: true}).get();
		',
		'TYPE'	=> ' type="text/javascript" ',
	));
	
	$cacheJSArgs = array(
		'collection' => $JUST_CORE_CFG["END_OF_PAGE_CORE_PLUGINS"],
		'name' => 'END_OF_PAGE_CORE_PLUGINS',
		'route' => '',
	);
	/**
	* END_OF_PAGE_CORE_PLUGINS
	*/
	$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'END_OF_PAGE_CORE_PLUGINS.js';
	$httpPath = $ASSETIC_WRAPPER->getHttpPath().'END_OF_PAGE_CORE_PLUGINS.js';
	if(true === file_exists($filePath)){
		$TEMPLATER->assign_block_vars('END_OF_PAGE_CORE_PLUGINS', array(
			'SRC'	=> ' src="'.$httpPath.'" ',
			'TYPE'	=> ' type="text/javascript" ',
		));
	}else{
		
		$cacheJSArgs = array(
			'collection' => $JUST_CORE_CFG["END_OF_PAGE_CORE_PLUGINS"],
			'name' => 'END_OF_PAGE_CORE_PLUGINS',
			'route' => '',
		);
		$compiled = $ASSETIC_WRAPPER->cacheJS($cacheJSArgs);
		foreach($CFG["END_OF_PAGE_CORE_PLUGINS"] AS $key => $value){
			$TEMPLATER->assign_block_vars('END_OF_PAGE_CORE_PLUGINS', array(	
				'SRC'	=> $value["SRC"],
				'TYPE'	=> $value["TYPE"],
			));
		}
	}
	
	
	

	
	/**
	* END_OF_PAGE_SCRIPTS
	*/
	$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'END_OF_PAGE_SCRIPTS.js';
	$httpPath = $ASSETIC_WRAPPER->getHttpPath().'END_OF_PAGE_SCRIPTS.js';
	if(true === file_exists($filePath)){
		$TEMPLATER->assign_block_vars('END_OF_PAGE_SCRIPTS', array(
			'SRC'	=> ' src="'.$httpPath.'" ',
			'TYPE'	=> ' type="text/javascript" ',
		));
	}else{
		$cacheJSArgs = array(
			'collection' => $JUST_CORE_CFG["END_OF_PAGE_SCRIPTS"],
			'name' => 'END_OF_PAGE_SCRIPTS',
			'route' => '',
		);
		$compiled = $ASSETIC_WRAPPER->cacheJS($cacheJSArgs);
		foreach($CFG["END_OF_PAGE_SCRIPTS"] AS $key => $value){
			$TEMPLATER->assign_block_vars('END_OF_PAGE_SCRIPTS', array(	
				'SRC'	=> $value["SRC"],
				'TYPE'	=> $value["TYPE"],
			));
		}
	}
	
	/**
	* END_OF_PAGE_ONLOAD
	*/
	$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'END_OF_PAGE_ONLOAD.js';
	$httpPath = $ASSETIC_WRAPPER->getHttpPath().'END_OF_PAGE_ONLOAD.js';
	if(true === file_exists($filePath)){
		
		$TEMPLATER->assign_block_vars('END_OF_PAGE_ONLOAD', array(
			'SRC'	=> ' src="'.$httpPath.'" ',
			'TYPE'	=> ' type="text/javascript" ',
		));
	}else{
		
		$cacheJSArgs = array(
			'collection' => $JUST_CORE_CFG["END_OF_PAGE_ONLOAD"],
			'name' => 'END_OF_PAGE_ONLOAD',
			'route' => '',
		);
		$compiled = $ASSETIC_WRAPPER->cacheJS($cacheJSArgs);
		foreach($CFG["END_OF_PAGE_ONLOAD"] AS $key => $value){
			
			$TEMPLATER->assign_block_vars('END_OF_PAGE_ONLOAD', array(	
				'SRC'	=> $value["SRC"],
				'TYPE'	=> $value["TYPE"],
				'BODY'	=> $value["BODY"],
			));
		}
	}
	
	/**
	* PAGE_LEVEL_PLUGINS
	*/
	if(isset($GLOBALS["load_path"]) && isset($JUST_CORE_CFG["ROUTES"][$GLOBALS["load_path"]])){
		
		$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'route_'.$GLOBALS["load_path"].'_PAGE_LEVEL_PLUGINS.js';
		$httpPath = $ASSETIC_WRAPPER->getHttpPath().'route_'.$GLOBALS["load_path"].'_PAGE_LEVEL_PLUGINS.js';
		
		if(true === file_exists($filePath)){
			$TEMPLATER->assign_block_vars('PAGE_LEVEL_PLUGINS', array(
				'SRC'	=> ' src="'.$httpPath.'" ',
				'TYPE'	=> ' type="text/javascript" ',
			));
		}else{
			$cacheJSArgs = array(
				'collection' => $JUST_CORE_CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_LEVEL_PLUGINS"],
				'name' => 'route',
				'route' => $GLOBALS["load_path"].'_PAGE_LEVEL_PLUGINS',
			);
			$compiled = $ASSETIC_WRAPPER->cacheJS($cacheJSArgs);
			foreach($JUST_CORE_CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_LEVEL_PLUGINS"] AS $key => $value){
				$TEMPLATER->assign_block_vars('PAGE_LEVEL_PLUGINS', array(	
					'SRC'	=> $value["SRC"],
					'TYPE'	=> $value["TYPE"],
				));
			}
		}
		
		$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'route_'.$GLOBALS["load_path"].'_PAGE_LEVEL_SCRIPTS.js';
		$httpPath = $ASSETIC_WRAPPER->getHttpPath().'route_'.$GLOBALS["load_path"].'_PAGE_LEVEL_SCRIPTS.js';
		if(true === file_exists($filePath)){
			
			$TEMPLATER->assign_block_vars('PAGE_LEVEL_SCRIPTS', array(
				'SRC'	=> ' src="'.$httpPath.'" ',
				'TYPE'	=> ' type="text/javascript" ',
			));
		}else{
			
			$cacheJSArgs = array(
				'collection' => $JUST_CORE_CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_LEVEL_SCRIPTS"],
				'name' => 'route',
				'route' => $GLOBALS["load_path"].'_PAGE_LEVEL_SCRIPTS',
			);
			$compiled = $ASSETIC_WRAPPER->cacheJS($cacheJSArgs);
			
			foreach($JUST_CORE_CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_LEVEL_SCRIPTS"] AS $key => $value){
				$TEMPLATER->assign_block_vars('PAGE_LEVEL_SCRIPTS', array(	
					'SRC'	=> $value["SRC"],
					'TYPE'	=> $value["TYPE"],
					'BODY'	=> $value["BODY"],
				));
			}
		}
			
		$filePath = $ASSETIC_WRAPPER->getHttpResolvedPath().'route_'.$GLOBALS["load_path"].'_PAGE_LEVEL_ONLOAD.js';
		$httpPath = $ASSETIC_WRAPPER->getHttpPath().'route_'.$GLOBALS["load_path"].'_PAGE_LEVEL_ONLOAD.js';
		
		if(true === file_exists($filePath)){
			$TEMPLATER->assign_block_vars('PAGE_LEVEL_ONLOAD', array(
				'SRC'	=> ' src="'.$httpPath.'" ',
				'TYPE'	=> ' type="text/javascript" ',
			));
		}else{
			$cacheJSArgs = array(
				'collection' => $JUST_CORE_CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_LEVEL_ONLOAD"],
				'name' => 'route',
				'route' => $GLOBALS["load_path"].'_PAGE_LEVEL_ONLOAD',
				#'route' => $GLOBALS["load_path"],
			);
			$compiled = $ASSETIC_WRAPPER->cacheJS($cacheJSArgs);
			
			foreach($JUST_CORE_CFG["ROUTES"][$GLOBALS["load_path"]]["PAGE_LEVEL_ONLOAD"] AS $key => $value){
				$TEMPLATER->assign_block_vars('PAGE_LEVEL_ONLOAD', array(	
					'SRC'	=> $value["SRC"],
					'TYPE'	=> $value["TYPE"],
					'BODY'	=> $value["BODY"],
				));
			}
		}
		
	}
	
	$endOfPageScripts = $TEMPLATER->sparse($end_of_page_scripts, true, $retvar = 'returnString');
	return $endOfPageScripts;
}


echo '
<!-- 
START getEndOfPageScripts
-->
'.getEndOfPageScripts().'
<!-- 
FINISH getEndOfPageScripts
-->
';
?>
