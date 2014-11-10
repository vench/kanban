<?php

class m141109_161857_user extends CDbMigration
{
	public function up()
	{
            $this->createTable('tbl_user_project', array(
		    'id' => 'pk',
		    'user_id' => 'int NOT NULL',
		    'project_id' => 'int NOT NULL', 	
            ));
            $this->createIndex('tbl_user_project_user_id', 'tbl_user_project', 'user_id', true);
            $this->createIndex('tbl_user_project_project_id', 'tbl_user_project', 'project_id', true);
	
            if($this->getDbConnection()->driverName  === 'mysql') {
                $this->addForeignKey('FK_tbl_user_project_user_id', 
                                        'tbl_user_project', 
                                        'user_id', 
                                        'tbl_user', 
                                        'id', 'NO ACTION', 'NO ACTION');
                $this->addForeignKey('FK_tbl_user_project_project_id', 
                                        'tbl_user_project', 
                                        'project_id', 
                                        'tbl_project', 
                                        'id', 'NO ACTION', 'NO ACTION');
            }    
        }

	public function down()
	{
		echo "m141109_161857_user does not support migration down.\n";
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