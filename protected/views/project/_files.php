<?php

/* @var $model Project */

?>
<ul>
<?php foreach($model->taskFiles as $file) { 
	if(!$file->fileExists('patch')) {
		continue;
	}
?>
	<li>
            
            <?php echo CHtml::link(Yii::t('main', 'Show file: {filename}', array(
                '{filename}'=>$file->getFileNameStr(),
            )),    array('/task/uploadFile', 'id'=>$file->getPrimaryKey()), array('target'=>'_blank',));?>
            
            
            <?php 
            if($file->task_id > 0) { 
                echo CHtml::link(Yii::t('main', 'Show task'), array('/task/view', 'id'=>$file->task_id), array('target'=>'_blank',));
            } ?>

	<small><?php echo date('d-m-Y H:i', $file->time_insert);?></small> 
	</li>
<?php } ?>
</ul>

<?php echo CHTml::link(Yii::t('main', 'Add file'), array('addFile', 'id'=>$model->id)); ?>