<?php

class m141113_203126_task_comment extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_task_comment_user', array(
                'id'=>'pk',
                'user_id'=>'int',
                'task_id'=>'int',
            ));
            $this->createIndex('tbl_task_comment_user_user_id', 'tbl_task_comment_user', 'user_id');
            $this->createIndex('tbl_task_comment_user_task_id', 'tbl_task_comment_user', 'task_id');
            
            if($this->getDbConnection()->driverName  === 'mysql') {
                $this->addForeignKey('FK_tbl_task_comment_user_user_id', 
                                        'tbl_task_comment_user', 
                                        'user_id', 
                                        'tbl_user', 
                                        'id', 'NO ACTION', 'NO ACTION');
                $this->addForeignKey('FK_tbl_task_comment_user_task_id', 
                                        'tbl_task_comment_user', 
                                        'task_id', 
                                        'tbl_task', 
                                        'id', 'NO ACTION', 'NO ACTION');
            }    
	}

	public function down()
	{
		echo "m141113_203126_task_comment does not support migration down.\n";
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