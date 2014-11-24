<?php
/* @var $this TaskCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Task Categories',
);

$this->menu=array(
	array('label'=>'Create TaskCategory', 'url'=>array('create')),
	array('label'=>'Manage TaskCategory', 'url'=>array('admin')),
);
?>

<h1>Task Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
