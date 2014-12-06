<?php

/* @var $this TaskCommentController */
/* @var $model TaskComment */


$this->breadcrumbs=array(
    Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->task->project_id),
        Yii::t('main','View Task')=>array('/task/view', 'id'=>$model->task_id),
	Yii::t('main', 'Update comment'),
);

$this->menu=array( 
	 
	array('label'=>Yii::t('main','View Task'), 'url'=>array('/task/view', 'id'=>$model->task_id)), 
);
?>
<h1><?php echo Yii::t('main', 'Update comment'); ?></h1>

<?php
$this->renderPartial('_form', array(
    'model'=>$model,
));