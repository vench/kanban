<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
    Yii::t('main', 'Projects')=>array('/project'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Create Task'),
);
/*
$this->menu=array(
	array('label'=>Yii::t('main','List Task'), 'url'=>array('index')),
	array('label'=>Yii::t('main','Manage Task'), 'url'=>array('admin')),
);*/
?>

<h1><?php echo Yii::t('main', 'Create Task');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>