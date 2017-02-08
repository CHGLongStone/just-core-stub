<?php 
/**
* examples using local host and standard internal network IP's 
* TODO:
* write a regex to compare by subnet mask rather than specific IP's
*/

return array(
    'STATIC_ASSETS_GLOBAL' => array(
		'ROUTES' => array(
			'Home' => array(
				'PAGE_STYLES' => array(

					array(
						'HREF' => "/assets/plugins/bootstrap/css/bootstrap.min.css", 
						'REL' => ' rel="stylesheet"', 
						'TYPE' => ' type="text/css"',
					),
					array(
						'HREF' => "/assets/css/bootstrap-responsive.min.css", 
						'REL' => ' rel="stylesheet"', 
						'TYPE' => ' type="text/css"',
					),
					
					array(
						'HREF' => "https://fonts.googleapis.com/css?family=Rosario:400,700", 
						'REL' => ' rel="stylesheet"', 
						'TYPE' => ' type="text/css"',
					),
					

					
				),
				'PAGE_LEVEL_PLUGINS' => array(

					
				),
				'PAGE_LEVEL_SCRIPTS' => array(
					array(
						'SRC'	=> '  src="/assets/scripts/d3.v3.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					array(
						'SRC'	=> '  src="/assets/scripts/CodeFlower.js"', 
						'TYPE'	=> ' type="text/javascript" ',
						#'BODY' => '',
					),
					array(
						'SRC'	=> '  src="/assets/scripts/just_core.json"', 
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
								//Login.init(); // init quick sidebar
								var myFlower = new CodeFlower("#visualization", 1300, 1200);
								myFlower.update(just_core_flower);
							});
						',
					),
				),
			),
		),
    ),
);


?>