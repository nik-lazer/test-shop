<?php

/**
 * This is the model class for table "answer".
 *
 * The followings are the available columns in table 'answer':
 * @property integer $id
 * @property integer $quest_id
 * @property string $value
 * @property integer $is_answer
 */
class Answer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Answer the static model class
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
		return 'answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value', 'required'),
			array('quest_id, is_answer', 'numerical', 'integerOnly'=>true),
                        array('quest_id', 'safe'),
			array('value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quest_id, value, is_answer', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'quest_id' => 'Quest',
			'value' => 'Вариант',
			'is_answer' => 'Это ответ?',
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
                
		$criteria->compare('id',$this->id);
		$criteria->compare('quest_id',$this->quest_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('is_answer',$this->is_answer);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}