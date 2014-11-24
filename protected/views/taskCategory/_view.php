<?php
/* @var $this TaskCategoryController */
/* @var $data TaskCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_id')); ?>:</b>
	<?php echo CHtml::encode($data->project_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_pos')); ?>:</b>
	<?php echo CHtml::encode($data->order_pos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_task')); ?>:</b>
	<?php echo CHtml::encode($data->limit_task); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />


</div>