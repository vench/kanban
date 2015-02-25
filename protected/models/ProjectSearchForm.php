<?php

 

/**
 * Description of ProjectSearchForm
 *
 * @author vench
 */
class ProjectSearchForm extends CFormModel {
     public $name;
     public $user_id;
     
     
     	/**
	 * Declares the validation rules.
	 */
    public function rules() {
		return array( 
			array('name, user_id', 'safe'), 
                        array('user_id', 'numerical', 'integerOnly'=>true),
		);
    }
    
    	/**
	 * @return array customized attribute labels (name=>label)
	 */
    public function attributeLabels()  {
		return array(
			'id' => Yii::t('main', 'Project ID'),
			'user_id' => Yii::t('main','Project user'),
			'name' => Yii::t('main','Project name'),
			'description' => Yii::t('main','Project description'),
		);
    }
    
    /**
     * 
     * @return \CActiveDataProvider
     */
    public function search() {
        $criteria=new CDbCriteria();
        if(!ProjectHelper::currentUserIsAdmin()) {
                    $criteria->condition = '(t.user_id=:user_id OR t.id IN (select project_id FROM tbl_user_project WHERE user_id=:user_id1))'; 
                    $criteria->params = array(
                            ':user_id'=>Yii::app()->user->getId(),
                            ':user_id1'=>Yii::app()->user->getId(),
                    );
        }	
        $criteria->compare('user_id', $this->user_id);
	$criteria->compare('name',$this->name,true);
	$dataProvider=new CActiveDataProvider('Project', array(
			'criteria'=>$criteria,
	));
        return $dataProvider;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isEmpty() {
        return $this->user_id <=0 && $this->name == '';
    }
            
}
