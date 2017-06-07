<?php 
return array(
    'TEMPLATER' => array(
		'TEMPLATES_DIR' => $GLOBALS["APPLICATION_ROOT"].'HTTP_ASSETS/TEMPLATES/',
		'JUST_CORE_MENU' => array(
			array(
				'NAME' => 'Home',
				'HREF' => '/Home',
				'ICON_CLASS' => 'icon-home',
				'DATA' => 'HOME',
			),
			/**
			*	********************************************************
			*/
			array(
				'NAME' => 'Dashboard',
				'HREF' => 'javascript:;',
				'ICON_CLASS' => 'icon-graph',
				'DATA' => 'Dashboard',
				'ACL_RULE' => array(
					'order' => 'allow',
					#'role' => 'super_user',  admin  pulled from session
					'rule' => 'admin_access',#admin_access	super_user_access
				),
				'SUB_ITEMS' => array(
					array(
						'NAME' => 'User Log',
						'HREF' => '/UserLog',
						'ICON_CLASS' => 'icon-pie-chart',
						'DATA' => 'Dashboard/UserLog',
					),
					array(
						'NAME' => 'Cron Log',
						'HREF' => '/CronLog',
						'ICON_CLASS' => 'icon-bar-chart',
						'DATA' => 'Dashboard/CronLog',
					),

					array(
						'NAME' => 'Explore',
						'HREF' => '/Explore',
						'ICON_CLASS' => 'icon-compass',
						'DATA' => 'Dashboard/Explore',
					),
					
					
				),
			),
			array(
				'NAME' => 'Account',
				'HREF' => 'javascript:;',
				'ICON_CLASS' => 'icon-user',
				'DATA' => 'Account',
				'SUB_ITEMS' => array(
					array(
						'NAME' => 'API Settings',
						'HREF' => '/Account/APISettings',
						'ICON_CLASS' => 'icon-layers',
						'DATA' => 'Account/APISettings',
					),
					array(
						'NAME' => 'User Details',
						'HREF' => '/Account/UserDetails',
						'ICON_CLASS' => 'icon-home',
						'DATA' => 'Account/UserDetails',
					),
					array(
						'NAME' => 'Billing Details',
						'HREF' => '/Account/BillingDetails',
						'ICON_CLASS' => 'icon-credit-card',
						'DATA' => 'Account/BillingDetails',
					),
				),
			),
			array(
				'NAME' => 'Project Documentation',
				'HREF' => 'javascript:;',
				'ICON_CLASS' => 'icon-map',
				'DATA' => 'Tech',
				'SUB_ITEMS' => array(
					array(
						'NAME' => 'FAQ',
						'HREF' => '/WIKI/FAQ',
						'ICON_CLASS' => 'icon-directions',
						'DATA' => 'Tech/WIKI/FAQ',
					),
					array(
						'NAME' => 'Class Documentation',
						'HREF' => '/docs/api',
						'ICON_CLASS' => 'icon-compass',
						'DATA' => 'Tech/WIKI/Class-Documentation',
					),
					
					array(
						'NAME' => 'Overview',
						'HREF' => 'javascript:;',
						'ICON_CLASS' => 'icon-direction',
						'DATA' => 'Tech/WIKI/Overview',
						'SUB_ITEMS' => array(
							array(
								'NAME' => 'APIs',
								'HREF' => '/WIKI/APIs',
								'ICON_CLASS' => 'icon-direction',
								'DATA' => 'Tech/WIKI/Overview/APIs',
							),
							array(
								'NAME' => 'Load',
								'HREF' => '/WIKI/Load',
								'ICON_CLASS' => 'icon-direction',
								'DATA' => 'Tech/WIKI/Overview/Load',
							),
							array(
								'NAME' => 'Configuration',
								'HREF' => '/WIKI/Configuration',
								'ICON_CLASS' => 'icon-direction',
								'DATA' => 'Tech/WIKI/Overview/Configuration',
							),
							array(
								'NAME' => 'Dependency Management',
								'HREF' => '/WIKI/Dependency-Management',
								'ICON_CLASS' => 'icon-direction',
								'DATA' => 'Tech/WIKI/Overview/Dependency-Management',
							),
						)
						
					),

					array(
						'NAME' => 'Project Installation',
						'HREF' => '/WIKI/Project-Installation',
						'ICON_CLASS' => 'icon-direction',
						'DATA' => 'Tech/WIKI/Project-Installation',
					),
					array(
						'NAME' => 'Scripts',
						'HREF' => '/WIKI/Scripts',
						'ICON_CLASS' => 'icon-direction',
						'DATA' => 'Tech/WIKI/Scripts',
					),
					array(
						'NAME' => 'Summary',
						'HREF' => '/WIKI/Summary',
						'ICON_CLASS' => 'icon-direction',
						'DATA' => 'Tech/WIKI/Summary',
					),
					array(
						'NAME' => 'stub_AJAX-example',
						'HREF' => '/WIKI/Summary',
						'ICON_CLASS' => 'icon-direction',
						'DATA' => 'Tech/WIKI/stub_AJAX-example',
					),
					
					
					array(
						'NAME' => 'Project Structure',
						'HREF' => '/WIKI/Project-Structure',
						'ICON_CLASS' => 'icon-direction',
						'DATA' => 'Tech/WIKI/Project-Structure',
						'SUB_ITEMS' => array(
						
						),
					),
					

					array(
						'NAME' => 'API RAW CALL',
						'HREF' => '/APICall',
						'ICON_CLASS' => 'icon-magnifier',
						'DATA' => 'Tech/APICall',
					),
				),
			),

			array(
				'NAME' => 'Contact',
				'HREF' => '/Contact',
				'ICON_CLASS' => 'icon-support',
				'DATA' => 'Contact',
			),
			array(
				'NAME' => 'Logout',
				'HREF' => '/logout.php',
				'ICON_CLASS' => 'icon-logout',
			),
		),
	),
	
);
?>