<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
        Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Create task'),
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('main', 'Create task');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>