<?php

class StatisticCategoty extends CWidget {

	public $data = array();
	
	/**
	* @var Project
	*/
	public $project;

	public function run() {
	$category = $this->data ;
	?><ul>
	<?php foreach($category as $id=>$data){ 
	$categotyTask = $this->project->getCategoryById($id);
	
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
</ul><?php
	}
}