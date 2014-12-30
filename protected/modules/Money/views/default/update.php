<?php


/* @var $this DefaultController */ 
/* @var $model Money */

$this->breadcrumbs=array(
        Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project').': '.$model->task->project->name=>array('/project/view', 'id'=>$model->task->project_id),
	Yii::t('main', 'Detail task')=>array('/task/view', 'id'=>$model->task->getPrimaryKey()),
        Yii::t('MoneyModule.main', 'Update money'),
);

$this->menu=array(  
	array(
		'label'=>Yii::t('main','View Task'), 
		'url'=>array('/task/view', 'id'=>$model->task->id), 
		),  
);
?>

<h1><?php echo  Yii::t('MoneyModule.main', 'Update money');?> </h1>

<?php
$this->renderPartial('_form', array(
    'model'=>$model,
));