<?php

/* @var $this DefaultController */
/* @var $task Task */
/* @var $money Money */

$this->breadcrumbs=array(
        Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project').': '.$model->project->name=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Detail task')=>array('/task/view', 'id'=>$task->getPrimaryKey()),
        Yii::t('MoneyModule.main', 'Add money'),
);

$this->menu=array(  
	array(
		'label'=>Yii::t('main','View Task'), 
		'url'=>array('/task/view', 'id'=>$task->id), 
		),  
);
?>
<h1><?php echo  Yii::t('MoneyModule.main', 'Add money');?> </h1>

<?php
$this->renderPartial('_form', array(
    'model'=>$money,
));