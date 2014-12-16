<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */

$this->breadcrumbs=array(
	Yii::t('main','Projects')=>array('index'),
	$model->project->name=>array('/project/view', 'id'=>$model->project_id),
	$model->name,
);


$this->menu=array( 
	array('label'=>Yii::t('main', 'Edit caegory'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('main', 'Remove caegory'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	 
);
?>

<h1><?php echo Yii::t('main', 'Task Category');?> #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		 
		array(
			'name'=>'project_id', 
			'type'=>'raw',
			'value'=>CHtml::link($model->project->name,array('/project/view', 'id'=>$model->project_id)),
		), 
		'limit_task',
		'name',
	),
)); ?>

 <h2><?php echo Yii::t('main', 'Tasks');?> </h2>

<?php foreach($model->tasks as $task) {?> 
<?php 
$this->renderPartial('/task/_view', array(
	'data'=>$task,
));
?>

<?php }?>