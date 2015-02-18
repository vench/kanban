<?php 
/* @var $this ProjectController */
/* @var $model Project */
/* @var $showParent boolean */  

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		 
		array('name'=>'user_id', 'value'=>$model->user->name),		 
		array('name'=>'description','type'=>'raw',), 
		array(
			'label'=>Yii::t('main', 'Only the main tasks'),
			'type'=>'raw',
			'value'=>$showParent ? CHtml::link(Yii::t('main', 'No'), array('view', 'id'=>$model->id, 'only-parent'=>0,)) : CHtml::link(Yii::t('main', 'Yes'), array('view', 'id'=>$model->id, 'only-parent'=>1,))
		),  
	),
)); 