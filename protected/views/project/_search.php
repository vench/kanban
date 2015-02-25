<?php
/* @var $this ProjectController */
/* @var $model ProjectSearchForm */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	 

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?> 
		<?php echo $form->dropDownList($model,'user_id', CHtml::listData(User::model()->findAll(array('select'=>'id,name')), 'id', 'name'), array(
                    'empty'=>'--- --- ---',
                )); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div> 

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('main', 'Search')); ?> 
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->