<?php 

abstract class KModule extends CWebModule {
	
	 
	/**
	*	@return string
	*/ 
	abstract public function getHumanName();
	
	
	/**
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
}