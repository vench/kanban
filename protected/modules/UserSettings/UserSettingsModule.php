<?php

class UserSettingsModule extends GModule
{
	public function init()
	{ 

		// import the module-level models and components
		/*$this->setImport(array(
			'UserSettings.models.*',
			'UserSettings.components.*',
		));*/
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
        
       public function handlerEvent($constEvent, $dataContext = NULL) { 
            switch($constEvent){
                case self::BEFORE_RENDER_MAIN_MENU: 
                    call_user_func_array(array($this, 'beforeRenderMainMenu'), $dataContext); 
                    break; 
            }
        }
        
       protected function beforeRenderMainMenu($menu, $controller) {
            if(!Yii::app()->user->isGuest) {
                $controller->mainMenu[] = array('label'=>Yii::t('UserSettingsModule.main','User settings'), 'url'=>array('/userSettings')); 
            }
       }
}
