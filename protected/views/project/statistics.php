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


<?php 
$category = array();
$users = array();
for($i = 0; $i < sizeof($taskHistores); $i ++) { 
	$taskHistory = $taskHistores[$i];
	$taskHistoryNext = ($i + 1 == sizeof($taskHistores)) ? NULL : $taskHistores[$i+1];
	if(!isset($category[$taskHistory->new_category_id])){
		$category[$taskHistory->new_category_id] = array(
			'time'=>0,
			'count'=>0, 
		);
	}	
	if(!is_null($taskHistoryNext) && $taskHistory->task_id == $taskHistoryNext->task_id) {  
		 $category[$taskHistory->new_category_id]['time'] += ($taskHistoryNext['time_insert'] - $taskHistory['time_insert']);  
		 $category[$taskHistory->new_category_id]['count'] ++;
		 
		 if(!isset( $users[$taskHistory->user_id][$taskHistory->new_category_id]  )) {
			$users[$taskHistory->user_id][$taskHistory->new_category_id] = array(
				'time'=>0,
				'count'=>0,
			);
		 }
		 $users[$taskHistory->user_id][$taskHistory->new_category_id]['time'] += ($taskHistoryNext['time_insert'] - $taskHistory['time_insert']);
		 $users[$taskHistory->user_id][$taskHistory->new_category_id]['count'] ++;	
	}  
?> 
 
 
<?php } ?>

<h3><?php echo Yii::t('main', 'General statistics'); ?></h3> <?php /*
<ul>
	<?php foreach($category as $id=>$data){ 
	$categotyTask = $model->getCategoryById($id);
	
	$hour = (int)($data['time'] / 3600);
	$min = (int)(($data['time'] % 3600 ) / 60);
	$sec = ($data['time'] % 60);
	?> 
	<li><?php echo is_null($categotyTask) ? Yii::t('main', 'Without Category') : $categotyTask->name; ?>  
	    <?php echo Yii::t('main', 'Count'); ?>
		<?php echo $data['count']; ?>; 
		<?php echo Yii::t('main', 'Time'); ?>
		<?php echo ($hour > 9) ? $hour : '0'.$hour; ?>:<?php echo ($min > 9) ? $min : '0'.$min; ?>:<?php echo ($sec > 9) ? $sec : '0'.$sec; ?>
	</li>
	
	<?php } ?>
</ul> <?php */ 

$this->widget('application.widgets.StatisticCategoty', array(
	'data'=>$category,
	'project'=>$model,
));

?>
<h3><?php echo Yii::t('main', 'Statistics on users'); ?></h3>	
<ul>
<?php foreach($users as $user_id=> $data) { 
	$user = User::model()->findByPk($user_id);
	?> 
		<li>
				<?php echo $user->name; ?>
			<?php $this->widget('application.widgets.StatisticCategoty', array(
	'data'=>$data,
	'project'=>$model,
)); ?>
		</li>
<?php } ?>
</ul>


