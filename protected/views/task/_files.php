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
	<li><?php echo CHtml::link(basename($file->patch), array('uploadFile', 'id'=>$file->getPrimaryKey()), array('target'=>'_blank',));?>
		<?php echo CHtml::link(Yii::t('main', 'Remove file'), array('removeFile', 'id'=>$file->getPrimaryKey()), array(
			'onclick'=>'return confirm("'.Yii::t('zii','Are you sure you want to delete this item?').'");',
		)); ?>
	</li>
<?php } ?>
</ul>