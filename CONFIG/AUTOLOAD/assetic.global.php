<?php 
/**
* 
*/

return array(
    'ASSETIC' => array(
		'CACHE_PATH' => 'CACHE/HTTP',
		'HTTP_PATH' => 'assets/cache/',
		'FILTERS' => array(
			'CSS' => array(
				'DEFAULT' => 'Assetic\Filter\CssMinFilter',
				/*
				'DEFAULT' => '',
				'DEFAULT' => 'Assetic\Filter\CleanCssFilter',
				'DEFAULT' => 'Assetic\Filter\UglifyCssFilter',
				'DEFAULT' => 'Assetic\Filter\CssRewriteFilter',
				*/
			),
			'JS' => array(
				'DEFAULT' => 'Assetic\Filter\JSMinFilter',
				/*
				'DEFAULT' => '',
				'DEFAULT' => 'Assetic\Filter\JSMinPlusFilter',
				'DEFAULT' => 'Assetic\Filter\JSqueezeFilter',
				'DEFAULT' => 'Assetic\Filter\UglifyJs2Filter',
				'DEFAULT' => 'Assetic\Filter\UglifyJsFilter',
				'DEFAULT' => 'Assetic\Filter\GoogleClosure\CompilerApiFilter',
				*/
			),
		),
	),
);

?>
