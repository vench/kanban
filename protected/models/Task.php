<?php

/**
 * This is the model class for table "tbl_task".
 *
 * The followings are the available columns in table 'tbl_task':
 * @property integer $id
 * @property integer $project_id
 * @property integer $task_category_id
 * @property integer $is_ready
 * @property integer $priority
 * @property integer $color_hex
 * @property string $description
 * @property string $fulldescription
 * @property integer $user_id
 * @property integer $parent_id
 *
 * The followings are the available model relations:
 * @property TaskCategory $taskCategory
 * @property Project $project
 * @property TaskHistory[] $taskHistories
 * @property TaskComment[] $taskComments
 * @property TaskFile[] $taskFiles
 * @property TaskComment $lastTaskComment
 * @property TaskHistory $lastTaskHistory
 * @property User $user 
 */
class Task extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_task';
	}
        
    /**
     * 
     * @return string
     */
     public function getColor() { 
		if(strpos($this->color_hex, '#') === false) {
			$this->color_hex = '#'.dechex($this->color_hex );
		}		
		return  $this->color_hex;
     }
     
	 /**
	 * @return boolean
	 */
	 public function hasColor() { 	
		return  !is_null($this->color_hex);
	 }

    /**
     * 
     * @return string
     */
	 public function getShortName() {
		return (function_exists('mb_substr')) ? mb_substr(strip_tags($this->description), 0, 64, Yii::app()->charset).'...' : substr(strip_tags($this->description), 0, 64).'...';
	 }
         

    /**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('description', 'required'),
			array('description', 'length', 'max'=>1000),
			array('project_id, task_category_id, is_ready, priority, color_hex, user_id,parent_id', 'numerical', 'integerOnly'=>true),
			array('fulldescription', 'safe'),
            array('task_category_id', 'validateTaskCategory'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, task_category_id, is_ready, description, fulldescription, user_id,parent_id', 'safe', 'on'=>'search'),
		);
	}

    public function validateTaskCategory() {
            $category = TaskCategory::model()->findByPk($this->task_category_id);
            if(!is_null($category) && $category->limit_task > 0 && $category->limit_task <= sizeof($category->tasks) - ($category->isTask($this->getPrimaryKey()) ? 1 : 0)) {
                $this->addError('task_category_id', Yii::t('main', 'You can not select this category. Now in her high notes.'));
            }
    }

        /**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'taskCategory' => array(self::BELONGS_TO, 'TaskCategory', 'task_category_id'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'taskHistories' => array(self::HAS_MANY, 'TaskHistory', 'task_id', 'order'=>'time_insert DESC'),
			'taskComments' => array(self::HAS_MANY, 'TaskComment', 'task_id', 'order'=>'time_insert DESC'),
			'lastTaskComments' => array(self::HAS_ONE, 'TaskComment', 'task_id', 'order'=>'time_insert DESC'),
			'lastTaskHistory' => array(self::HAS_ONE, 'TaskHistory', 'task_id', 'order'=>'time_insert DESC'),
			'taskFiles' => array(self::HAS_MANY, 'TaskFile', 'task_id', 'order'=>'time_insert DESC'),
			'taskCommentUsers' => array(self::HAS_MANY, 'TaskCommentUser', 'task_id'), 
			'user'=> array(self::BELONGS_TO, 'User', 'user_id'), 
			'parent'=> array(self::BELONGS_TO, 'Task', 'parent_id'), 
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main', 'ID'),
			'project_id' => Yii::t('main','Project'),
			'task_category_id' => Yii::t('main','Task Category'),
			'is_ready' => Yii::t('main','Is Ready'),
			'description' => Yii::t('main','Description'),
			'fulldescription' => Yii::t('main','Full description'),
            'priority' => Yii::t('main','Task priority'),
            'color_hex' => Yii::t('main','Task color'),   
			'user_id' => Yii::t('main','Task creator'),
			'parent_id' => Yii::t('main','Task parent'),
		);
	}
	
	/**
	*	@param int $user_id
	*	@return boolean 
	*/
	public function hasNewComment($user_id = NULL) {
		if(is_null($user_id)) {
			$user_id = Yii::app()->user->getId();
		}
		foreach($this->taskCommentUsers as $item) {
			if($item->user_id == $user_id) {
				return true;
			}
		}
		return false;
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
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('task_category_id',$this->task_category_id);
		$criteria->compare('is_ready',$this->is_ready);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fulldescription',$this->fulldescription,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function searchHistories() {
		$model = new TaskHistory('search');
		$model->task_id = $this->id;
		$dp = $model->search();
		$dp->sort->defaultOrder = 't.time_insert DESC';
		$dp->criteria->with = array(
			'user'=>array(),
			'newCategory'=>array(),
		);
		return $dp;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
   
		
	protected function beforeValidate() {
		if(strpos($this->color_hex, '#') !== false) {
			$this->color_hex = hexdec(substr($this->color_hex, 1));
		}  
		return parent::beforeValidate();
	}	
		
	/**
	*
	*/	
	protected function beforeSave() {
		if($this->isNewRecord) {
			$this->user_id = Yii::app()->user->getId(); 
		}
		$this->description = Utill::safetextsave($this->description);
		$this->fulldescription = Utill::safetextsave($this->fulldescription);
		return parent::beforeSave();
	}

	protected function afterFind() {
		$this->color_hex = $this->getColor();
		return parent::afterFind();
	}
	
   /**
    * 
    * @return type
    */
    protected function afterSave() {
            $this->detectedUpdateCategory();
            return parent::afterSave();
    }
        
    /**
     * Проверяем была ли изменена категория
     */
    protected function detectedUpdateCategory() {
           if(isset( $this->taskHistories[0]) && $this->taskHistories[0]->new_category_id == $this->task_category_id) {
                 return;
           }
           $taskHistory = new TaskHistory();
           $taskHistory->new_category_id = $this->task_category_id;
           $taskHistory->task_id = $this->getPrimaryKey();
           $taskHistory->time_insert = time();
           $taskHistory->user_id = Yii::app()->user->getId();
           $taskHistory->save();
    }
}
