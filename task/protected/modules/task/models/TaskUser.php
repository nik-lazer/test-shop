<?php

/**
 * This is the model class for table "task_user".
 *
 * The followings are the available columns in table 'task_user':
 * @property integer $id_user
 * @property integer $id_task
 * @property string $votes
 */
class TaskUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TaskUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_task, votes', 'required'),
			array('id_user, id_task', 'numerical', 'integerOnly'=>true),
			array('votes', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_user, id_task, votes', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'id_task' => 'Id Task',
			'votes' => 'Votes',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_task',$this->id_task);
		$criteria->compare('votes',$this->votes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}