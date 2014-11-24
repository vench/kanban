<?php

class m141121_121152_task_a_user extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_task', 'parent_id', 'int default NULL');
		$this->addColumn('tbl_user', 'email', 'string');
		$this->createIndex('tbl_user_email', 'tbl_user', 'email', true);
		$this->createIndex('tbl_task_parent_id', 'tbl_task', 'parent_id');
		
		if($this->getDbConnection()->driverName  !== 'sqlite') {
			$this->addForeignKey('FK_tbl_task_parent_id', 
                                        'tbl_task', 
                                        'parent_id', 
                                        'tbl_task', 
                                        'id', 'SET NULL', 'NO ACTION');
		}
	}

	public function down()
	{
		echo "m141121_121152_task_a_user does not support migration down.\n";
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