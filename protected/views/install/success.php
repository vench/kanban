<?php

/* @var $this InstallController */
?>
<h1><?php echo Yii::t('install', 'Success install page'); ?></h1>

<p>
    <?php echo Yii::t('install', 'We thank you for using our app.');?><br/>
    <?php echo Yii::t('install', 'Use default login:admin and password :admin.');?> 
   <br/> <?php echo CHtml::link(Yii::t('install', 'Go to main page'), array('/site/index')); ?></p>