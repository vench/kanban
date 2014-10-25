<?php
/* @var $this ProjectController */
/* @var $model Task */

?>
<div class="task-box">
    <h5><?php echo $model->description;?></h5>
    
    <p>
    <?php echo CHtml::link(Yii::t('main', 'Update task'), array(
        '/task/update', 'id'=>$model->getPrimaryKey(),
    )); ?>
    <?php echo CHtml::link(Yii::t('main', 'Remove task'), array(
        '/task/delete', 'id'=>$model->getPrimaryKey(),
    )); ?>
    </p>    
</div>

