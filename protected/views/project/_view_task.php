<?php
/* @var $this ProjectController */
/* @var $model Task */

?>
<div class="task-box drag" <?php if($model->color_hex > 0) :?> style="background:<?php echo $model->getColor();?> "<?php endif;?> data-pk="<?php echo $model->getPrimaryKey(); ?>">
	
	<div class="task-box-content">
	   <h5>
	   <?php if($model->hasNewComment()) {?> 
	   <span class="comment-new" title="<?php echo Yii::t('main', 'New posts');?>">!</span>
	   <?php } ?>
	   
	   <?php echo $model->description;?></h5>
	   
		
		<p>
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
			'createButtonVisible'=>false,
			
			'deleteButtonVisible'=>ProjectHelper::ownerTask($model) || ProjectHelper::currentUserCreater($model->project),
			'updateButtonVisible'=>ProjectHelper::ownerTask($model) || ProjectHelper::currentUserCreater($model->project),
		));?> 
		</p>    
	</div>
</div>

