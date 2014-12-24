<?php
/* @var $this InstallController */
/* @var $installForm $installForm */
?>
<h1><?php echo Yii::t('install', 'Install page');?></h1>
<p><?php echo Yii::t('install', 'Hello to install page');?></p>
<?php $this->renderPartial('_form', array('model'=>$installForm)); ?>