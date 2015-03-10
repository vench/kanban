<?php

class TaskCommentController extends Controller
{
        public $layout='//layouts/column2';
        
        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations 
		);
	}
        
        /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array( 			 
			array('allow',
				'actions'=>array('delete', 'update', 'createTask'),
				'users'=>array('@'),				
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	public function actionIndex()
	{
		$this->render('index');
	}

	 
        /**
         * 
         * @param type $id ID TaskComment
         */
        public function actionUpdate($id) {
            $model = $this->loadModel($id);
            $this->testAccess($model);
            
            if(isset($_POST['TaskComment'])) {
			$model->attributes=$_POST['TaskComment'];
			if($model->save(true, array('comment')))
				$this->redirect(array('/task/view','id'=>$model->task_id));
		}
            
            $this->render('update', array(
                'model'=>$model,
            ));
        }
        
        	 
        /**
         * 
         * @param type $id ID TaskComment
         */
        public function actionDelete($id) {
            $model = $this->loadModel($id);
            $this->testAccess($model);             
            $model->delete();
            $this->redirect(array('/task/view', 'id'=>$model->task_id));
        }
		
		 /**
         * 
         * @param type $id ID TaskComment
         */
		public function actionCreateTask($id) {
			 $model = $this->loadModel($id);
			 
			 if(!ProjectHelper::accessUserInProject($model->task->project_id)) {
				throw new CHttpException(404,'The requested page does not exist.');
			 }
			 $task = new Task();
			 $task->project_id = $model->task->project_id;
			 $task->user_id = Yii::app()->user->getId();
			 $task->task_category_id = NULL;
			 $task->parent_id = $model->task_id;
			 $task->description = $model->comment;
			 $task->color_hex = $model->color_hex;
			 $task->save(); 
			 
			 $this->redirect(array('/task/update', 'id'=>$task->getPrimaryKey()));
		}
        
        /**
         * 
         * @param TaskComment $model
         * @throws CHttpException
         */
        public function testAccess(TaskComment $model) {
            if($model->user_id != Yii::app()->user->getID()  && !ProjectHelper::currentUserCreater($model->task->project)) {
			throw new CHttpException(404,'The requested page does not exist.');
            }
        }
		
		
		

         /**
         * 
         * @param int $id
         * @return TaskComment
         * @throws CHttpException
         */
        public function loadModel($id) {
			$model=  TaskComment::model()->findByPk($id);
			if($model===null)
				throw new CHttpException(404,'The requested page does not exist.');
			return $model;
		}
}