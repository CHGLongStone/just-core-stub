<?php 
/**
* examples using local host and standard internal network IP's 
* TODO:
* write a regex to compare by subnet mask rather than specific IP's
*/

return array(
    'STATIC_ASSETS_GLOBAL' => array(
		'ROUTES' => array(
			'login' => array(
				'PAGE_STYLES' => array(
					array(
						'HREF' => "/assets/plugins/select2/select2.css", 
						'REL' => ' rel="stylesheet"', 
						'TYPE' => ' type="text/css"',
					),
					array(
						'HREF' => "/assets/css/login.css", 
						'REL' => ' rel="stylesheet"', 
						'TYPE' => ' type="text/css"',
					),
					
				),
				'PAGE_LEVEL_PLUGINS' => array(
					array(
						'SRC'	=> '  src="/assets/plugins/jquery-validation/js/jquery.validate.min.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					array(
						'SRC'	=> '  src="/assets/plugins/select2/select2.min.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					
				),
				'PAGE_LEVEL_SCRIPTS' => array(
					/*
					*/
					array(
						'SRC'	=> '  src="/assets/scripts/login.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					array(
						'SRC'	=> '  src="/assets/scripts/fingerprint.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					array(
						'SRC'	=> '  src="/assets/scripts/fingerprint2.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					array(
						'SRC'	=> '  src="/assets/scripts/fingerprint_harness.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					
				),
				'PAGE_LEVEL_ONLOAD' => array(
					/*
					*/
					array(
						#'SRC' => '  src="/assets/scripts/metronic.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						'BODY' => '
							jQuery(document).ready(function() {    
								Login.init(); // init quick sidebar
								
							});
						',
					),
				),
			),
		),
    ),
);


?>