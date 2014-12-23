<?php 

/**
* Class KModule base module for Project
*/
abstract class KModule extends CWebModule {
	
	/**
	* Before project menu main.
	* In the context provided:
	* array(
	*  $menu array  menu
	*  $controller ProjectController
	* ),
	*/
	const BEFORE_PROJECT_MENU_MAIN = 1; 
	
	/**
	* After project menu main.
	* In the context provided:
	* array(
	*  $menu array  menu
	*  $controller ProjectController
	* ),
	*/
	const AFTER_PROJECT_MENU_MAIN = 2; 
	
	/**
	* Before project sidebar.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const BEFORE_PROJECT_SIDEBAR = 3;
	
	/**
	* After project sidebar.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const AFTER_PROJECT_SIDEBAR = 4;
	
	/**
	* Before project content.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const BEFORE_PROJECT_CONTENT = 5;
	
	/**
	* After project content.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const AFTER_PROJECT_CONTENT = 6;
	
	
	
	 
	/**
	* Get human name modul
	* @return string
	*/ 
	abstract public function getHumanName();
	
	/**
	* The event handler in the project. Allows access to the display elements.
	* @param string $constEvent Name initiator events
	* @param mixed $dataContext
	*/
	abstract public function handlerEvent($constEvent, $dataContext = NULL);
	
	/**
	* List of modules used.
	*	@return array
	*/
	public static function getListModules() {
		$list = array();
		foreach(Yii::app()->modules as $name=>$data) { 
			$modul = (Yii::app()->getModule($name));
			if($modul instanceof KModule) {
				$list[$name] = $modul->humanName;
			}
		} 
		return $list;
	}
	
	/**
	* @param Project $model
	* @param string $constEvent Name initiator events
	* @param mixed $dataContext
	*/
	public static function fireEvents(Project $model, $constEvent, $dataContext = NULL) {
		if(!is_array($dataContext)){
			$dataContext = array();
		}
		if(!isset($dataContext['project'])) {
			$dataContext['project'] = $model;
		}
		foreach($model->modules as $modul){
			$module = (Yii::app()->getModule($modul->modul_name));
			$module->handlerEvent($constEvent, $dataContext);
		}
	}
}