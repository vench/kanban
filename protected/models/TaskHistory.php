<?php

/**
 * This is the model class for table "tbl_task_history".
 *
 * The followings are the available columns in table 'tbl_task_history':
 * @property integer $id
 * @property integer $task_id 
 * @property integer $new_category_id
 * @property integer $time_insert
 * @property integer $user_id 
 *
 * The followings are the available model relations:
 * @property TaskCategory $newCategory 
 * @property Task $task
 * @property User $user user make action
 */
class TaskHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_task_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('task_id, new_category_id, time_insert, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, task_id,  new_category_id, time_insert', 'safe', 'on'=>'search'),
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
			'newCategory' => array(self::BELONGS_TO, 'TaskCategory', 'new_category_id'),
			'task' => array(self::BELONGS_TO, 'Task', 'task_id'),
                        'user'=> array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('main', 'ID'),
			'task_id' => Yii::t('main', 'Task'), 
			'new_category_id' => Yii::t('main', 'New Category'),
			'time_insert' => Yii::t('main', 'Time Insert'),
                        'user_id'=> Yii::t('main', 'User'),
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
		$criteria->compare('new_category_id',$this->new_category_id);
		$criteria->compare('time_insert',$this->time_insert);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    protected function beforeSave() {
            if(!$this->time_insert) {
                $this->time_insert = time();                
            }
            return parent::beforeSave();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TaskHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
