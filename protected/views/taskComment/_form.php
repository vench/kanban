<?php
/* @var $this TaskCommentController */
/* @var $model TaskComment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-comment-_form-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('main', 'Fields with {sim} are required.', array('{sim}'=>'<span class="required">*</span>'));?></p>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment', array('rows'=>'10', 'cols'=>'100')); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	 
	 
 


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('main','Create') : Yii::t('main','Save') ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->