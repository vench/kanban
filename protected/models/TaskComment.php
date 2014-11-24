<?php

/**
 * This is the model class for table "{{task_comment}}".
 *
 * The followings are the available columns in table '{{task_comment}}':
 * @property integer $id
 * @property integer $task_id
 * @property integer $user_id
 * @property integer $time_insert
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Task $task
 */
class TaskComment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{task_comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment', 'required'),
			array('task_id, user_id, time_insert', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, task_id, user_id, time_insert, comment', 'safe', 'on'=>'search'),
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
			'task' => array(self::BELONGS_TO, 'Task', 'task_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_id' => Yii::t('main','Task'),
			'user_id' => Yii::t('main','User'),
			'time_insert' => Yii::t('main','Time Insert'),
			'comment' => Yii::t('main','Comment'),
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
		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('time_insert',$this->time_insert);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave() {
		if($this->isNewRecord) {
			$this->user_id = Yii::app()->user->getId();
			$this->time_insert = time();
			$this->sendNotifications();
		}
		return parent::beforeSave();
	}

	protected function sendNotifications() {
		$users = $this->task->project->userProjects;
		foreach($users as $user) {
			if($user->user_id != $this->user_id) {
				$this->sendNotification($user->user_id);
			}			
		}
		if($this->task->project->user_id != $this->user_id) {
			$this->sendNotification($this->task->project->user_id);
		}
	}
	
	protected function sendNotification($user_id) {
		TaskCommentUser::create($user_id, $this->task_id);
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TaskComment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
