<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */

 

$this->breadcrumbs=array(
    Yii::t('main', 'Projects')=>array('/project'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Update TaskCategory'),
);

$this->menu=array(
	/*array('label'=>'List TaskCategory', 'url'=>array('index')),
	array('label'=>'Create TaskCategory', 'url'=>array('create')),
	array('label'=>'View TaskCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TaskCategory', 'url'=>array('admin')),*/
	array('label'=>Yii::t('main','Add category task'), 'url'=>array('/taskCategory/create', 'projectId'=>$model->project_id)),
	array('label'=>Yii::t('main','Project'), 'url'=>array('/project/view', 'id'=>$model->project_id)),
);
?>

<h1><?php echo Yii::t('main', 'Update TaskCategory');?>: <small><?php echo $model->name; ?></small></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>