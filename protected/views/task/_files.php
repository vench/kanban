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
	<li><?php echo CHtml::link(basename($file->patch), array('uploadFile', 'id'=>$file->getPrimaryKey()), array('target'=>'_blank',));?></li>
<?php } ?>
</ul>