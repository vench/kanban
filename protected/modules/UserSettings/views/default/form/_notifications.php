<?php

/* @var $model User */
/* @var $notification Notification */
?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$notification->search(),
	'itemView'=>'_view',
)); 