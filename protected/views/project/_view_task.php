<?php
/* @var $this ProjectController */
/* @var $model Task */

?>
<div class="task-box drag" <?php if($model->hasColor()) :?> style="background:<?php echo $model->getColor();?> "<?php endif;?> data-pk="<?php echo $model->getPrimaryKey(); ?>">
	
	<div class="task-box-content">
	   <h5>
	   <?php if($model->hasNewComment()) {?> 
	   <span class="comment-new" title="<?php echo Yii::t('main', 'New posts');?>"></span>
	   <?php } ?>
	   
	   <?php echo  $model->description;?></h5>
	   
		
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

