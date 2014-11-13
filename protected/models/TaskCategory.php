<?php

/**
 * This is the model class for table "tbl_task_category".
 *
 * The followings are the available columns in table 'tbl_task_category':
 * @property integer $id
 * @property integer $project_id
 * @property integer $order_pos
 * @property integer $limit_task
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Task[] $tasks
 * @property Project $project
 * @property TaskHistory[] $taskHistories
 * @property TaskHistory[] $taskHistories1
 */
class TaskCategory extends CActiveRecord
{

	/**
	* @var integer
	*/
	public $limit_task = 0;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_task_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('limit_task, name', 'required'),
			array('project_id, order_pos, limit_task', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, project_id, order_pos, limit_task, name', 'safe', 'on'=>'search'),
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
			'tasks' => array(self::HAS_MANY, 'Task', 'task_category_id', 'order'=>'priority DESC'),
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'taskHistories' => array(self::HAS_MANY, 'TaskHistory', 'new_category_id'),
			'taskHistories1' => array(self::HAS_MANY, 'TaskHistory', 'old_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'project_id' => Yii::t('main','Project'),
			'order_pos' => Yii::t('main','Order Pos'),
			'limit_task' => Yii::t('main','Limit Task'),
			'name' => Yii::t('main','Name'),
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
		$criteria->compare('order_pos',$this->order_pos);
		$criteria->compare('limit_task',$this->limit_task);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TaskCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
