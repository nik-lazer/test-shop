<?php

class FacetModel extends CModel {
	public $id;
	public $rubric_id;
	public $name;
	public $unit;
	
	public function tableName() {
		return 'facets';
	}
	
	public function rules() {
		return array(
			array('id,rubric_id', 'numerical'),
			array('rubric_id,name','required'),
			array('name', 'length', 'max'=>512),
			array('unit', 'length', 'max'=>100),
		);
	}
	
	public function attributeLabels() {
		return array(
			'name'=>'Наименование',
			'unit'=>'Eдиница измерения',
		);
	}
	
	public function attributeNames() {
	}
	
	public function FacetModel($id=null) {
		if ($id) {
			$row = $this->getById($id);
			$this->arrayToObject($row);
		}
	}
	
	public function arrayToObject($row) {
		$this->id = $row['id'];
		$this->rubric_id = $row['rubric_id'];
		$this->name = $row['name'];
		$this->unit = $row['unit'];
	}
	
	public function getById($id) {
		$sql = "select * from {$this->tableName()} where id = :id limit 1";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':id', $id);
		$row = $command->queryRow();
		return $row;
	}
	
	public function getByRubric($rubricId) {
		$sql = "select * from {$this->tableName()} where rubric_id = :rubric_id order by name";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':rubric_id', $rubricId);
		$rows = $command->queryAll();
		return $rows;
	}
	
	public function save($action='insert') {
		if ($action=='insert')
			$sql = "insert into {$this->tableName()} (rubric_id, name, unit) values (:rubric_id, :name, :unit)";
		else 
			$sql = "update {$this->tableName()} set rubric_id=:rubric_id, name=:name, unit=:unit where id=:id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':rubric_id', $this->rubric_id);
		$command->bindParam(':name', $this->name);
		$command->bindParam(':unit', $this->unit);
		if ($action!='insert') $command->bindParam(':id', $this->id);
		$command->execute();
	}
	
	public function delete($id) {
		$facetGoodsModel = new FacetGoodsModel();
		$facetGoodsModel->deleteByFacet($id);
		$sql = "delete from {$this->tableName()} where id = :id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':id', $id);
		$rows = $command->execute();
	}
}