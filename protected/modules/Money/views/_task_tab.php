<?php 
/* @var $task Task */
/* @var $money Money */ 
 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'task-money-grid',
	'dataProvider'=>$money->search(), 
	'columns'=>array(
		array(
			'name'=>'money',  
                        'value'=>'Utill::moneyFormat( $data->money )',
		), 	
		array(
			'name'=>'status', 
                        'value'=>'$data->getStatusStr()',
		),
		array(
			'name'=>'date_time', 
                        'value'=>'date("d.mY H:i", $data->date_time)',
		), 
                array(
			'name'=>'comment', 
		), 
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update} {delete}',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("/money/default/update",array("id"=>$data->primaryKey))',
                    'deleteButtonUrl'=>'Yii::app()->controller->createUrl("/money/default/delete",array("id"=>$data->primaryKey))',
                ),
	), 
));

echo CHtml::link(Yii::t('MoneyModule.main', 'Add item'), array('/money/default/add', 'task_id'=>$task->getPrimaryKey()));