<?php

class RubricModel extends CModel {
	
	public function tableName() {
		return 'rubric';
	}
	
	public function attributeNames() {
	}
	
	public function getById($id) {
		$sql = "select * from {$this->tableName()} where id=:id limit 1";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':id', $id);
		$row = $command->queryRow();
		return $row;
	}
	
	public function getChildCount($id) {
		if (!$id)
			$where = "parent_id is null";
		else 
			$where = "parent_id=:id";
		$sql = "select count(id) from {$this->tableName()} where {$where}";
		$command = Yii::app()->db->createCommand($sql);
		if ($id) $command->bindParam(':id', $id);
		$ret = $command->queryScalar();
		return $ret;
	}
	
	public function getByParent($parentId=null) {
		if (!$parentId)
			$where = "r.parent_id is null";
		else 
			$where = "r.parent_id=:parent_id";
		$sql = "select r.id, r.parent_id, r.name, count(rc.id) as child_count  
			from {$this->tableName()} r
			left join {$this->tableName()} rc on r.id=rc.parent_id
		 	where {$where} 
		 	group by id, parent_id, name
		 	order by name";
		$command = Yii::app()->db->createCommand($sql);
		if ($parentId) $command->bindParam(':parent_id', $parentId);
		$rows = $command->queryAll();
		return $rows;
	}
	
	public function getParents($id, $ret=array()) {
		$row = $this->getById($id);
		if ($row['id']) {
			if (!$row['parent_id']) {
				$ret['Главная'] = '/';
			} 
			$ret = $this->getParents($row['parent_id'], $ret);
			$ret[$row['name']] = ($row['id']?'/site/index/pid/'.$row['id']:'').'/';
		} else if (!count($ret)) 
			$ret['Главная'] = '/';
		return $ret;
	}
}