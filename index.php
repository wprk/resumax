<?php
	// define a working directory
	define('APP_PATH', getcwd()); // PHP v5.3+

	if(getenv(APP_ENV) == 'development') {
		define('ROOT_PATH', '/resumax');
		define('ASSET_PATH', '/resumax/assets');
		define('IMG_PATH', '/resumax/assets/img');
	} else {
		define('ROOT_PATH', '/');
		define('ASSET_PATH', '/assets');
		define('IMG_PATH', '/assets/img');
	}

	// load
	require APP_PATH . '/vendor/autoload.php';

	// init app
	$app = New \SlimController\Slim(array(
		'templates.path'             => APP_PATH . '/resources',
		'controller.class_prefix'    => '\\Resumax\\Controllers',
		'controller.method_suffix'   => 'Action',
		'controller.template_suffix' => 'php',
	));

	$app->addRoutes(array(
		'/'							=> 'Profile:index',
	));

	$app->run();
?>