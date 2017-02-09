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
					'Installation' => 'Installation.md',
					#'Load' => 'Load.md',
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