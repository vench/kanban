<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */

$this->breadcrumbs=array(
	'Task Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TaskCategory', 'url'=>array('index')),
	array('label'=>'Create TaskCategory', 'url'=>array('create')),
	array('label'=>'Update TaskCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TaskCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TaskCategory', 'url'=>array('admin')),
);
?>

<h1>View TaskCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_id',
		'order_pos',
		'limit_task',
		'name',
	),
)); ?>
