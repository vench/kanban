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
 *
 * The followings are the available model relations:
 * @property TaskCategory $taskCategory
 * @property Project $project
 * @property TaskHistory[] $taskHistories
 * @property TaskComment[] $taskComments
 * @property TaskFile[] $taskFiles
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
            $data = self::getColors();
            return isset($data[$this->color_hex]) ? $data[$this->color_hex] : '';
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
			array('project_id, task_category_id, is_ready, priority, color_hex', 'numerical', 'integerOnly'=>true),
			array('fulldescription', 'safe'),
                        array('task_category_id', 'validateTaskCategory'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, task_category_id, is_ready, description, fulldescription', 'safe', 'on'=>'search'),
		);
	}

    public function validateTaskCategory() {
            $category = TaskCategory::model()->findByPk($this->task_category_id);
            if(!is_null($category) && $category->limit_task > 0 && $category->limit_task <= sizeof($category->tasks)) {
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
			'taskFiles' => array(self::HAS_MANY, 'TaskFile', 'task_id'),
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
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         * 
         * @return array
         */
        public static function getColors() {
            return array(
                hexdec('6495ED')=>'#6495ED',
                hexdec('FFFF00')=>'#FFFF00',
                hexdec('EE0000')=>'#EE0000', 
            );
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
