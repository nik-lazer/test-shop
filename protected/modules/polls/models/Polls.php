<?php

/**
 * This is the model class for table "polls".
 *
 * The followings are the available columns in table 'polls':
 * @property integer $id
 * @property string $name
 * @property integer $published
 * @property integer $statistic_type
 *
 * The followings are the available model relations:
 */
class Polls extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Polls the static model class
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
		return 'polls';
	}

        public function scopes()
        {
            return array(
                'published'=>array(
                    'condition'=>'published=1',
                ),
            );
        }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('published, statistic_type', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, published, statistic_type', 'safe', 'on'=>'search'),
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
                    'variable'=>array(self::HAS_MANY, 'Variable', 'polls_id', 'order'=>'sort asc'),
                    'votes'=>array(self::HAS_MANY, 'Votes', 'id_polls'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Вопрос',
			'published' => 'Статус',
			'statistic_type' => 'Выводимый результат',
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

		//$criteria->compare('id',$this->id);
		//$criteria->compare('name',$this->name,true);
		//$criteria->compare('published',$this->published);
		//$criteria->compare('statistic_type',$this->statistic_type);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}