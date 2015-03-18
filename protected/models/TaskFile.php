<?php

/**
 * This is the model class for table "{{task_file}}".
 *
 * The followings are the available columns in table '{{task_file}}':
 * @property integer $id
 * @property integer $task_id
 * @property string $patch
 * @property string $filename
 * @property integer $time_insert
 * @property integer $project_id
 *
 * The followings are the available model relations:
 * @property Task $task
 */
class TaskFile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{task_file}}';
	}
	
	/**
    *
    * @return array 
    */
    public function behaviors() {
        return array_merge(parent::behaviors(),array(
            'fileUploadCActiveRecordBehavior'=>array(
                'class'=>'FileUploadCActiveRecordBehavior',
                'fileFields'=>array('patch'), 
		'fileNameAs'=>array('patch'=>'filename',),
		'extensions' => array( 'zip','rar','7zip','jpg', 'png', 'jpeg', 'gif', 'doc', 'docx', 'txt', 'pdf', 'xls', 'xlsx', ),
            ),
        ));
    }

	public function getFileNameStr() {
		return !is_null($this->filename) ? $this->filename : basename($this->patch);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{ 
		return array(
			array('patch', 'required'),
			array('task_id,time_insert,project_id', 'numerical', 'integerOnly'=>true),
			array('patch,filename', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, task_id, patch,string', 'safe', 'on'=>'search'),
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_id' => 'Task',
			'project_id'  => 'Project',
			'patch' => 'Patch',
			'filename'=> Yii::t('main', 'File name'),
			'time_insert' => Yii::t('main', 'Time Insert'),
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
		$criteria->compare('patch',$this->patch,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave() {
		if($this->isNewRecord) {
			$this->time_insert = time();
		}
		return parent::beforeSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TaskFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
