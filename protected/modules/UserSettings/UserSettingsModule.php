<?php

class UserSettingsModule extends GModule
{
        /**
         *  Allow edit password
         * @var booleal 
         */
        public $changePassword = true;
        
        /**
         *
         * @var CHandlerEvent 
         */
        protected $handler;
    
	public function init() {                 
		$this->setImport(array(
			'userSettings.models.*',
			'userSettings.components.*',
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
        
        /**
         * 
         * @param type $constEvent
         * @param type $dataContext
         */
       public function handlerEvent($constEvent, $dataContext = NULL) {             
            $this->getHandlerEvent()->handlerEvent($constEvent, $dataContext);
        }
        

        
        /**
         * 
         * @return CHandlerEvent
         */
       public function getHandlerEvent() {
           if(is_null($this->handler)) {
               $this->handler = new CHandlerEvent(); 
           }
           return $this->handler;
       }
        
                
}
