<?php 
/**
*
*/

require_once 'harness.php';




/**
* generateMenuTemplater(2)
* generate the menu CACHE THIS....
*
* ACL_RULE
*  VALUES
* 	[base_dir] 				== $GLOBALS["APPLICATION_ROOT"]
* 	JCORE_TEMPLATES_DIR 	== $GLOBALS["TEMPLATER"]["TEMPLATES_DIR"]
* 		DEFAULT $GLOBALS["APPLICATION_ROOT"].'HTTP_ASSETS/TEMPLATES/',
* 
* the menu is pulling the structure from here: (unless set otherwise)
* 	[base_dir]/CONFIG/AUTOLOAD/templater.global.php
* 		$GLOBALS["TEMPLATER"][MENU_NAME]  ...METRONIC_MENU2 in this case
* 
* ACL:
* 	TABLES:
* 		access_control_list
* 		user_role
* SERVICES:
* 	JCORE\AUTH\CRUDE_ACL
* ENTITIES:
* 	JCORE\AUTH\USER_ROLE_ENTITY
* 	JCORE\AUTH\CRUDE_ACL_ENTITY
* 
* 
* 
*/
function generateMenuTemplater($args= null){

	/**
	* pre-check
	* function is recursive set $SELF
	*/
	$SELF = __FUNCTION__;
	
	if($args["breadcrumb"]){
		# render the breadcrumb trail 
	}

	$recurse = false;
	if(
		(
			isset($args["recurse"]) 
			&& 
			true == is_numeric($args["recurse"])
		)
		&& 
		is_array($args["recurseValues"])
		
	){
		
		$recurse = true;
		$MENU_ITEMS = $args["recurseValues"];
		$recurseDepth = $args["recurse"];
		$recurseDepth++;

	}else{
		
		if(!$args["MENU_ITEMS"]){
			return false; 
		}else{
			$MENU_ITEMS = $args["MENU_ITEMS"];
			
		}
		$recurseDepth = 0;
		/*
		echo __METHOD__.__LINE__.'$MENU_ITEMS<pre>['.var_export($MENU_ITEMS, true).']</pre>'.'<br>'.PHP_EOL;
		*/
	}
	#echo __METHOD__.__LINE__.' <br>'.PHP_EOL;
	
	
	$navItem = 'navitem';
	$navArray = 'navarray';
	
	$TEMPLATER = new JCORE\TEMPLATER\TEMPLATER();
	$test = $TEMPLATER->set_filenames(array($navItem => JCORE_TEMPLATES_DIR.'METRONIC/COMPONENTS/MENU/left-nav.link.html'));
	$test = $TEMPLATER->set_filenames(array($navArray => JCORE_TEMPLATES_DIR.'METRONIC/COMPONENTS/MENU/left-nav.array.html'));
	$elementString = '';
	$ELEMENTS = '';
	
	foreach($MENU_ITEMS AS $key => $value){
		#echo __METHOD__.__LINE__.'$key['.$key.'] $value["NAME"]['.$value["NAME"].'] '.'<br>'.PHP_EOL;
		
		$RENDER_ITEM = TRUE;
		if(isset($value["ACL_RULE"]) && 1 <= count($value["ACL_RULE"])){
				$params = $value["ACL_RULE"];
				$params['role'] = $_SESSION["role_id"];
				#echo __METHOD__.'@ '.__LINE__.'$key['.$key.'] <pre>'.var_export($params, true).'</pre> '.'<br>'.PHP_EOL;
				$RENDER_ITEM = $GLOBALS["RBAC"]->authorize($params);
				#echo __METHOD__.__LINE__.'$GLOBALS["RBAC"]->ERROR_MESSAGE['.$GLOBALS["RBAC"]->ERROR_MESSAGE.'] <pre>'.var_export($params, true).'</pre> '.'<br>'.PHP_EOL;
				#echo __METHOD__.__LINE__.'$RENDER_ITEM['.$RENDER_ITEM.'] $key['.$key.'] <pre>'.var_export($value, true).'</pre> '.'<br>'.PHP_EOL;
		}
		if(FALSE !== $RENDER_ITEM){
			
			if(isset($value["SUB_ITEMS"]) && is_array($value["SUB_ITEMS"]) && 1 <=  $value["SUB_ITEMS"]){
				/*
				$ELEMENTS .= '<li> '.$value["NAME"].' HAS child elements  </li>';
				*/
				$args = array(
					'recurse' => $recurseDepth,
					'recurseValues' => $value["SUB_ITEMS"],
				);
				$ELEMENTS = $SELF($args);

			}else{
				$ELEMENTS = '';
			}

	
			$TEMPLATER->assign_vars( array(	
				'INDENT'		=> str_repeat("\t", $recurseDepth),
			));	
			$TEMPLATER->assign_block_vars('subitem', array(
				'NAME'			=> $value["NAME"],
				'DATA'			=> $value["DATA"],
				'HREF'			=> $value["HREF"],
				'ICON_CLASS'	=> $value["ICON_CLASS"],
				'ELEMENTS'		=> $ELEMENTS,
			));
			if('' != $ELEMENTS){
				$nav = $navArray;
			}else{
				$nav = $navItem;
			}
			$ELEMENTS .= '';
			$elementString .= $TEMPLATER->sparse($nav, true, $retvar = 'returnString');
			$TEMPLATER->unset_block_vars('subitem.');
			
		}
	}
	
	#$TEMPLATER->unset_block_vars('subitem.sub_item');
	#$TEMPLATER->unset_block_vars('menu.');
	
	
	return $elementString;
	#return $renderedHtml;
}




$MENU_ITEMS_CFG = array(
	'MENU_ITEMS' => $GLOBALS['CONFIG_MANAGER']->getSetting($LOAD_ID = 'TEMPLATER','JUST_CORE_MENU'),
); 
#echo 'here: '.__FILE__.'@'.__LINE__.' $MENU_ITEMS_CFG<pre>'.var_export($MENU_ITEMS_CFG, true).'</pre><br>'.PHP_EOL;
$MENU_ITEMS = generateMenuTemplater($MENU_ITEMS_CFG);
echo $MENU_ITEMS;
#echo 'here: '.__FILE__.'@'.__LINE__.' $TEMPLATER_DATA<pre>'.var_export($TEMPLATER_DATA, true).'</pre><br>'.PHP_EOL;





?>