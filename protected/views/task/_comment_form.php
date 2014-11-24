<?php
/* @var $this TaskCommentController */
/* @var $model TaskComment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-comment-_comment_form-form', 
	'enableAjaxValidation'=>false,
)); ?>
 

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		 
		<?php echo $form->textArea($model,'comment', array('rosw'=>'10', 'cols'=>'70',)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div> 


	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('main','Add Comment')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->