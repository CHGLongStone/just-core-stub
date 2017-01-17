<?php 
	$BODY_TITLE = 'User Profile';
	
	
	$TEMPLATER->assign_vars( array(	
		'HTML_DOC_DEF' => 'xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"',
		#'HTML_DOC_DEF' => 'lang="en" data-ng-app="blackwatch_'.$_REQUEST["action"].'"',
		'TITLE' => 'BlackWatch',
	));	
	
	/*
	$TEMPLATER->assign_block_vars('HEAD_SCRIPT', array(	
		'SRC'	=> '  src="./assets/js/blackwatch_'.$_REQUEST["action"].'.js"', 
		#'TYPE'	=> ' type="text/javascript" ',
		'BODY'	=> ''
	));
	$TEMPLATER->assign_block_vars('HEAD_SCRIPT', array(	
		//'SRC'	=> '  src=""', 
		'TYPE'	=> ' type="text/javascript" ',
		'BODY'	=> ""
	));
	*/
	
	$TEMPLATER->assign_block_vars('FOOTER_SCRIPT', array(	
		'SRC'	=> '  src="./assets/js/fingerprint_harness.js"', 
		#'TYPE'	=> ' type="text/javascript" ',
		#'BODY'	=> ""
	));
	
	
	$FORMGENERATOR = new SERVICE\FORM\FORMGENERATOR();
	/**
	* FORMGENERATOR configuration
	*/
	$args = array(
		'FORM_DEFINITION' => 'DEFAULT_FORM',
		'FORM_PROFILE' => 'user_profile',
		'DSN' => 'BLACKWATCH',
		'table' => 'client_user',
		'pk_field' => 'client_user_pk',
		"pk" => $_SESSION['user_id'],
		'exclusion' => array(
			#0 => 'alias',
			#1 => 'pass_phrase',
			#3 => '',
		),
		'required' => array(
			/*
			* default applied to all except those below
			*/ 
			'default' => true,
			/*
			* column names, anything that needs a specific rule
			*/ 
			#'fax' => false,
		),
		'search' => array(
			'client_user_pk' => $_SESSION["user_id"],
			'email' => $_SESSION["user_email"],
		),
	);
	
	$body = $FORMGENERATOR->generateForm($args);
	$args = array(
		"MODULE_NAME" => 'blackwatch_'.$_REQUEST["action"],
		"TABLE_NAME" => 'client_user',
	);
	/*
	$angularScript = $FORMGENERATOR->generateAngularJSController($args);
	
	$TEMPLATER->assign_block_vars('HEAD_SCRIPT', array(	
		#'SRC'	=> '  src="./assets/js/blackwatch_'.$_REQUEST["action"].'.js"', 
		#'TYPE'	=> ' type="text/javascript" ',
		'BODY'	=> $angularScript
	));
	*/
	$SERVICE_CALL = "\SERVICE\USER\USER_PROFILE.UPDATE_USER";
	$SERVICE_CALL = "\\SERVICE\\USER\\USER_PROFILE.UPDATE_USER2";
	$SERVICE_CALL = '\\\SERVICE\\\USER\\\USER_PROFILE.UPDATE';
	
	$TEMPLATER->assign_vars( array(	
		'ID' => 'main_container',
		'BODY_TITLE' => $BODY_TITLE,
		'BODY2' => $body,
		//'SERVICE_CALL' => $SERVICE_CALL,
		'FORM_ACTION' => 'javascript:void(0);',
	));	
	/*
	*/
	$TEMPLATER->assign_vars( array(	
		'SERVICE_CALL' => $SERVICE_CALL
	));	
	
	$servicejs = $TEMPLATER->sparse($ps_template_service, true, $retvar = 'returnString');
	$TEMPLATER->assign_block_vars('FOOTER_SCRIPT', array(	
		//'SRC'	=> '  src="./assets/js/fingerprint_harness.js"', 
		#'TYPE'	=> ' type="text/javascript" ',
		'BODY'	=> $servicejs
	));
	
	$TEMPLATER->assign_block_vars('FOOTER_SCRIPT', array(	
		'SRC'	=> '  src="./assets/js/blackwatch_default.js"', 
		#'TYPE'	=> ' type="text/javascript" ',
		'BODY'	=> ""
	));

	
?>