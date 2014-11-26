 <?php
/* @var $this TaskController */
/* @var $model Task */ 
?>
<ul>
<?php foreach($model->taskFiles as $file) { 
	if(!$file->fileExists('patch')) {
		continue;
	}
?>
	<li><?php echo CHtml::link($file->getFileNameStr(), array('uploadFile', 'id'=>$file->getPrimaryKey()), array('target'=>'_blank',));?>

	<small><?php echo date('d-m-Y H:i', $file->time_insert);?></small>


 	<?php $this->widget('application.widgets.BoxButton', array(			
			'deleteButtonUrl'=>array(
				'/task/removeFile', 'id'=>$file->getPrimaryKey(),
			),
			'deleteButtonLabel'=>Yii::t('main', 'Remove file'),
			'createButtonVisible'=>false,			
			'deleteButtonVisible'=>  true,
			'updateButtonVisible'=>false,
			'viewButtonVisible'=>false,
	));?> 

		 
	</li>
<?php } ?>
</ul>
