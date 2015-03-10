<?php
/* @var $this ChangeUserPasswordController */
/* @var $model ChangeUserPassword */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'change-user-password-_form_pass-form', 
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('main', 'Fields with {sim} are required.', array('{sim}'=>'<span class="required">*</span>'));?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password1'); ?>
		<?php echo $form->passwordField($model,'password1'); ?>
		<?php echo $form->error($model,'password1'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('main', 'Submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->