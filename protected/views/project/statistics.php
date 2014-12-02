<?php
/* @var $this ProjectController */
/* @var $model Project */
/* @var $taskHistores TaskHistory[] */   
 



$this->breadcrumbs=array(
	Yii::t('main','Projects')=>array('index'),
	$model->name=>array('view', 'id'=>$model->id),
	Yii::t('main','Statistics'),
);

$this->menu=array(
	//array('label'=>Yii::t('main','List Project'), 'url'=>array('index')),
	//array('label'=>Yii::t('main','Create Project'), 'url'=>array('create')),
	array(
		'label'=>Yii::t('main','View Project'), 
		'url'=>array('view', 'id'=>$model->id), 
	),  
	array('label'=>Yii::t('main','Completed tasks'), 'url'=>array('/task/completed', 'id'=>$model->getPrimaryKey())),
	array('label'=>Yii::t('main','Tasks without category'), 'url'=>array('/task/withoutCategory', 'id'=>$model->getPrimaryKey())),
	 
);

?>
<h1><?php echo Yii::t('main', 'Statistics');?> #<?php echo $model->name; ?></h1>

<pre>
<?php 
 
foreach($taskHistores as $taskHistory) { ?> 
<?php echo  ($row['name'] ); ?> - 

	<?php echo  (int)($row['s'] / 60); ?> s:<?php echo  (int)($row['s']); ?> <br/>
<?php } ?>