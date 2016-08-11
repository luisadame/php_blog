<?php
	
	$basedir = dirname(dirname(__FILE__)); // /app
	
	return [

		'views_path' => $basedir . '/views',
		'routes_path' => $basedir . '/http/routes.php',
		'controllers_path' => $basedir . '/controllers',
		'baseUrl' => 'http://blog.dev'

	];