<?php
/* @var $this MoneyController */
/* @var $model Money */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'money-_form-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('MoneyModule.main', 'Fields with {sim} are required.', array(
            '{sim}'=>'<span class="required">*</span>',
        ))?></p>

	<?php echo $form->errorSummary($model); ?>

 

	<div class="row">
		<?php echo $form->labelEx($model,'money'); ?>
		<?php echo $form->textField($model,'money'); ?>
		<?php echo $form->error($model,'money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model, 'status', Money::getListStatus()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

 

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment', array(
                    'rows'=>'3', 'cols'=>'60',
                )); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton(  Yii::t('MoneyModule.main', 'Save')  ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->