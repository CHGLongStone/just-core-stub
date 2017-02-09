<?php 
/**
* examples using local host and standard internal network IP's 
* TODO:
* write a regex to compare by subnet mask rather than specific IP's
*/

return array(
    'STATIC_ASSETS_GLOBAL' => array(
		'META_TAGS' => array(
			array(
				'NAME' => null, 
				'HTTP_EQUIV' => ' http-equiv="Content-Type" ',
				'CONTENT' => 'text/html; charset=UTF-8',
			),
			array(
				'NAME' => null, 
				'HTTP_EQUIV' => ' http-equiv="X-UA-Compatible" ',
				'CONTENT' => 'IE=edge',
			),
			array(
				'NAME' => ' name="viewport" ', 
				'HTTP_EQUIV' => '',
				'CONTENT' => 'width=device-width, initial-scale=1',
			),
			array(
				'NAME' => ' name="robots" ', 
				'HTTP_EQUIV' => null, 
				'CONTENT' => 'noindex,nofollow',
			),
			array(
				'NAME' => ' name="description" ',
				'HTTP_EQUIV' => null, 
				'CONTENT' => 'Demasking BlackWatch: BlackWatch Ad source black listing service',
			),
			
			
		),
		'GLOBAL_MANDATORY_STYLES' => array(
			array(
				'HREF' => "https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
			array(
				'HREF' => "/assets/plugins/font-awesome/css/font-awesome.min.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
				'NO_CACHE' => 'TRUE',
			),
			array(
				'HREF' => "/assets/plugins/simple-line-icons/simple-line-icons.min.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
				'NO_CACHE' => 'TRUE',
			),
			array(
				'HREF' => "/assets/plugins/bootstrap/css/bootstrap.min.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
			array(
				'HREF' => "/assets/plugins/uniform/css/uniform.default.min.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
			array(
				'HREF' => "/assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
			array(
				'HREF' => "/assets/css/base.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
		),
		'THEME_STYLES' => array(
			array(
				'HREF' => "/assets/css/components.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
				'ID' => ' id="style_components"',
				'MEDIA' => '',
			),
			array(
				'HREF' => "/assets/css/plugins.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
			array(
				'HREF' => "/assets/css/layout.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
			array(
				'HREF' => "/assets/css/themes/darkblue.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
				'ID' => ' id="style_color"',
			),
			array(
				'HREF' => "/assets/css/custom.css", 
				'REL' => ' rel="stylesheet"', 
				'TYPE' => ' type="text/css"',
			),
		),

		'END_OF_PAGE_CORE_PLUGINS' => array(
			array(
				/**
				* the raw src= definition is included because the browser will ignore
				* anything in the body of the script if the src attribute is defined
				*/
				'SRC' => '  src="/assets/plugins/jquery.min.js" ', 
				'SRC' => '  src="/assets/plugins/jquery.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/jquery-migrate.min.js"  ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			# IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip 
			array(
				'SRC' => '  src="/assets/plugins/jquery-ui/jquery-ui.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/bootstrap/js/bootstrap.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/jquery.blockui.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/jquery.cokie.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/uniform/jquery.uniform.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/scripts/fingerprint.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/scripts/fingerprint2.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC'	=> '  src="/assets/scripts/fingerprint_harness.js"', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			
			array(
				'SRC' => '  src="/assets/scripts/just-core.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			
		),
		'END_OF_PAGE_SCRIPTS' => array(
			array(
				'SRC' =>   '  src="/assets/scripts/metronic.js"', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/scripts/layout.js"', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" ', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/scripts/quick-sidebar.js"', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			/*
			array(
				'SRC' => '  src="https://keenthemes.com/preview/metronic/theme/assets/layouts/global/scripts/quick-nav.min.js"', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="https://keenthemes.com/preview/metronic/theme/assets/layouts/layout/scripts/demo.min.js"', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			array(
				'SRC' => '  src="/assets/scripts/demo.js"', 
				'TYPE'	=> ' type="text/javascript" ',
				#'BODY' => '',
			),
			*/
		),
		'END_OF_PAGE_ONLOAD' => array(
			array(
				'TYPE'	=> ' type="text/javascript" ',
				'BODY' => "
					jQuery(document).ready(function() {    
						Metronic.init(); // init metronic core components
						Layout.init(); // init current layout
						QuickSidebar.init(); // init quick sidebar
						/* ADD METRONIC metronic.js */
					});
					JCORE.service.metronic.expandMetronicMenu();
					
					
				",
			),
		),
		
		
		'ROUTES' => array(
			/**
			* include these in other files for clairity 
			*/
		),
    ),
);


?>