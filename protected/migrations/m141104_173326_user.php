<?php

class m141104_173326_user extends CDbMigration
{
	public function up()
	{
            $this->addColumn('tbl_user', 'is_admin', 'boolean');
	}

	public function down()
	{
		echo "m141104_173326_user does not support migration down.\n";
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