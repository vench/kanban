<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */

$this->breadcrumbs=array(
	'Task Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TaskCategory', 'url'=>array('index')),
	array('label'=>'Manage TaskCategory', 'url'=>array('admin')),
);
?>

<h1>Create TaskCategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>