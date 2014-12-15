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
                    'order'=>'order_pos'
));


?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form', 
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('main', 'Fields with {sim} are required.', array('{sim}'=>'<span class="required">*</span>'));?></p>
	
        <?php echo $form->errorSummary($model); ?> 
	
        <?php echo $form->hiddenField($model,'project_id'); ?> 
        
	<fieldset>
		<legend><?php echo Yii::t('main','Overall');?></legend>
	
        <div class="row">
		<?php echo $form->labelEx($model,'task_category_id'); ?>
		<?php echo $form->dropDownList($model,'task_category_id', CHtml::listData($taskCategory, 'id', 'name'), array(
                    'empty'=>'--- нет ---',
                )); ?> 
		<?php echo $form->error($model,'task_category_id'); ?>
	</div>
        
        
        <div class="row">
		<?php echo $form->labelEx($model,'color_hex'); ?> 
		<?php $this->widget('ext.colorpicker.ColorPicker', array(
                    'model' => $model,
                    'attribute' => 'color_hex',
                    'options' => array( // Optional
                        'pickerDefault' => "ffffff", // Configuration Object for JS
                    ),
         )); ?>	 
		<?php echo $form->error($model,'color_hex'); ?>
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
	
	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id', CHtml::listData(Task::model()->findAll(array(
			'select'=>'id,description',
			'condition'=>$model->isNewRecord ? 'project_id = :project_id' : 'project_id = :project_id AND id <> :id',
			'params'=>$model->isNewRecord ? array(
				':project_id'=>$model->project_id,
			) : array(
				':id'=>$model->getPrimaryKey(),
				':project_id'=>$model->project_id,
			)
		)), 'id', 'ShortName'), array(
			'empty'=>'',
		)); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>
	</fieldset>
	<fieldset>
		<legend><?php echo Yii::t('main','Notify of change');?></legend>
		<div class="row list-checked">
			<?php
			$users = Chtml::listData(User::model()->findAll(array(
				'select'=>'id,name',
				'condition'=>'id = :uid1 OR id IN (SELECT user_id FROM {{user_project}} WHERE project_id=:pid1)',
				'params'=>array(
					':pid1'=>$model->project_id,
					':uid1'=>$model->project->user_id,
				),
			)), 'id', 'name');
			echo CHtml::checkBoxList('notifyUsers', null, $users, array(
				'template'=>'{input} {label}',
			));
			?>
		
		</div>
	</fieldset>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('main','Create') : Yii::t('main','Save') ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
 
