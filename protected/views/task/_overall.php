<?php
/* @var $this TaskController */
/* @var $model Task */

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		 
		array(
                    'name'=>'project_id', 
                    'type'=>'raw',
                    'value'=>CHtml::link($model->project->name, array('/project/view', 'id'=>$model->project_id))
                ),
		array(
                    'name'=>'task_category_id',
                    'value'=>$model->taskCategory->name,
                ),
		array( 
			'name'=>'is_ready',
			'value'=>$model->is_ready == 1 ? Yii::t('main', 'Yes') : Yii::t('main', 'No'),	
		),	
		array( 
			'name'=>'user_id',
			'value'=>isset($model->user) ? $model->user->getViewName() : Yii::t('main', 'No'),	
		),	
		array( 
			'name'=>'parent_id',
			'value'=>($model->parent_id > 0) ? CHtml::link($model->parent->getShortName(), array('view', 'id'=>$model->parent_id), array('title'=>Yii::t('main', 'View parent'),)) : Yii::t('main', 'No'),
			'type'=>'raw',	
		),	
		array( 
			'name'=>'fulldescription', 
			'type'=>'raw',
		)
	),
)); ?>

