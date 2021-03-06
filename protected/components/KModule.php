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
	const BEFORE_PROJECT_MENU_MAIN = 1001; 
	
	/**
	* After project menu main.
	* In the context provided:
	* array(
	*  $menu array  menu
	*  $controller ProjectController
	* ),
	*/
	const AFTER_PROJECT_MENU_MAIN = 1002; 
	
	/**
	* Before project sidebar.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const BEFORE_PROJECT_SIDEBAR = 1003;
	
	/**
	* After project sidebar.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const AFTER_PROJECT_SIDEBAR = 1004;
	
	/**
	* Before project content.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const BEFORE_PROJECT_CONTENT = 1005;
	
	/**
	* After project content.
	* In the context provided:
	* array( 
	*  $controller ProjectController
	* ),
	*/
	const AFTER_PROJECT_CONTENT = 1006;
	
        /**
         * Before project menu main.
         * In the context provided:
         * array( 
	 *  $controller ProjectController,
         *  $menu array,
         *  $task Task
	 * ),
         */
        const BEFORE_TASK_MENU_MAIN = 1007;
        
        /**
         * After project menu main.
         * In the context provided:
         * array( 
	 *  $controller ProjectController,
         *  $menu array,
         *  $task Task
	 * ),
         */
        const AFTER_TASK_MENU_MAIN = 1008;
        
         /**
         * Before task content view.
         * In the context provided:
         * array( 
	 *  $controller ProjectController, 
         *  $task Task
	 * ),
         */
	const BEFORE_TASK_CONTENT = 1009;
        
         /**
         * After task content view.
         * In the context provided:
         * array( 
	 *  $controller ProjectController, 
         *  $task Task
	 * ),
         */      
        const AFTER_TASK_CONTENT = 1010;
        
        /**
         * After send email from task.
         * In the context provided:
         * array( 
	 *  $users User[], 
         *  $task Task
	 * ),
         */
        const AFTER_TASK_SEND_EMAIL = 1011;
        
        /**
         * After add new comment to task.
         * In the context provided:
         * array( 
	 *  $taskComment TaskComment, 
         *  $task Task
         *  $user_id int PK User 
	 * ),
         */
        const AFTER_TASK_ADD_COMMENT = 1012;
	
	 
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
         * Caused during the installation of the module in the project
         */
        abstract public function install();
	
	/**
	* List of modules used.
	* @return array
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
			if(!is_null($module)) 
                            $module->handlerEvent($constEvent, $dataContext);
		}
               
                GModule::fireEvents($constEvent, $dataContext);
	}
}