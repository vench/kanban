<?php

/**
 * This is the model class for table "{{money}}".
 *
 * The followings are the available columns in table '{{money}}':
 * @property integer $id
 * @property integer $task_id
 * @property integer $money
 * @property integer $status
 * @property integer $date_time
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Task $task
 */
class Money extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{money}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('money, task_id', 'required'),
			array('task_id, money, status, date_time', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, task_id, money, status, date_time, comment', 'safe', 'on'=>'search'),
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
			'task' => array(self::BELONGS_TO, 'Task', 'task_id'),
		);
	}
        
        /**
         * 
         * @return string
         */
        public function getHash() {            
            return strtolower(get_class($this)).$this->task_id;
        }
        
        public function getStatusStr() {
            $data = self::getListStatus();
            return isset($data[$this->status]) ? $data[$this->status] : Yii::t('main', 'No');
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_id' => Yii::t('MoneyModule.main', 'Task'),
			'money' => Yii::t('MoneyModule.main', 'Money'),
			'status' => Yii::t('MoneyModule.main', 'Status'),
			'date_time' => Yii::t('MoneyModule.main', 'Date Time'),
			'comment' => Yii::t('MoneyModule.main', 'Comment'),
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
		$criteria->compare('money',$this->money);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_time',$this->date_time);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        /**
         * 
         * @return boolean
         */
        protected function beforeSave() {
            if($this->isNewRecord) {
                $this->date_time = time();
            }
            return parent::beforeSave();
        }

        /**
         * 
         * @return array
         */
        public static function getListStatus() {
            return array(
                0=> Yii::t('MoneyModule.main', 'Expect to pay'),
                1=> Yii::t('MoneyModule.main', 'Paid'),
            );
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Money the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
