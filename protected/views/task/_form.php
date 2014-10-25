<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */

$taskCategory = TaskCategory::model()->findAll(array(
                    'condition'=>'project_id = :project_id',
                    'params'=>array(
                        ':project_id'=>$model->project_id,
                    ),
                    'select'=>'id,name',
                    'order'=>'order_pos DESC'
));


?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
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
		<?php echo $form->labelEx($model,'task_category_id'); ?>
		<?php echo $form->dropDownList($model,'task_category_id', CHtml::listData($taskCategory, 'id', 'name'), array(
                    'empty'=>'--- нет ---',
                )); ?>
		<?php echo $form->error($model,'task_category_id'); ?>
	</div>
        
        
        
        <div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority'); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'is_ready'); ?>
		<?php echo $form->checkBox($model,'is_ready'); ?>
		<?php echo $form->error($model,'is_ready'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fulldescription'); ?>
		<?php echo $form->textArea($model,'fulldescription',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fulldescription'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->