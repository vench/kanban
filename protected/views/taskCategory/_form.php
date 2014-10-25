<?php
/* @var $this TaskCategoryController */
/* @var $model TaskCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('main', 'Fields with {sim} are required.', array('{sim}'=>'<span class="required">*</span>'));?></p>
	
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'project_id'); ?> 
	 

	<div class="row">
		<?php echo $form->labelEx($model,'order_pos'); ?>
		<?php echo $form->textField($model,'order_pos'); ?>
		<?php echo $form->error($model,'order_pos'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit_task'); ?>
		<?php echo $form->textField($model,'limit_task'); ?>
		<?php echo $form->error($model,'limit_task'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->