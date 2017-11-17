<?php 
/**
* consume markdown pages into a regular layout
* TODO:
* 
*/
return array(
    'JUST_CORE' => array(
		'WIKI_ROUTES' => array(
			'WIKI' => array(
				'BASE_PATH' => $GLOBALS["APPLICATION_ROOT"].'docs/',
				'FILE_MAP' => array(
					'index' => 'index.md',
					'APIs' => 'APIs.md',
					'Configuration' => 'Configuration.md',
					'Dependency-Management' => 'Dependency-Management.md',
					'Project-Installation' => 'Project-Installation.md',
					'Scripts' => 'Scripts.md',
					'Summary' => 'Summary.md',
					'FAQ' => 'FAQ.md',
					'stub_AJAX-example' => 'stub_AJAX-example.md',
					'Load' => 'Load.md', //in the main repo
				),
			),
			'PACKAGES' => array(
				'BASE_PATH' => $GLOBALS["APPLICATION_ROOT"].'just-core.wiki/',
				'FILE_MAP' => array(
					'Packages and Extensions' => 'Packages-and-Extensions.md',
				),
			
			),
		),
    ),
);
?>