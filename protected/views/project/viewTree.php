<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $tasks Task[] */   
 



$this->breadcrumbs=array(
	Yii::t('main','Projects')=>array('index'),
	$model->name=>array('view', 'id'=>$model->id),
	Yii::t('main','View tree'),
);

$this->menu=array( 
	array(
		'label'=>Yii::t('main','View Project'), 
		'url'=>array('view', 'id'=>$model->id), 
	), 
);

?>
<h1><?php echo Yii::t('main','View tree');?></h1>

<?php foreach($model->taskCategories as $taskCategory) { ?>  
	<div class="view">
	<h3><?php echo $taskCategory->name;?></h3>
	<ol>
		 <?php foreach($tasks as $task) { 
			if($task->task_category_id == $taskCategory->getPrimaryKey()) { ?>
			<li><b><?php echo Utill::safetext($task->description); ?></b><br/>
			<em><?php echo Utill::safetext($task->fulldescription); ?></em>
			
			<?php if(sizeof($task->taskComments) > 0) { ?> 
				<br/>
				<b><?php echo Yii::t('main', 'Comments to the task');?></b><br/>
				<ol>
					<?php foreach($task->taskComments as $comment) { ?> 
						<li><?php echo $comment->comment; ?></li>
					<?php }?>
				</ol>
			<?php }?>
			</li>
			
		 <?php } } ?>
	</ol>
	</div>
<?php } ?>