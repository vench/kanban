<?php

 

/**
 * Description of ProjectHelper
 *
 * @author vench
 */
class ProjectHelper {
    
    /**
     * 
     * @param type $projectID
     * @return boolean
     */
    public function accessUserInProject($projectID) {
        if(self::accessCreaterProject($projectID)) {
            return true;
        }
        if(UserProject::model()->find('project_id=:project_id AND user_id=:user_id', array(
            ':project_id'=>$projectID,
            ':user_id'=>Yii::app()->user->getId(),
        ))) {
            return true;
        }
        return FALSE;
    }

    /**
     * 
     * @param Project $project
     * @return boolean
     */
    public static function  currentUserCreater(Project $project) {
        return Yii::app()->user->getId() == $project->user_id;
    }

    /**
     * Пользователь создатель проекта 
     * @param int $projectID
     * @return boolean
     */
    public static function accessCreaterProject($projectID) {
        if(self::currentUserIsAdmin()) {
            return true;
        }
         
        if(!is_null(Project::model()->find(array(
            'condition'=>'id=:id AND user_id=:user_id',
            'params'=>array(
                ':id'=>$projectID,
                ':user_id'=>Yii::app()->user->getId(),
             ),
             'select'=>'id',
            )))) {
           return true; 
        }
        return false;
    } 
    
    /**
     * 
     * @return boolean
     */
    public static function currentUserIsAdmin() {
        if(Yii::app()->user->isGuest) {
            return false;
        }
        $model = User::model()->find(array(
                'condition'=>'id=:id',
                'params'=>array(
                    ':id'=>Yii::app()->user->getId(),
                ),
                'select'=>'is_admin',
        ));
        return !is_null($model) && $model->is_admin == 1;
    }
    
	 /**
     * 
     * @param Task $model
     * @return boolean
     */
	public static function ownerTask(Task $model) {
		return Yii::app()->user->getId() == $model->user_id;
	}
    
}
