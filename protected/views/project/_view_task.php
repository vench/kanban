<?php
/* @var $this ProjectController */
/* @var $model Task */

?>
<div class="task-box drag" <?php if($model->color_hex > 0) :?> style="background:<?php echo $model->getColor();?> "<?php endif;?> data-pk="<?php echo $model->getPrimaryKey(); ?>">
	
	<div class="task-box-content">
	   <h5><?php echo $model->description;?></h5>
		
		<p>
		<?php echo CHtml::link(Yii::t('main', 'Update task'), array(
			'/task/update', 'id'=>$model->getPrimaryKey(),
		)); ?>
		<?php echo CHtml::link(Yii::t('main', 'Detail task'), array(
			'/task/view', 'id'=>$model->getPrimaryKey(),
		)); ?>
		<?php echo CHtml::link(Yii::t('main', 'Remove task'), array(
			'/task/delete', 'id'=>$model->getPrimaryKey(),
		)); ?>
		</p>    
	</div>
</div>

