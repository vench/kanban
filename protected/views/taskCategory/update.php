<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */

$this->breadcrumbs=array(
	'Task Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TaskCategory', 'url'=>array('index')),
	array('label'=>'Create TaskCategory', 'url'=>array('create')),
	array('label'=>'View TaskCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TaskCategory', 'url'=>array('admin')),
);
?>

<h1>Update TaskCategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>