<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */

$this->breadcrumbs=array(
    Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Create TaskCategory'),
);

$this->menu=array(
	array('label'=>Yii::t('main','Project'), 'url'=>array('/project/view', 'id'=>$model->project_id)),
	//array('label'=>'Manage TaskCategory', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('main', 'Create TaskCategory');?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>