<?php

class TaskCategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
	public function accessRules() {
		return array(
			array('allow', 
				'actions'=>array(  'view',  'create', 'delete', 'update', ),
				'expression' => array($this,'allowTaskViewByProject'),
			),
		
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        /**
        * @return boolean
       */	
	public function allowTaskViewByProject() { 
		return true;
	}

	 
        /**
         * Displays a particular model.
         * @param integer $id the ID of the model to be displayed
         * @throws CHttpException
         */
	public function actionView($id) {
                $model = $this->loadModel($id);                
                if(!ProjectHelper::accessUserInProject($model->project_id)) {
                    throw new CHttpException(403, "You do not have permission for this action.");
                }
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($projectId) {
                $project = $this->loadProject($projectId);
                if(!ProjectHelper::currentUserCreater($project)) {
                    throw new CHttpException(403, "You do not have permission for this action.");
                }
                
		$model= new TaskCategory;
                $model->project_id = $project->getPrimaryKey();
		 

		if(isset($_POST['TaskCategory'])) {
			$model->attributes=$_POST['TaskCategory'];
			if($model->save())
				$this->redirect(array('/project/view','id'=>$project->getPrimaryKey()));
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
	public function actionUpdate($id) {
		$model=$this->loadModel($id);
                if(!ProjectHelper::currentUserCreater($model->project)) {
                    throw new CHttpException(403, "You do not have permission for this action.");
                }
 

		if(isset($_POST['TaskCategory'])) {
			$model->attributes=$_POST['TaskCategory'];
			if($model->save())
				$this->redirect(array('/project/view','id'=>$model->project_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$model = $this->loadModel($id);
                if(!ProjectHelper::currentUserCreater($model->project)) {
                    throw new CHttpException(403, "You do not have permission for this action.");
                }
                $model->delete(); 
		 
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/project/view', 'id'=>$model->project_id));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TaskCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TaskCategory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TaskCategory']))
			$model->attributes=$_GET['TaskCategory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TaskCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TaskCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        /**
         * 
         * @param type $id
         * @return Project
         * @throws CHttpException
         */
        public function loadProject($id) {
            $model=  Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }

	/**
	 * Performs the AJAX validation.
	 * @param TaskCategory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
