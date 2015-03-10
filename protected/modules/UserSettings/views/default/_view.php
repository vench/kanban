<?php 
/* @var $data Notification */
?>

<div class="view">

	<p><?php echo ($data->message); ?>:</p> 
  
        <small><?php echo date('d.m.Y H:i',$data->timecreate); ?><?php if($data->is_new == 1):?> <?php echo Yii::t('UserSettingsModule.main','New notification'); ?> <?php endif;?></small>
</div> <br/>