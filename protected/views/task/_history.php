<?php
/* @var $this TaskController */
/* @var $model Task */
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'task-history-grid',
	'dataProvider'=>$model->searchHistories(), 
	'columns'=>array(
		array(
			'name'=>'time_insert',
			'header'=>Yii::t('main', 'Date'),
			'value'=>'date("d.m.Y H:i", $data->time_insert)', 
		), 	
		array(
			'name'=>'new_category_id',
			'header'=>Yii::t('main', 'Status'),
			'value'=>'$data->newCategory->name',
		),
		array(
			'name'=>'user_id',
			'header'=>Yii::t('main', 'User'),
			'value'=>'$data->user->name',
		),  
	),
));
