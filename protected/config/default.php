<?php

 
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Kanban projects',
        'language'=>'ru',

 
	'preload'=>array('log'),

	 
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.behaviors.*',
	),

	'modules'=>array( 
		/**/
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
		
        'money'=>array( 
		),
   
		'date'=>array(
		
		),
	),

	 
	'components'=>array(
		'user'=>array(
			 
			'allowAutoLogin'=>true,
		),
		'mail'=>array(
                    'class'=>'application.extensions.yii-mail.YiiMail'
                ),
		 
                /*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		/**/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=test',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
                        'tablePrefix'=>'tbl_',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				), 
			),
		),
	),

 
	'params'=>array( 
		'adminEmail'=>'webmaster@example.com',
	),
);
