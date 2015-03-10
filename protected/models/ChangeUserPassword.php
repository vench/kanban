<?php

 

/**
 * Description of ChangeUserPassword
 *
 * @author vench
 */
class ChangeUserPassword extends CFormModel {
    
    public $password;
    
    public $password1;

    /**
     * 
     * @return type
     */
    public function rules() {
	return array(
            array('password, password1', 'required'),
            array('password', 'length', 'min'=>4),
            array('password', 'compare', 'compareAttribute'=> 'password1'),
        );
    }
    
    	public function attributeLabels()
	{
		return array(
			'password'=>Yii::t('main', 'Password'),
                        'password1'=>Yii::t('main', 'Confirm password'),
		);
	}
}
