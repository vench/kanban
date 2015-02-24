<?php

 
/**
 * Class GModule base module for application
 *
 * @author vench
 */
abstract class GModule   extends CWebModule {
    	
	/**
	* Before  menu main.
	* In the context provided:
	* array(
	*  $menu array  menu
	*  $controller CController
	* ),
	*/
	const BEFORE_RENDER_MAIN_MENU = 1; 
        
        /**
	* Before  render main content.
	* In the context provided:
	* array( 
	*  $controller CController
	* ),
	*/
        const BEFORE_RENDER_MAIN_CONTENT = 2;
        
        /**
	* After  render main content.
	* In the context provided:
	* array( 
	*  $controller CController
	* ),
	*/
        const AFTER_RENDER_MAIN_CONTENT = 3;
        
        /**
	* Before render footer.
	* In the context provided:
	* array( 
	*  $controller CController
	* ),
	*/
        const BEFORE_RENDER_FOOTER = 4;
        
     	/**
	* The event handler in the project. Allows access to the display elements.
	* @param string $constEvent Name initiator events
	* @param mixed $dataContext
	*/
	abstract public function handlerEvent($constEvent, $dataContext = NULL);
        
  
        
        /** 
	* @param string $constEvent Name initiator events
	* @param mixed $dataContext
	*/
	public static function fireEvents($constEvent, $dataContext = NULL) {
		if(!is_array($dataContext)){
			$dataContext = array();
		} 
                
                $modules = Yii::app()->getModules();
               
		foreach($modules as $name=>$data){ 
                        if($data == 'gii') {
                            continue;
                        }
			$module = (Yii::app()->getModule($name));
			if($module instanceof GModule) {
                            $module->handlerEvent($constEvent, $dataContext);
                        }
		} 
	}
}
