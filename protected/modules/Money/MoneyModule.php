<?php




class MoneyModule extends KModule
{
        public  $defaultController = 'DefaultController';

	public function getHumanName() {
		return Yii::t('MoneyModule.main', 'Module name');
	}
	
	public function handlerEvent($constEvent, $dataContext = NULL) {
		MoneyModuleHandler::handler($constEvent, $dataContext);
	}

	public function init() { 
		$this->setImport(array(
			'money.models.*',
			'money.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) { 
			return true;
		}
	 
		return false;
	}
        
        public function install() {
            $db = Yii::app()->db;
            
            try {
                $db->createCommand()->select()->from('{{money}}')->select('id')->query(); 
            } catch(Exception $e) {
                $db->createCommand()->createTable('{{money}}',array(
                            'id'=>'pk',
                            'task_id'=>'integer',
                            'money'=>'integer',
                            'status'=>'boolean',
                            'date_time'=>'integer',
                            'comment'=>'string',
                ));
                $db->createCommand()->createIndex('money_task_id', '{{money}}', 'task_id');
                if($db->driverName  !== 'sqlite') {
                    $db->createCommand()->addForeignKey('FK_money_task_id', 
                                        '{{money}}', 
                                        'task_id', 
                                        '{{task}}', 
                                        'id', 'CASCADE', 'NO ACTION');
                }
           }
        }
}
