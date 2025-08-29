<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Blog Management System with Role-Based Access',
	'language'=>'en',
	'timeZone'=>'Asia/Beirut',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Reii123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),
	
	'components'=>array(
		'user'=>array(
    	'class'=>'WebUser',          
    	'allowAutoLogin'=>true,
    	'loginUrl'=>array('site/login'),
		),
		'db' => array(
    		'connectionString' => 'mysql:host=127.0.0.1;port=3307;dbname=blogmanagement',
    		'username' => 'bloguser',
    		'password' => 'StrongPass123!',
    		'charset' => 'utf8',
    		'emulatePrepare' => true,
	  ),
		'urlManager'=>array(
    		'urlFormat'=>'get', 
    		'showScriptName'=>true,  
		),


		// database settings are configured in database.php


		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'request'=>array(
        'enableCsrfValidation'=>true,
        'enableCookieValidation'=>true,
    ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
