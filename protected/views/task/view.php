<?php
/* @var $this TaskController */
/* @var $model Task */

$this->breadcrumbs=array(
	'Tasks'=>array('index'),
	Yii::t('main', 'Detail task'),
);

$this->menu=array(
	array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>'Create Task', 'url'=>array('create')),
	array('label'=>'Update Task', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Task', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Task', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('main', 'View Task');?> #<?php echo $model->description; ?></h1>

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
		'is_ready', 
		'fulldescription',
	),
)); ?>

<h3><?php echo Yii::t('main', 'History');?></h3>
<?php foreach($model->taskHistories as $history) { ?> 
    <div><?php echo Yii::t('main', 'Time insert: {date}', array(
        '{date}'=>date('d.m.Y H:i', $history->time_insert),
    ));?>
    
    <?php echo $history->newCategory->name; ?>
    </div>
<?php } ?>
