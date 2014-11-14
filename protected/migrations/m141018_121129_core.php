<?php

class m141018_121129_core extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_user', array(
				'id' => 'pk',
				'name' => 'string NOT NULL',
				'login' => 'string NOT NULL',
				'password' => 'string NOT NULL',
				'is_admin'=>'boolean',	
            ));
                  
            $this->createIndex('tbl_user_login', 'tbl_user', 'login', true);
            $this->insert('tbl_user', array(
                'name'=>'Admin',
                'login'=>'admin',
                'password'=>User::passwordHash('admin'),
				'is_admin'=>'1',
            ));   

            $this->createTable('tbl_project', array(
					'id' => 'pk',
					'user_id' => 'int',
					'name' => 'string NOT NULL',
                    'description'=>'text'
            ));

            $this->createIndex('tbl_project_user_id', 'tbl_project', 'user_id'); 
           
            
            $this->createTable('tbl_task', array(
					'id' => 'pk',
					'project_id' => 'int',
                    'task_category_id'=>'int', 
                    'priority'=>'int',
					'user_id'=>'int',
                    'color_hex'=>'int',
                    'is_ready'=>'bool',
                    'description'=>'text',
                    'fulldescription'=>'text', 
            ));
            $this->createIndex('tbl_task_project_id', 'tbl_task', 'project_id'); 
            $this->createIndex('tbl_task_task_category_id', 'tbl_task', 'task_category_id'); 
			$this->createIndex('tbl_task_user_id', 'tbl_task', 'user_id'); 
            
            $this->createTable('tbl_task_category', array(
					'id' => 'pk',
					'project_id' => 'int',
                    'order_pos'=>'int',
                    'limit_task'=>'int NOT NULL', 
                    'name'=>'string NOT NULL',                     
            ));
            $this->createIndex('tbl_task_category_project_id', 'tbl_task_category', 'project_id'); 
            
            $this->createTable('tbl_task_history', array( 
                    'id'=>'pk',
                    'task_id'=>'int', 
                    'new_category_id'=>'int',
                    'user_id'=>'int',
                    'time_insert'=>'int',
            ));
            
            $this->createIndex('tbl_task_history_task_id', 'tbl_task_history', 'task_id');             
            $this->createIndex('tbl_task_history_new_category_id', 'tbl_task_history', 'new_category_id'); 
            $this->createIndex('tbl_task_history_user_id', 'tbl_task_history', 'user_id'); 
			
			
			$this->createTable('tbl_user_project', array(
				'id' => 'pk',
				'user_id' => 'int NOT NULL',
				'project_id' => 'int NOT NULL', 	
            ));
            $this->createIndex('tbl_user_project_user_id', 'tbl_user_project', 'user_id');
            $this->createIndex('tbl_user_project_project_id', 'tbl_user_project', 'project_id');
			
			
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
			
			$this->createTable('tbl_task_comment_user', array(
                'id'=>'pk',
                'user_id'=>'int',
                'task_id'=>'int',
            ));
            $this->createIndex('tbl_task_comment_user_user_id', 'tbl_task_comment_user', 'user_id');
            $this->createIndex('tbl_task_comment_user_task_id', 'tbl_task_comment_user', 'task_id');
			
			//FK
            
            if($this->getDbConnection()->driverName  === 'mysql') {
                $this->addForeignKey('FK_tbl_project_user_id', 
                                        'tbl_project', 
                                        'user_id', 
                                        'tbl_user', 
                                        'id', 'NO ACTION', 'NO ACTION');
                $this->addForeignKey('FK_tbl_task_project_id', 
                                        'tbl_task', 
                                        'project_id', 
                                        'tbl_project', 
                                        'id', 'CASCADE', 'NO ACTION');
                $this->addForeignKey('FK_tbl_task_task_category_id', 
                                        'tbl_task', 
                                        'task_category_id', 
                                        'tbl_task_category', 
                                        'id', 'CASCADE', 'NO ACTION'); 
                $this->addForeignKey('FK_tbl_task_category_project_id', 
                                        'tbl_task_category', 
                                        'project_id', 
                                        'tbl_project', 
                                        'id', 'CASCADE', 'NO ACTION');
                $this->addForeignKey('FK_tbl_task_history_task_id', 
                                        'tbl_task_history', 
                                        'task_id', 
                                        'tbl_task', 
                                        'id', 'CASCADE', 'NO ACTION'); 
                $this->addForeignKey('FK_tbl_task_history_new_category_id', 
                                        'tbl_task_history', 
                                        'new_category_id', 
                                        'tbl_task_category', 
                                        'id', 'CASCADE', 'NO ACTION');
                $this->addForeignKey('FK_tbl_task_history_user_id', 
                                        'tbl_task_history', 
                                        'user_id', 
                                        'tbl_user', 
                                        'id', 'CASCADE', 'NO ACTION');
				$this->addForeignKey('FK_tbl_user_project_user_id', 
                                        'tbl_user_project', 
                                        'user_id', 
                                        'tbl_user', 
                                        'id', 'CASCADE', 'NO ACTION');
                $this->addForeignKey('FK_tbl_user_project_project_id', 
                                        'tbl_user_project', 
                                        'project_id', 
                                        'tbl_project', 
                                        'id', 'CASCADE', 'NO ACTION');
				$this->addForeignKey('FK_tbl_task_comment_user_user_id', 
                                        'tbl_task_comment_user', 
                                        'user_id', 
                                        'tbl_user', 
                                        'id', 'CASCADE', 'NO ACTION');
                $this->addForeignKey('FK_tbl_task_comment_user_task_id', 
                                        'tbl_task_comment_user', 
                                        'task_id', 
                                        'tbl_task', 
                                        'id', 'CASCADE', 'NO ACTION');
                
            }
	}

	public function down()
	{
		echo "m141018_121129_core does not support migration down.\n";
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