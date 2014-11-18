<?php

class TaskController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
    *
    * @return array 
    */
    public function behaviors() {
		return array_merge(array(
			'fileUploadCControllerBehavior'=>array(
				'class'=>'FileUploadCControllerBehavior',
			),
		), parent::behaviors());
    }
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'view','update', 'delete', 'ajaxUpdateOrder', 'ajaxUpdate', 'completed', 'uploadFile', 'WithoutCategory',),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		
		$taskComment = new TaskComment();
		$taskComment->task_id = $model->getPrimaryKey();
		if(isset($_POST['TaskComment'])) {
			$taskComment->attributes=$_POST['TaskComment'];
			if($taskComment->save()) {
				$this->refresh();
            }
		}
		
		TaskCommentUser::model()->deleteAll('task_id=:task_id AND user_id=:user_id', array(
			':task_id'=>$model->getPrimaryKey(),
			':user_id'=>Yii::app()->user->getId(),
		));
	
		$this->render('view',array(
			'model'=>$model,
			'taskComment'=>$taskComment,
		));
	}
	
	/**
	*  @param integer $id ID Project
	*/
	public function actionCompleted($id) {
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		$models = Task::model()->findAll(array(
			'condition'=>'project_id = :project_id AND is_ready =1',
			'params'=>array(
				':project_id'=>$id,
			),
		));
		
		$this->render('completed',array(
			'models'=>$models, 
			'model'=>$model,
		)); 
	}
	
	/**
	*  @param integer $id ID Project
	*/
	public function actionWithoutCategory($id) {
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
			
		$models = Task::model()->findAll(array(
			'condition'=>'project_id = :project_id AND task_category_id IS NULL',
			'params'=>array(
				':project_id'=>$id,
			),
		));
		
		$this->render('withoutCategory',array(
			'models'=>$models, 
			'model'=>$model,
		)); 
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($categoryId)
	{
		$category = $this->loadCategory($categoryId);
                $model=new Task;
                $model->task_category_id = $category->getPrimaryKey();
                $model->project_id = $category->project_id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task'])) {
			$model->attributes=$_POST['Task'];
			if($model->save()) {
				$this->redirect(array('/project/view','id'=>$model->project_id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id); 

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save())
				$this->redirect(array('/project/view','id'=>$model->project_id));
		}
		
		$taskFile = new TaskFile();
		$taskFile->task_id = $model->getPrimaryKey();
		if(isset($_POST['TaskFile'])) {
			$taskFile->attributes=$_POST['TaskFile'];
			if($taskFile->save(true)) {
				$this->refresh();
			}
		}

		$this->render('update',array(
			'model'=>$model, 
			'taskFile'=>$taskFile,
		));
	}
	
	public function actionUploadFile($id) {
		$this->fileUpload($id);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
                $model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/project/view', 'id'=>$model->project_id));
	}
        
        /**
         * 
         */
        public function actionAjaxUpdateOrder() {
            $tasks = Yii::app()->request->getPost('tasks', array());
            if(sizeof($tasks) > 0) {
                foreach($tasks as $priority=>$pk) {
                    Task::model()->updateAll(array(
                        'priority'=>$priority,
                    ), 'id=:id', array(
                        ':id'=>$pk,
                    ));
                }
            }
            Yii::app()->end();
        }

        /**
         * 
         * @param type $id Task
         * @throws CHttpException
         */
        public function actionAjaxUpdate() {
            $id = Yii::app()->request->getParam('id');
            $model = $this->loadModel($id);
            if(isset($_POST['Task']))
            {
			$model->attributes=$_POST['Task'];                       
			if($model->save()) {
                           
                            echo json_encode(array('success'=>1));
                        } else {
                            echo json_encode(array('error'=>1, 'info'=>$model->getErrors()));
                        }
                        
                        Yii::app()->end();
            }
            throw new CHttpException(404, "Error set params");
        }

                /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Task');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Task('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Task']))
			$model->attributes=$_GET['Task'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Task the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        /**
         * 
         * @param integer $id
         * @return TaskCategory
         * @throws CHttpException
         */
        public function loadCategory($id) {
                $model = TaskCategory::model()->findByPk($id);
                if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }

        /**
	 * Performs the AJAX validation.
	 * @param Task $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
