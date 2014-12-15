<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $users User[] */ 
 

$this->breadcrumbs=array(
        Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project').': '.$model->project->name=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Notify new stage by Email'),
);


$this->menu=array(
//	array('label'=>'List Task', 'url'=>array('index')),
	array(
		'label'=>Yii::t('main','Create Task'), 
		'url'=>array('create', 'categoryId'=>$model->task_category_id)),
	array(
		'label'=>Yii::t('main','Update Task'), 
		'url'=>array('update', 'id'=>$model->id),
		'visible'=>ProjectHelper::ownerTask($model) || ProjectHelper::currentUserCreater($model->project),
		),
	array(
		'label'=>Yii::t('main','View Task'), 
		'url'=>array('view', 'id'=>$model->id),
	),
	//array('label'=>'Manage Task', 'url'=>array('admin')),
);/**/

?>
<h1><?php echo Yii::t('main', 'Notify new stage by Email');?>: <small><?php echo $model->getShortName();?></small></h1>
<div class="form">
<?php echo CHtml::beginForm(); ?>

	<fieldset>
		<legend><?php echo Yii::t('main','Notify of change');?></legend>
		<div class="row list-checked">
			<?php 
			echo CHtml::checkBoxList('notifyUsers', null, Chtml::listData($users, 'id', 'name'), array(
				'template'=>'{input} {label}',
			));
			?>
		
		</div>
	</fieldset>
	<div class="row submit">
	<?php echo CHtml::submitButton(Yii::t('main','Send')); ?>
	</div>
 
<?php echo CHtml::endForm(); ?>
</div> 