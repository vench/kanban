<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */

 

$this->breadcrumbs=array(
    Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Update TaskCategory'),
);
/*
$this->menu=array(
	array('label'=>'List TaskCategory', 'url'=>array('index')),
	array('label'=>'Create TaskCategory', 'url'=>array('create')),
	array('label'=>'View TaskCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TaskCategory', 'url'=>array('admin')),
);*/
?>

<h1><?php echo Yii::t('main', 'Update TaskCategory');?>: <small><?php echo $model->name; ?></small></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>