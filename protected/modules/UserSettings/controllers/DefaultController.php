<?php

class DefaultController extends Controller
{
    
        /**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', 
		);
	}
        
        /**
	 * @return array access control rules
	 */
	public function accessRules() {
		return array( 
			array('allow',  
				'actions'=>array('index', 'changePassword', 'notifications'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        /**
         * 
         */
	public function actionIndex() {
            $model = $this->getUser();
            if(isset($_POST['User'])) {
                $fields = array('name', 'email');
                foreach($fields as $field) {
                    if(isset($_POST['User'][$field]))
                        $model->setAttribute($field, $_POST['User'][$field]);
                }
                if($model->save(true, $fields)) {
                    Yii::app()->user->setFlash('UserInfoChange', Yii::t('UserSettingsModule.main','Update successfully done.'));
                    $this->refresh();
                }
            }
            $this->render('index', array(
                'model'=>$model,
            ));
	}
        
        /**
         * 
         */
        public function actionChangePassword() {
            if(!$this->module->changePassword) {
                throw new CHttpException(404, 'Access error');
            }
            $model = $this->getUser();
            $changeUserPassword = new ChangeUserPassword();
            if(isset($_POST['ChangeUserPassword'])) {
                $changeUserPassword->attributes = $_POST['ChangeUserPassword'];
                if ($changeUserPassword->validate()) {
                            $model->password = User::passwordHash($changeUserPassword->password);
                            $model->save();
                            Yii::app()->user->setFlash('UserInfoChange', Yii::t('UserSettingsModule.main','Password changed.'));				
                            $this->refresh();
                }
            }
        
            $this->render('changePassword', array(
                'changeUserPassword'=>$changeUserPassword,
                'model'=>$model,
            )); 
        }
        
        /**
         * 
         */
        public function actionNotifications() {
            $model = $this->getUser();
            $notification = new Notification('search');
            $notification->uto = $model->id;
            $this->render('notifications', array(
                'notification'=>$notification,
                'model'=>$model,
            )); 
            
            Notification::model()->updateAll(array('is_new'=>0), 'uto=:uto AND is_new = 1', array(
                ':uto'=>$model->id,
            ));
        }
        
        /**
         * 
         * @return User
         * @throws CHttpException
         */
        public function getUser() {  
            $model = User::model()->findByPk(Yii::app()->user->getId());
            if(is_null($model)) {
                throw new CHttpException(404, 'User not found');
            }
            return $model;
        }
        
        /**
         * 
         * @param User $model
         * @return int
         */
        public function getCountNewNotification(User $model) {
            return Notification::model()->count('uto=:uto AND is_new = 1', array(
                ':uto'=>$model->id,
            ));
        }
        
}