<?php

class m150310_111542_notifications extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_notification', array(
                'id'=>'pk',
                'uto'=>'int',
                'ufrom'=>'int',
                'timecreate'=>'int',
                'is_new'=>'boolean',
                'message'=>'text',
            ));
            
            $this->createIndex('Notification_uto', 'tbl_notification', 'uto', false);
            $this->createIndex('Notification_ufrom', 'tbl_notification', 'ufrom', false);
            if($this->getDbConnection()->driverName  !== 'sqlite') {
                $this->addForeignKey('FK_Notification_uto', 'tbl_notification', 'uto', 'tbl_user', 'id');
                $this->addForeignKey('FK_Notification_ufrom', 'tbl_notification', 'ufrom', 'tbl_user', 'id');
            }
	}

	public function down()
	{
		echo "m150310_111542_notifications does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}