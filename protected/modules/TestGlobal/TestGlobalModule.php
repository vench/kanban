<?php

class TestGlobalModule extends GModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
            
            
            
            

		// import the module-level models and components
		$this->setImport(array(
			//'TestGlobal.models.*',
			//'TestGlobal.components.*',
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
        
        public function handlerEvent($constEvent, $dataContext = NULL) { 
            switch($constEvent){
                case self::BEFORE_RENDER_MAIN_MENU: 
                    call_user_func_array(array($this, 'beforeRenderMainMenu'), $dataContext); 
                    break;
                case self::BEFORE_RENDER_MAIN_CONTENT:
                    call_user_func_array(array($this, 'beforeRenderMainContent'), $dataContext);
                    break;
                case self::AFTER_RENDER_MAIN_CONTENT:
                    call_user_func_array(array($this, 'afterRenderMainContent'), $dataContext);
                    break;
                case self::BEFORE_RENDER_FOOTER:
                    call_user_func_array(array($this, 'beforeRenderFooter'), $dataContext);
                    break;
            }
        }
        
        /**
         * 
         * @param type $menu
         * @param type $controller
         */
        protected function beforeRenderMainMenu($menu, $controller) {
            $menu[] = array('label'=>Yii::t('main','Home'), 'url'=>array('/site/index'));                
        }
        
        protected function beforeRenderMainContent($controller) {
            echo "Some text before render content";
        }
        
        protected function  beforeRenderFooter ($controller) {
            $controller->widget('zii.widgets.CMenu',array(
			'items'=>array(
                            array('label'=>Yii::t('main','Home'), 'url'=>array('/site/index')),
                            array('label'=>Yii::t('main','Projects'), 'url'=>array('/project/index')),
                        ),
	    ));
        }
        
        protected function afterRenderMainContent($controller) {
            echo "Some text after render content";
        }
}
