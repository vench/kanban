<?php

class ProjectController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'create'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'userProjectRmove' ,'delete'),
				'expression' => array($this,'allowProjectRulesEdit'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view', 'statistics', 'viewTree', 'addFile'),
				'expression' => array($this,'allowProjectRulesView'),
			),
			 
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        /**
         * @return boolean
         */
    public function allowProjectRulesView() {
            $projectID  = Yii::app()->request->getParam('id');
            return ProjectHelper::accessUserInProject($projectID);
    }

    /**
    * @return boolean
    */
    public function allowProjectRulesEdit() {
            $projectID  = Yii::app()->request->getParam('id');
            return ProjectHelper::accessCreaterProject($projectID);
    }
    
    
    /**
     * 
     * @param type $id ID Project
     */
    public function actionAddFile($id) {
        $model=Project::model()->findByPk($id);
        $file = new TaskFile();
        $file->project_id = $model->id;
        $file->task_id = 0;
        if(isset($_POST['TaskFile'])) {
		$file->attributes=$_POST['TaskFile'];
		if($file->save(true)) {
				$this->redirect(array('view', 'id'=>$model->id));
		}
	}
        
        $this->render('addFile',array(
		'model'=>$model, 
		'file'=>$file, 
	));
    }
	
	/**
	* @param integer $id ID Project
	*/
    public function actionViewTree($id) {
		$model=Project::model()->findByPk($id, array(
			'with'=>array(
				'taskCategories'=>array(),
				'user'=>array(), 
				//'tasks'=>array(),
			), 
		));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.'); 
	 
		 
		$tasks = Task::model()->findAll(array(
			'condition'=>'project_id=:project_id AND is_ready = 0 AND task_category_id IS NOT NULL',
			'params'=>array(
				':project_id'=>$model->getPrimaryKey(),
			),
			'with'=>array(
				'lastTaskHistory'=>array(
					'with'=>array('user'=>array('select'=>'name',))
				),
				'project'=>array(
				
				),
			),
			'order'=>'t.priority DESC',
			'select'=>'id,task_category_id,description,color_hex,project_id,user_id,fulldescription',
		));	
		
		$this->render('viewTree',array(
			'model'=>$model, 
			'tasks'=>$tasks,
		));
	}
        
    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model=Project::model()->findByPk($id, array(
			'with'=>array(
				'taskCategories'=>array(),
				'user'=>array(), 
				//'tasks'=>array(),
			), 
		));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.'); 
	 
		$showParent = Yii::app()->request->getParam('only-parent', 0); 
		$tasks = Task::model()->findAll(array(
			'condition'=>'t.project_id=:project_id AND t.is_ready = 0 AND t.task_category_id IS NOT NULL AND taskCategory.view_in_table = 1'
			. ($showParent  ? ' AND (t.parent_id IS NULL OR t.parent_id = 0)' : ''),
			'params'=>array(
				':project_id'=>$model->getPrimaryKey(),
			),
			'with'=>array(
				'lastTaskHistory'=>array(
					'with'=>array('user'=>array('select'=>'name',))
				),
				'project'=>array(
				
				),
				'taskCategory'=>array(
					'select'=>false,
				),
			),
			'order'=>'t.priority DESC',
			'select'=>'id,task_category_id,description,color_hex,project_id,user_id,parent_id',
		));	
			
		$this->layout = 'column1';
		
		$this->render('view',array(
			'model'=>$model, 
			'tasks'=>$tasks,
			'showParent'=>$showParent,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Project;
		$model->user_id = Yii::app()->user->getId(); 

		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Project'])) {
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
                
		$userProject = new UserProject();
		$userProject->project_id = $model->getPrimaryKey();
                
		if(isset($_POST['UserProject'])) {
			$userProject->attributes=$_POST['UserProject'];
			if($userProject->save()) {
				$this->refresh ();
			}
		}
		
		$projectModul = new ProjectModul();
		$projectModul->modul_name = CHtml::listData($model->modules, 'modul_name', 'modul_name');
		if(isset($_POST['ProjectModul'])) {
			$projectModul->attributes=$_POST['ProjectModul']; 
			ProjectModul::model()->deleteAll('project_id=:project_id', array(
				':project_id'=>$model->id,
			));
			foreach($projectModul->modul_name as $name) {
				$newModul = new ProjectModul();
				$newModul->project_id = $model->id;
				$newModul->modul_name = $name;
				if($newModul->save()) {
                                    Yii::app()->getModule($name)->install();
                                }
			}	
			$this->refresh ();
		}

		$this->render('update',array(
			'model'=>$model,
			'userProject'=>$userProject,
			'projectModul'=>$projectModul,
		));
	}

        /**
         * 
         * @param int $uid User ID
         * @param int $pid Project ID
         */
        public function actionUserProjectRmove($uid, $pid) {
                $model = UserProject::model()->find(array(
                    'condition'=>'project_id=:project_id AND user_id=:user_id',
                    'params'=>array(
                        ':project_id'=>$pid,
                        ':user_id'=>$uid,
                    ),
                ));
                $model->delete();
                $this->redirect(array('update', 'id'=>$pid));
        }
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {	
                $model=new ProjectSearchForm(); 
		if(isset($_GET['ProjectSearchForm']))
			$model->attributes=$_GET['ProjectSearchForm']; 
		
		$this->render('index',array( 
                        'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionStatistics($id) {
		$model = $this->loadModel($id);
		$taskHistores = TaskHistory::model()->findAll(array(
			'order'=>'t.task_id,t.time_insert',
			'with'=>array(
				'task'=>array(
					'select'=>false
				),
			),
			'condition'=>'task.project_id = :project_id',
			'params'=>array(
				':project_id'=>$model->id,
			),
		));

		$this->render('statistics',array(
			'model'=>$model,			 
			'taskHistores'=>$taskHistores,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Project the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Project $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
