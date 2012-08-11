<?php

class GeonamesController extends Controller {
    public function actionIndex() {
        $list = Yii::App()->search->select('*')->
            from(‘geonames_index’)->
            where('Rebecca')->
            orderby(array('name asc'))->
            //filters(array('rubric_id'=>4))->
            search();
        //print_r($list->getRawData());
        $this->render('result', array('list'=>$list->getRawData()));
    }
    
    public function actionSql() {
        $command = Yii::app()->getDb()->createCommand("select * from geonames where name like :name order by name");
        $name = '%Rebecca%';
        $command->bindParam(':name', $name);
        $list = $command->queryAll();
        $this->render('result', array('list'=>$list));       
    }
}