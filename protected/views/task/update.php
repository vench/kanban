<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
        Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Update task'),
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Create Task', 'url'=>array('create')),
	array('label'=>'View Task', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('main', 'Update task');?> <?php echo $model->description; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>