<?php
/* @var $this ProjectController */
/* @var $model Task */
$styes = array();
if($model->hasColor()) {
	$styes[] = 'background:'.$model->getColor();
}
if($model->parent_id > 0 && !is_null($model->parent)) {
	$styes[] = 'border:3px solid '.$model->parent->getColor();
}

?>
<div class="task-box drag" <?php if(sizeof($styes) > 0) :?> style="<?php echo join(';', $styes);?>"<?php endif;?> data-pk="<?php echo $model->getPrimaryKey(); ?>">
	
	<div class="task-box-content" >
		   <?php  if($model->parent_id > 0 && !is_null($model->parent)) {  ?>
		<div class="parent"  >
		<?php echo CHtml::link(Yii::t('main', 'Task parent'), array(
				'/task/view', 'id'=>$model->parent_id, 
			), array( 
			)); ?>
		</div>
	<?php }  ?>
	   <h5>
	   <?php if($model->hasNewComment()) {?> 
	   <span class="comment-new" title="<?php echo Yii::t('main', 'New posts');?>"></span>
	   <?php } ?>
	   
	   <?php echo  Utill::safetext($model->description);?></h5>
	  

		
		<div>
		<?php $this->widget('application.widgets.BoxButton', array(
			'updateButtonUrl'=>array(
				'/task/update', 'id'=>$model->getPrimaryKey(),
			),
			'updateButtonLabel'=>Yii::t('main', 'Update task'),
			
			'viewButtonUrl'=>array(
				'/task/view', 'id'=>$model->getPrimaryKey(),
			),
			'viewButtonLabel'=>Yii::t('main', 'Detail task'),
			
			'deleteButtonUrl'=>array(
				'/task/delete', 'id'=>$model->getPrimaryKey(),
			),
			'deleteButtonLabel'=>Yii::t('main', 'Remove task'),
			'emailButtonUrl'=>array(
				'/task/email', 'id'=>$model->getPrimaryKey(),
			),
			'emailButtonLabel'=>Yii::t('main', 'Notify new stage by Email'),

			'createButtonVisible'=>false,
			'emailButtonVisible'=>true,
			'deleteButtonVisible'=>ProjectHelper::accessEditTask($model),
			'updateButtonVisible'=>ProjectHelper::accessEditTask($model),
		));?> 
		<small>
		<?php echo Yii::t('main', 'Last change {datetime}, {username}', array(
			'{datetime}'=>date('d-m-Y H:i', $model->lastTaskHistory->time_insert),
			'{username}'=>$model->lastTaskHistory->user->name,
		));?>
		</small>		
		</div>    
	</div>
</div>

