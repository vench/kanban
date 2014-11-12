<?php
/* @var $this ProjectController */
/* @var $model Project */


$this->breadcrumbs=array(
	Yii::t('main','Projects')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Project', 'url'=>array('index')),
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Update Project', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Project', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('main', 'View Project');?> #<?php echo $model->name; ?></h1>
 
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		 
		array('name'=>'user_id', 'value'=>$model->user->name),		 
		array('name'=>'description',),
		array(
		'name'=>Yii::t('main', 'Actions'), 
		'type'=>'raw',
		'value'=>CHtml::link(Yii::t('main', 'Update Project'), array('update', 'id'=>$model->getPrimaryKey())) .' | '.
			     CHtml::link(Yii::t('main', 'Add category task'), array('/taskCategory/create', 'projectId'=>$model->getPrimaryKey())) .' | '.
				 CHtml::link(Yii::t('main', 'Completed tasks', array('/task/completed', 'id'=>$model->getPrimaryKey()))),
		),
	),
)); ?>

 


<table class="task-table">
    <thead>
    <tr>
<?php 
$size = (int)(100 / sizeof($model->taskCategories));
foreach($model->taskCategories as $taskCategory) { ?>     
    <th style="width:<?php echo $size?>%;">
       <h4> <?php echo $taskCategory->name;?> </h4>
    <?php echo CHtml::link(Yii::t('main', 'Add task'), array(
        '/task/create', 
        'categoryId'=>$taskCategory->getPrimaryKey()
        ), array(
    
));?>
     <?php echo Chtml::link(Yii::t('main', 'Edit caegory'), array(
         '/taskCategory/update', 'id'=>$taskCategory->getPrimaryKey(),
     ), array(
         
     )); ?> 
       <?php echo Chtml::link(Yii::t('main', 'Remove caegory'), array(
         '/taskCategory/delete', 'id'=>$taskCategory->getPrimaryKey(),
     ), array(
         
     )); ?> 
        
        <?php if($taskCategory->limit_task > 0)  {?> 
        <p><?php echo Yii::t('main', 'Limit task {num}', array(
            '{num}'=>$taskCategory->limit_task,
        ));?></p>    
        <?php }?>
    
    </th>
<?php }?>
    </tr>
    </thead>
    <tbody>
           <tr>
<?php foreach($model->taskCategories as $taskCategory) { ?>     
               <td class="droppable" data-pk="<?php echo $taskCategory->getPrimaryKey(); ?>">
        <?php if(sizeof($taskCategory->tasks) > 0) { 
            
            foreach($taskCategory->tasks as $task) {                 
              $this->renderPartial('_view_task', array(
                    'model'=>$task,
                ));
            }          
        }?> 
    </td>
<?php }?>
    </tr> 
    </tbody>
</table>


<?php 
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->getClientScript()->registerCssFile(
    Yii::app()->clientScript->getCoreScriptUrl().
    '/jui/css/base/jquery-ui.css'
);
?>        

<script type="text/javascript">
$(function(){    
    var  
    fnUpdateOrder = function() {
        var list = $(this).find('>div.task-box.drag'),
            stack = {};
        list.each(function(index, item){
            stack[list.length - index] = $(item).data('pk');
        });               
        $.post('<?php echo $this->createUrl('/task/ajaxUpdateOrder')?>', {tasks:stack}, function(data){});
    };    
    
    $('td.droppable').sortable({
       revert: true,
       connectWith: "td", 
        update:function(event, ui) {   
            if( ui.sender === null) {
                fnUpdateOrder.apply(ui.item.parent(), [ui.item]);
            } else {
                $.post('<?php echo $this->createUrl('/task/ajaxUpdate')?>', 
                 {id:ui.item.data('pk'), 'Task[task_category_id]': $(this).data('pk')}, function(data){
                if(!data.success){  
                    ui.sender.append( ui.item);
                } else {
                    fnUpdateOrder.apply(ui.item.parent(), [ui.item]);
                }
            }, 'json');
            }     
        },
        stop: function(event, ui) { }       
    });
});</script>
<?php 
