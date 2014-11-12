<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $taskComment TaskComment */
 

$this->breadcrumbs=array(
        Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Detail task'),
);

$this->menu=array(
//	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>Yii::t('main','Create Task'), 'url'=>array('create', 'categoryId'=>$model->task_category_id)),
	array('label'=>Yii::t('main','Update Task'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('main','Delete Task'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Task', 'url'=>array('admin')),
);/**/
?>

<h1><?php echo Yii::t('main', 'Detail task');?> #<?php echo $model->description; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		 
		array(
                    'name'=>'project_id', 
                    'type'=>'raw',
                    'value'=>CHtml::link($model->project->name, array('/project/view', 'id'=>$model->project_id))
                ),
		array(
                    'name'=>'task_category_id',
                    'value'=>$model->taskCategory->name,
                ),
		array( 
			'name'=>'is_ready',
			'value'=>$model->is_ready == 1 ? Yii::t('main', 'Yes') : Yii::t('main', 'No'),	
		),		
		array( 
			'name'=>'fulldescription', 
			'type'=>'raw',
		)
	),
)); ?>

<br/><br/>
<h3><?php echo Yii::t('main', 'History of status changes');?></h3> 
<table class="detail-view">
	<thead>
		<th><?php echo Yii::t('main', 'Date'); ?></th>
		<th><?php echo Yii::t('main', 'Status'); ?></th>
		<th><?php echo Yii::t('main', 'User'); ?></th>
	</thead>
	<tbody>
<?php foreach($model->taskHistories as $n=>$history) { ?> 
<tr class="<?php if($n % 2 == 0): ?>  odd <?php else :?> even<?php  endif?>">
    <td><?php echo Yii::t('main', 'Time insert: {date}', array(
        '{date}'=>date('d.m.Y H:i', $history->time_insert),
    ));?>
    </td><td>
    <?php echo $history->newCategory->name; ?>
    </td><td>    
    <?php if(isset($history->user)) {?>  
        <?php echo Yii::t('main', 'Changed'); ?> <?php echo $history->user->name; ?>
    <?php }?>    
    </td>
</tr>	
<?php } ?>
	</tbody>
</table>

<br/><br/>
<h3><?php echo Yii::t('main', 'Comments to the task');?></h3> 

<?php
 $this->renderPartial('_comment_form',array('model'=>$taskComment));
 ?>
<?php foreach($model->taskComments as $taskComment) { ?> 
	<div>
		<?php echo $taskComment->comment;?>
	</div>
<?php } ?>

