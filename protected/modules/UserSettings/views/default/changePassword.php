<?php
/* @var $this DefaultController */
/* @var $model User */

$this->breadcrumbs=array(
	Yii::t('UserSettingsModule.main','User settings')=>array('index'),
        Yii::t('UserSettingsModule.main','Change password'),
);
?>
<h1><?php echo Yii::t('UserSettingsModule.main','Change password'); ?></h1>
<?php if(Yii::app()->user->hasFlash('UserInfoChange')) {?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('UserInfoChange'); ?>
</div>
<?php } ?>
 <?php 
$this->widget('CTabView', array(
     'activeTab'=>strtolower($this->getAction()->getId()),
     'tabs'=>array(         
         'index'=>array(
             'title'=>Yii::t('UserSettingsModule.main','Edit general'),
             'url'=>$this->createAbsoluteUrl('/userSettings/default/index'),
            // 'view'=>'form/_general',
            // 'data'=>array('model'=>$model),
         ),
         'changepassword'=>array(
             'title'=>Yii::t('UserSettingsModule.main','Change password'),
             'visible'=>$this->module->changePassword,
             //'url'=>$this->createAbsoluteUrl('/userSettings/default/changePassword'),
             'view'=>'form/_changepassword',
             'data'=>array('model'=>$changeUserPassword),
        ),
         'notifications'=>array(
             'title'=>Yii::t('UserSettingsModule.main','Notifications: {count}', array(
                 '{count}'=>$this->getCountNewNotification($model),
             )),
             'url'=>$this->createAbsoluteUrl('/userSettings/default/notifications'),
         ),
     ),
));