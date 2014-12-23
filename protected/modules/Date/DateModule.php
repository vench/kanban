<?php

class DateModule extends KModule
{
	public function getHumanName() {
		return __CLASS__;
	}
	
	public function handlerEvent($constEvent, $dataContext = NULL) {
		if($constEvent == self::AFTER_PROJECT_MENU_MAIN) {
			$dataContext['controller']->menu[] = 	array(
					'label'=>'Test', 
					'url'=>array('Test', 'id'=>1), 
				); 
		}
		
		if($constEvent == self::BEFORE_PROJECT_CONTENT) {
			$dataContext['controller']->tabs['zii'] = array(
				'title'=>'Test x',
				'content'=>'xxx',
				//'url'=>'http://ya.ru', 
			);
		}
	}
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'date.models.*',
			'date.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
