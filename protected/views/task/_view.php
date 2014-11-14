<?php
/* @var $this TaskController */
/* @var $data Task */
?>

<div class="view">

	<h4><?php echo CHtml::encode($data->description); ?></h4>
 
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_ready')); ?>:</b>
	<?php echo $data->is_ready == 1 ? Yii::t('main', 'Yes') : Yii::t('main', 'No'); ?>
	<br /><br />
	<p>
	 
 	<?php $this->widget('application.widgets.BoxButton', array(
			'updateButtonUrl'=>array(
				'/task/update', 'id'=>$data->getPrimaryKey(),
			),
			'updateButtonLabel'=>Yii::t('main', 'Update task'),
			
			'viewButtonUrl'=>array(
				'/task/view', 'id'=>$data->getPrimaryKey(),
			),
			'viewButtonLabel'=>Yii::t('main', 'Detail task'),
			
			'deleteButtonUrl'=>array(
				'/task/delete', 'id'=>$data->getPrimaryKey(),
			),
			'deleteButtonLabel'=>Yii::t('main', 'Remove task'),
			'createButtonVisible'=>false,
			
			'deleteButtonVisible'=>ProjectHelper::ownerTask($data) || ProjectHelper::currentUserCreater($data->project),
			'updateButtonVisible'=>ProjectHelper::ownerTask($data) || ProjectHelper::currentUserCreater($data->project),
	));?> 
	</p>
 

	

	 

	 


</div>