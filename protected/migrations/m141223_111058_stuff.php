<?php

class m141223_111058_stuff extends CDbMigration
{
	public function up() { //return;
	    $this->createTable('tbl_project_modul', array(
				'id' => 'pk',
				'modul_name' => 'string NOT NULL',
				'project_id' => 'int', 	
            ));
                  
            $this->createIndex('tbl_project_modul_modul_name', 'tbl_project_modul', 'modul_name');
	    $this->createIndex('tbl_project_modul_project_id', 'tbl_project_modul', 'project_id');
			
	    $this->addColumn('tbl_task_file', 'project_id', 'int');
	    $this->createIndex('tbl_task_file_project_id', 'tbl_task_file', 'project_id');
			
	    if($this->getDbConnection()->driverName  !== 'sqlite') {
                $this->addForeignKey('FK_tbl_project_modul_project_id', 
                                        'tbl_project_modul', 
                                        'project_id', 
                                        'tbl_project', 
                                        'id', 'CASCADE', 'NO ACTION'); 
										
		$this->addForeignKey('FK_tbl_task_file_project_id', 
                                        'tbl_task_file', 
                                        'project_id', 
                                        'tbl_project', 
                                        'id', 'CASCADE', 'NO ACTION');
	     }							
			
	}

	public function down()
	{
		echo "m141223_111058_stuff does not support migration down.\n";
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