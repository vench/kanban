<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $taskComment TaskComment */
 

$this->breadcrumbs=array(
        Yii::t('main', 'Projects')=>array('/projects'),
	Yii::t('main', 'Project').': '.$model->project->name=>array('/project/view', 'id'=>$model->project_id),
	Yii::t('main', 'Detail task'),
);

$this->menu=array(
//	array('label'=>'List Task', 'url'=>array('index')),
	array(
		'label'=>Yii::t('main','Create Task'), 
		'url'=>array('create', 'categoryId'=>$model->task_category_id)),
	array(
		'label'=>Yii::t('main','Update Task'), 
		'url'=>array('update', 'id'=>$model->id),
		'visible'=>ProjectHelper::ownerTask($model) || ProjectHelper::currentUserCreater($model->project),
		),
	array(
		'label'=>Yii::t('main','Delete Task'), 
		'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'),
		'visible'=>ProjectHelper::ownerTask($model) || ProjectHelper::currentUserCreater($model->project),
	),
	//array('label'=>'Manage Task', 'url'=>array('admin')),
	array(
		'label'=>Yii::t('main','Notify new stage by Email'), 
		'url'=>array('email', 'id'=>$model->id),
	),
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
			'name'=>'user_id',
			'value'=>isset($model->user) ? $model->user->getViewName() : Yii::t('main', 'No'),	
		),	
		array( 
			'name'=>'parent_id',
			'value'=>($model->parent_id > 0) ? CHtml::link($model->parent->getShortName(), array('view', 'id'=>$model->parent_id), array('title'=>Yii::t('main', 'View parent'),)) : Yii::t('main', 'No'),
			'type'=>'raw',	
		),	
		array( 
			'name'=>'fulldescription', 
			'type'=>'raw',
		)
	),
)); ?>
<br/><br/>
<h3><?php echo Yii::t('main', 'Task files');?></h3> 
<?php $this->renderPartial('_files',array('model'=>$model));  ?>



<br/><br/>
<h3><?php echo Yii::t('main', 'Comments to the task');?></h3> 

<?php
 $this->renderPartial('_comment_form',array('model'=>$taskComment));
 ?>
<?php foreach($model->taskComments as $taskComment) { ?> 
	<div class="portlet">
		<div class="portlet-decoration">
			<div class="portlet-title">
 	<?php $this->widget('application.widgets.BoxButton', array(			
			'deleteButtonUrl'=>array(
				'/taskComment/delete', 'id'=>$taskComment->getPrimaryKey(),
			),
            'updateButtonUrl'=>array(
				'/taskComment/update', 'id'=>$taskComment->getPrimaryKey(),
			),
			'createButtonUrl'=>array(
				'/taskComment/createTask', 'id'=>$taskComment->getPrimaryKey(),
			),
			'createButtonLabel'=>Yii::t('main', 'Create new task'),
			'deleteButtonLabel'=>Yii::t('main', 'Remove comment'),
			'createButtonVisible'=>true,			
			'deleteButtonVisible'=>  (ProjectHelper::currentUserCreater($model->project) || $taskComment->user_id == Yii::app()->user->getId()),
			'updateButtonVisible'=> (ProjectHelper::currentUserCreater($model->project) || $taskComment->user_id == Yii::app()->user->getId()),
			'viewButtonVisible'=>false,
	));?> 
				<?php echo date('d.m.Y H:i',$taskComment->time_insert);?>
				<?php if(isset($taskComment->user)) { echo $taskComment->user->name;}?>	


			</div>
		</div>
		<div class="portlet-content">
			<?php echo Utill::safetext($taskComment->comment);?>
		</div>
	</div>
<?php } ?>

<br/><br/>
<h3><?php echo Yii::t('main', 'History of status changes');?></h3> 



	 
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'task-history-grid',
	'dataProvider'=>$model->searchHistories(), 
	'columns'=>array(
		array(
			'name'=>'time_insert',
			'header'=>Yii::t('main', 'Date'),
			'value'=>'date("d.m.Y H:i", $data->time_insert)', 
		), 	
		array(
			'name'=>'new_category_id',
			'header'=>Yii::t('main', 'Status'),
			'value'=>'$data->newCategory->name',
		),
		array(
			'name'=>'user_id',
			'header'=>Yii::t('main', 'User'),
			'value'=>'$data->user->name',
		),  
	),
)); ?>

 

