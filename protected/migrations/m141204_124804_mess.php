<?php

class m141204_124804_mess extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('tbl_task_comment', 'comment', 'varchar(1024) NOT NULL');
	}

	public function down()
	{
		echo "m141204_124804_mess does not support migration down.\n";
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