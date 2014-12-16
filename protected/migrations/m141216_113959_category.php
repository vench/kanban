<?php

class m141216_113959_category extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_task_category', 'view_in_table', 'boolean'); 
	}

	public function down()
	{
		echo "m141216_113959_category does not support migration down.\n";
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