<?php

    return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Kanban projects',
    'language'=>'ru',
    'defaultController'=>'install', 
    'preload'=>array('log'), 
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),
    
    'components'=>array(
        'user'=>array( 
            'allowAutoLogin'=>true,
        ),
        'errorHandler'=>array( 
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