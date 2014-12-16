<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $tasks Task[] */   
 



$this->breadcrumbs=array(
	Yii::t('main','Projects')=>array('index'),
	$model->name=>array('view', 'id'=>$model->id),
	Yii::t('main','Unload file'),
);

$this->menu=array( 
	array(
		'label'=>Yii::t('main','View Project'), 
		'url'=>array('view', 'id'=>$model->id), 
	), 
);

?>
<h1><?php echo Yii::t('main','Unload file');?></h1>

<?php foreach($model->taskCategories as $taskCategory) { ?>  
	<div class="view">
	<h3><?php echo $taskCategory->name;?></h3>
	<ul>
		 <?php foreach($tasks as $task) { 
			if($task->task_category_id == $taskCategory->getPrimaryKey()) { ?>
			<li><?php echo $task->description; ?></li>
			
			<?php if(sizeof($task->taskComments) > 0) { ?> 
				<br/>
				<b><?php echo Yii::t('main', 'Comments to the task');?></b><br/>
				<ul>
					<?php foreach($task->taskComments as $comment) { ?> 
						<li><?php echo $comment->comment; ?></li>
					<?php }?>
				</ul>
			<?php }?>
			
		 <?php } } ?>
	</ul>
	</div>
<?php } ?>