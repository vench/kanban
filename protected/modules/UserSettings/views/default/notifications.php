<?php
/* @var $this DefaultController */
/* @var $model User */
/* @var $notification Notification */

$this->breadcrumbs=array(
	Yii::t('UserSettingsModule.main','User settings')=>array('index'),
        Yii::t('UserSettingsModule.main','Notifications'),
);
?>
<h1><?php echo Yii::t('UserSettingsModule.main','Notifications'); ?></h1>

 <?php 
$this->widget('CTabView', array(
     'activeTab'=>strtolower($this->getAction()->getId()),
     'tabs'=>array(         
         'index'=>array(
             'title'=>Yii::t('UserSettingsModule.main','Edit general'),
             'url'=>$this->createAbsoluteUrl('/userSettings/default/index'),
             //'view'=>'form/_general',
             //'data'=>array('model'=>$model),
         ),
         'changepassword'=>array(
             'title'=>Yii::t('UserSettingsModule.main','Change password'),
             'visible'=>$this->module->changePassword,
             'url'=>$this->createAbsoluteUrl('/userSettings/default/changePassword'),
        ),
         'notifications'=>array(
             'title'=>Yii::t('UserSettingsModule.main','Notifications'),
            // 'url'=>$this->createAbsoluteUrl('/userSettings/default/notifications'),
             'view'=>'form/_notifications',
             'data'=>array(
                 'model'=>$model,
                 'notification'=>$notification,
             ),
         ),
     ),
));