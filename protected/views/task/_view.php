<?php
/* @var $this TaskController */
/* @var $data Task */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('task_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->task_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_ready')); ?>:</b>
	<?php echo CHtml::encode($data->is_ready); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fulldescription')); ?>:</b>
	<?php echo CHtml::encode($data->fulldescription); ?>
	<br />


</div>