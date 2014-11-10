<?php
/* @var $this ProjectController */
/* @var $data Project */
?>

<div class="view">

    <h4>
	<?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
    </h4>

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo isset($data->user) ? $data->user->name : ''; ?>
	<br />

	 

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>