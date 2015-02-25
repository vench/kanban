<?php
/* @var $this ProjectController */ 
/* @var $model ProjectSearchForm */


$this->breadcrumbs=array(
	Yii::t('main', 'Projects'),
);

$this->menu=array(
	array('label'=>Yii::t('main', 'Create Project'), 'url'=>array('create')),
	//array('label'=>Yii::t('main', 'Manage Project'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
}); 
");
?>

<h1><?php echo Yii::t('main', 'Projects');?></h1>

<?php echo CHtml::link(Yii::t('main','Filter'),'#',array('class'=>'search-button')); ?>

<div class="search-form" <?php if($model->isEmpty()): ?> style="display:none" <?php endif;?>>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$model->search(),
	'itemView'=>'_view',
)); ?>
