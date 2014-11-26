<?php

class m141126_201619_file_name extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_task_file', 'filename', 'string default NULL');
		$this->addColumn('tbl_task_file', 'time_insert', 'int');
	}

	public function down()
	{
		echo "m141126_201619_file_name does not support migration down.\n";
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
