<?php
/* @var $this ProjectController */
/* @var $model Project */
/* #var $userProject UserProject */

$this->breadcrumbs=array(
	Yii::t('main','Projects')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('main', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('main','List Project'), 'url'=>array('index')),
	array('label'=>Yii::t('main','Create Project'), 'url'=>array('create')),
	array('label'=>Yii::t('main','View Project'), 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>Yii::t('main','Manage Project'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('main', 'Update Project');?> <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>


<h3><?php echo Yii::t('main', 'Invited users');?></h3>

<?php   
$users = Chtml::listData(User::model()->findAll(array(
    'select'=>'id,name',
    'condition'=>'id <> :uid1 AND id NOT IN (SELECT user_id FROM {{user_project}} WHERE project_id=:pid1)',
    'params'=>array(
        ':pid1'=>$model->getPrimaryKey(),
        ':uid1'=>$model->user_id,
    ),
)), 'id', 'name');
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-project-form', 
	'enableAjaxValidation'=>false,
)); ?>
    
    <div class="row">
		<?php echo $form->labelEx($userProject,'user_id'); ?>
		<?php echo $form->dropDownList($userProject,'user_id', $users); ?>
		<?php echo $form->error($userProject,'user_id'); ?>
	</div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton( Yii::t('main','Invite')); ?>
	</div>

<?php $this->endWidget(); ?>

<ul>
<?php foreach($model->users as $user) { ?>
    <li><?php echo $user->name;?> 
        <?php echo CHtml::link(Yii::t('main', 'Clean'), array(
                'userProjectRmove', 'uid'=>$user->getPrimaryKey(), 'pid'=>$model->getPrimaryKey() ), array(
                 'onclick'=>'return confirm("'.Yii::t('main', 'Confirm the deletion').'");',
                ));?></li>
<?php } ?>
</ul>


<?php if(sizeof($dataList = KModule::getListModules()) > 0) {  ?>
<h3><?php echo Yii::t('main', 'Modules project');?></h3>
<?php  echo CHtml::dropDownList('x',null, $dataList, array(
	'size'=>'10',
	'multiple'=>'multiple',
));  
 }   
