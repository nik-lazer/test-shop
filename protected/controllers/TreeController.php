<?php

class TreeController extends Controller {
    public function actionIndex() {
        $rubricModel = new RubricModel();
        $rubricList = $rubricModel->getByParent();
        //print_r($rubricList);exit();
        $data = array();
        foreach ($rubricList as $rubric) {
            $rubricModel->attributes = $rubric;
            $data[] = $rubricModel->treeData();
        }
        $this->render('index', array('data'=>$data));
    }
}