<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $complex
 * @property integer $type
 */
class Question extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Question the static model class
	 */
        public $answer = array(); 
    
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, complex, type', 'required'),
			array('complex, type', 'numerical', 'integerOnly'=>true),
                        array('description', 'safe'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, complex, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
                    'ans'=>array(self::HAS_MANY, 'Answer', 'quest_id'),
		);
	}
        
        public function type($type)
        {
            $this->getDbCriteria()->mergeWith(array(
                'condition'=>'type=:type',
                'params'=>array(':type'=>$type),
            ));
            return $this;
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'name' => 'Вопрос',
			'description' => 'Описание',
			'complex' => 'Уровень сложности',
                        'type'=>'Тип'
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
                /*
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('complex',$this->complex);
		$criteria->compare('type',$this->task_id);
                */
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}