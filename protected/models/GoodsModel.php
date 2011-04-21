<?php

class GoodsModel extends CModel {
	public $code;
	public $name;
	
	public function GoodsModel($code=null) {
		if ($code) {
			$row = $this->getByCode($code);
			$this->arrayToObject($row);
		}
	} 
	
	public function tableName() {
		return 'goods';
	}
	
	public function attributeNames() {
	}
	
	public function arrayToObject($row) {
		$this->code = $row['code'];
		$this->name = $row['name'];
	}
	
	public function getByCode($code) {
		$sql = "select * from {$this->tableName()} where code = :code limit 1";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':code', $code);
		$row = $command->queryRow();
		return $row;
	}
	
	public function getByRubric($rubricId) {
		$sql = "select * from {$this->tableName()} g
			inner join goods2rubric gr on gr.code=g.code
			where gr.id=:rubric_id
			order by name";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':rubric_id', $rubricId);
		$rows = $command->queryAll();
		return $rows;
	}
	
	public function getRubricId($code) {
		$sql = "select gr.id from {$this->tableName()} g
			inner join goods2rubric gr on gr.code=g.code
			where gr.code=:code";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':code', $code);
		$ret = $command->queryScalar();
		return $ret;
	}
}