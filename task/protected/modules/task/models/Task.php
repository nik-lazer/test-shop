<?php
/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property integer $time_create
 * @property integer $type
 * @property integer $status
 * @property integer $time_start
 * @property integer $time_end
 * @property integer $lot_id
 * @property string $proportion
 * @property integer $count_users
 * @property integer $count_end_users
 */
class Task extends CActiveRecord
{
        const maskDateFormat = 'd/m/Y H:i:s';
        
        static $task_type = array(
            1=>'Викторина',
            2=>'Память',
            3=>'Логика',
            4=>'Сообразительность',
        );
        
        static $task_status = array(
            'Черновик',
            'Подключено',
            'Активно',
            'Закончено'
        );
        
        static $complex = array(
            0 => 'Легкая',
            1 => 'Средняя',
            2 => 'Сложная'  
        );
        
        //Возвращает уровень сложности
        static function getComplex($key) {
            return self::$complex[$key];
        } 
        
        //Возвращает тип задания
        static function getTaskType($key)
        {
            return self::$task_type[$key];
        }
        
        //Возвращает статус задания
        static function getTaskStatus($key)
        {
            return self::$task_status[$key];
        }

        
	/**
	 * Returns the static model of the specified AR class.
	 * @return Task the static model class
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
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('time_create, type, proportion', 'required'),
			array('time_create, type, status, time_start, time_end, lot_id, count_users, count_end_users', 'safe'),
			array('time_create, type, status, time_start, time_end, lot_id, count_users, count_end_users', 'numerical', 'integerOnly'=>true),
			array('proportion', 'propValidate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time_create, type, status, time_start, time_end, lot_id, proportion, count_users, count_end_users', 'safe', 'on'=>'search'),
		);
	}
        
        //Валидатор пропорции сложности
        public function propValidate($attribute, $params)
        {
            if(!empty($this->proportion)){
                $t = explode('/',$this->proportion);

                $num = true;
                foreach($t as $k=>$v){
                    if(!is_numeric($v))
                        $num = false;
                }
                if(sizeof($t)!=3 && !$num){
                    $this->addError('proportion', 'Заполните поле, согласно маске "*/*/*", где * - любое целое число');
                }
            }
            else {
               $this->addError('proportion', 'Заполните поле, согласно маске "*/*/*", где * - любое целое число'); 
            }
        }
        
        
        protected function beforeSave()
        {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                {
                    $this->time_create=time();
                }
                
                if($this->lot_id==0){  
                    $this->status = 0;
                } 
                elseif($this->isNewRecord && $this->lot_id!=0){
                    $this->status = 1;
                }
                
                return true;
            }
            else
                return false;
        }
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'quest'=>array(self::MANY_MANY, 'Question', 'task_question_relation(task_id, quest_id)')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'time_create' => 'Время создания',
			'type' => 'Тип задания',
			'status' => 'Статус',
			'time_start' => 'Время начала',
			'time_end' => 'Время окончания',
			'lot_id' => 'Лот',
			'proportion' => 'Пропорция сложности (легкие/средние/сложные)',
			'count_users' => 'Кол-во участников',
			'count_end_users' => 'Кол-во прошедших задание',
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
		$criteria->compare('time_create',$this->time_create);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);
		$criteria->compare('time_start',$this->time_start);
		$criteria->compare('time_end',$this->time_end);
		$criteria->compare('lot_id',$this->lot_id);
		$criteria->compare('proportion',$this->proportion,true);
		$criteria->compare('count_users',$this->count_users);
		$criteria->compare('count_end_users',$this->count_end_users);
                */
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}