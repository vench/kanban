<?php

/* @var $model Project */
/* @var $file TaskFile */
/* @var $this ProjectController */

$this->breadcrumbs=array(
	Yii::t('main','Projects')=>array('index'),
	$model->name=>array('view', 'id'=>$model->id),
        Yii::t('main', 'Add file')
);

?>

<h1><?php echo Yii::t('main', 'Add file');?></h1>

<?php
$this->renderPartial('/task/_file_form', array(
   'model'=>$file,
));