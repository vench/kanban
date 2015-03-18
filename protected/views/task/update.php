<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $taskFile TaskFile */
 

$this->breadcrumbs=array(
    Yii::t('main', 'Projects')=>array('/project'),
	Yii::t('main', 'Project')=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Update task'),
);

$this->menu=array(
	//array('label'=>'List Task', 'url'=>array('index')),
	array('label'=>Yii::t('main','Create Task'), 'url'=>array('create', 'categoryId'=>$model->task_category_id)),
	array('label'=>Yii::t('main','View Task'), 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Task', 'url'=>array('admin')),
);


 
?>

<h1><?php echo Yii::t('main', 'Update task');?> <?php echo $model->description; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

<h4><?php echo Yii::t('main', 'Task files');?></h4>
<?php $this->renderPartial('_file_form',array('model'=>$taskFile));  ?>
<?php $this->renderPartial('_files',array('model'=>$model));  ?>
