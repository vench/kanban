<?php

/**
 * This is the model class for table "tbl_project".
 *
 * The followings are the available columns in table 'tbl_project':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Task[] $tasks
 * @property Task[] $viewTasks
 * @property TaskCategory[] $taskCategories
 * @property ProjectModul[] $modules
 */
class Project extends CActiveRecord  {
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{project}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, description', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'userProjects' => array(self::HAS_MANY, 'UserProject', 'project_id'),
            'users' => array(self::MANY_MANY, 'User', 'tbl_user_project(project_id, user_id)'),
			'tasks' => array(self::HAS_MANY, 'Task', 'project_id', 'order'=>'priority DESC'),
			'viewTasks' => array(
				self::HAS_MANY, 
				'Task', 
				'project_id', 
				'order'=>'priority DESC', 
				'condition'=>'is_ready = 0 AND task_category_id IS NOT NULL',  
				'with'=>array('taskCommentUsers'=>array('select'=>'user_id',)),
			),
			'taskCategories' => array(self::HAS_MANY, 'TaskCategory', 'project_id', 'order'=>'order_pos'),
			'modules' => array(self::HAS_MANY, 'ProjectModul', 'project_id', ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main', 'Project ID'),
			'user_id' => Yii::t('main','Project user'),
			'name' => Yii::t('main','Project name'),
			'description' => Yii::t('main','Project description'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	* @return TaskCategory
	*/
	public function getCategoryById($id) {
		foreach($this->taskCategories as $taskCategorie) {
			if($taskCategorie->getPrimaryKey() == $id) {
				return $taskCategorie;
			}
		}
		return NULL;
	}

        /**
         * 
         * @return type
         */
        protected function afterSave() {
            if($this->isNewRecord) {
                $this->addDefaultTaskCategory();
            }
            return parent::afterSave();
        }
        
        /**
         * 
         */
        protected function addDefaultTaskCategory() {
            $hash = array(
                Yii::t('main', 'Waiting'),
                Yii::t('main', 'Performed'),
                Yii::t('main', 'Achieved'),
            );
            
            foreach($hash as $name) {
                $model = new TaskCategory();
                $model->project_id=$this->getPrimaryKey();
                $model->order_pos = 0;
                $model->limit_task = 0;
				$model->view_in_table = 1;
                $model->name = $name;
                $model->save();
            }
        }
		
	/**
	* @return int
	*/	
	public function getSizeViewTable() {
		$size = 0;
		foreach($this->taskCategories as $cat){
			if($cat->view_in_table) {
				$size  ++;
			}
		}
		return $size;
	}	
	
	/**
	* @return int
	*/	
	public function getSizeWichOutViewTable() {
		$size = 0;
		foreach($this->taskCategories as $cat){
			if(!$cat->view_in_table) {
				$size  ++;
			}
		}
		return $size;
	}
        
        protected function beforeSave() {
            $this->description = Utill::safetextsave($this->description);
            return parent::beforeSave();
        }

     /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
