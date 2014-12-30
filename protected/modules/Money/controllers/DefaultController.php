<?php

class DefaultController extends Controller
{
    
        public $layout='//layouts/column2';
        
	public function actionIndex()
	{
		$this->render('index');
	}
        
        /**
         * 
         * @param type $task_id Task ID
         * @throws CHttpException
         */
        public function actionAdd($task_id) {
            $task = Task::model()->findByPk($task_id);
            if(is_null($task)) {
                throw new CHttpException(404, "Task object not found");
            }
            if(!ProjectHelper::accessEditTask($task)) {
                throw new CHttpException(404, "Not access");
            }
            $money = new Money();
            $money->task_id = $task->getPrimaryKey();
            $this->updateModel($money);
            
            $this->render('add', array(
                'task'=>$task,
                'money'=>$money,
            ));            
        }
        
        /**
         * 
         * @param type $id Money ID
         */
        public function actionUpdate($id) {
            $model = $this->loadModel($id);
            $this->updateModel($model);
            $this->render('update', array(
                'model'=>$model, 
            ));
        }
        
        /**
         * 
         * @param type $id Money ID
         */
        public function actionDelete($id) {
            	$model = $this->loadModel($id);
                $model->delete(); 
		if(!isset($_GET['ajax'])) {
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/task/view', 'id'=>$model->task_id, '#'=>$model->getHash(),));
                }
        }
        
        /**
         * 
         * @param int $id
         * @return Money
         * @throws CHttpException
         */
        protected function loadModel($id) {
            $model = Money::model()->findByPk($id);
            if(is_null($model)) {
                throw new CHttpException(404, "Money object not found");
            }
            return $model;
        }
        
        /**
         * 
         * @param Money $model
         */
        protected function updateModel(Money $model) {
              if(isset($_POST['Money'])) {
                $model->attributes = $_POST['Money'];
                if($model->validate() && $model->save()) {
                    $this->redirect(array(
                        '/task/view',
                        'id'=>$model->task_id,
                        '#'=>$model->getHash(),
                    ));
                    Yii::app()->end();
                }
            }
        }
}