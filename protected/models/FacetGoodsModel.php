<?php

class FacetGoodsModel extends CModel {
	public $id;
	public $code;
	public $facet_id;
	public $val;
	
	public function tableName() {
		return 'facets2goods';
	}
	
	public function rules() {
		return array(
			array('code,facet_id,val','required'),
			array('val', 'length', 'max'=>100),
			array('id,facet_id', 'numerical'),
			array('code', 'length', 'max'=>5),
		);
	}
	
	public function attributeNames() {
	}
	
	public function FacetGoodsModel($facetId=null, $code=null) {
		if ($facetId&&$code) {
			$row = $this->getByLinks($facetId, $code);
			$this->arrayToObject($row);
		}
	} 

	public function getById($id) {
		$sql = "select * from {$this->tableName()} where id = :id limit 1";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':id', $id);
		$row = $command->queryRow();
		return $row;
	}
	
	public function arrayToObject($row) {
		$this->id = $row['id'];
		$this->code = $row['code'];
		$this->facet_id = $row['facet_id'];
		$this->val = $row['val'];
	}

	public function getByLinks($facetId, $code) {
		$sql = "select * from {$this->tableName()} where facet_id = :facet_id and code = :code limit 1";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':facet_id', $facetId);
		$command->bindParam(':code', $code);
		$row = $command->queryRow();
		return $row;
	}
	
	public function getByCode($code) {
		$sql = "select * from {$this->tableName()} where code = :code";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':code', $code);
		$rows = $command->queryAll();
		return $rows;
	}
	
	public function save() {
		if (!$this->id)
			$sql = "insert into {$this->tableName()} (facet_id, code, val) values (:facet_id, :code, :val)";
		else 
			$sql = "update {$this->tableName()} set facet_id=:facet_id, code=:code, val=:val where id=:id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':facet_id', $this->facet_id);
		$command->bindParam(':code', $this->code);
		$command->bindParam(':val', $this->val);
		if ($this->id) $command->bindParam(':id', $this->id);
		$command->execute();
	}

	public function deleteByFacet($facetId) {
		$sql = "delete from {$this->tableName()} where facet_id = :facet_id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':facet_id', $facetId);
		$rows = $command->execute();
	}
	
	public function getList($rubricId, $code) {
		$sql = "select f.id, f.rubric_id, f.name, f.unit, fg.id as fid, fg.val
				from facets f
				inner join rubric r on r.id=f.rubric_id
				left join {$this->tableName()} fg on fg.facet_id=f.id and fg.code=:code 
				where r.id=:rubric_id";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':rubric_id', $rubricId);
		$command->bindParam(':code', $code);
		$rows = $command->queryAll();
		return $rows;
	}
}