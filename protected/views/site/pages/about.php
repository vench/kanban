<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('main','About');
$this->breadcrumbs=array(
	Yii::t('main','About'),
);
?>
<h1><?php echo Yii::t('main','About');?></h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
