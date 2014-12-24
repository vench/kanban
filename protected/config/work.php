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
            
        ),
        'components'=>array(
            'user'=>array(
                'allowAutoLogin'=>true,
            ),
            'mail'=>array(
                    'class'=>'application.extensions.yii-mail.YiiMail'
             ),
            'db'=>     array(
    'connectionString'=>'mysql:host=localhost;dbname=test2',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'tablePrefix'=>'tbl_', 
    ),
            'errorHandler'=>array(
                'errorAction'=>'site/error',
            ),
        ),
        'params'=>array(
            'adminEmail'=>'nowwrit@mail.ru',
        ),
    );