<?php
/* @var $this TaskController */
/* @var $models Task[] */
/* @var $model Project */


$this->breadcrumbs=array(
    Yii::t('main', 'Projects')=>array('/project'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->id),
	Yii::t('main', 'Completed tasks'),
);


$this->menu=array(
	array('label'=>Yii::t('main','Project'), 'url'=>array('/project/view', 'id'=>$model->id)),
);
?>



<h1><?php echo Yii::t('main','Completed tasks');?></h1>

<?php foreach($models as $model) {?> 
<?php 
$this->renderPartial('_view', array(
	'data'=>$model,
));
?>

<?php }?>