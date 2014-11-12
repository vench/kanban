<?php

class m141112_072427_filecomments extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_task_file', array(
		    'id' => 'pk',
		    'task_id' => 'int',
		    'patch' => 'string NOT NULL', 
        ));
		$this->createIndex('tbl_task_file_task_id', 'tbl_task_file', 'task_id'); 
		
		$this->createTable('tbl_task_comment', array(
		    'id' => 'pk',
		    'task_id' => 'int',
			'user_id'=>'int',
			'time_insert'=>'int',
		    'comment' => 'string NOT NULL', 
        ));
		$this->createIndex('tbl_task_comment_task_id', 'tbl_task_comment', 'task_id'); 
		$this->createIndex('tbl_task_comment_user_id', 'tbl_task_comment', 'user_id'); 
		
		if($this->getDbConnection()->driverName  === 'mysql') {
			$this->addForeignKey('FK_tbl_task_file_task_id', 
                                        'tbl_task_file', 
                                        'task_id', 
                                        'tbl_task', 
                                        'id', 'NO ACTION', 'NO ACTION');
										
			$this->addForeignKey('FK_tbl_task_comment_task_id', 
                                        'tbl_task_comment', 
                                        'task_id', 
                                        'tbl_task', 
                                        'id', 'NO ACTION', 'NO ACTION');
			$this->addForeignKey('FK_tbl_task_comment_user_id', 
                                        'tbl_task_comment', 
                                        'user_id', 
                                        'tbl_user', 
                                        'id', 'NO ACTION', 'NO ACTION');
		}
	}

	public function down()
	{
		echo "m141112_072427_filecomments does not support migration down.\n";
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