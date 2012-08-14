<?php

class TreeController extends Controller {
    public function actionIndex() {
        $this->render('index');
    }
    
    public function actionData() {
        $root = Yii::app()->request->getQuery('root', 'source');
        $rubricModel = new RubricModel();
        if ($root=='source') {
            $rubricList = $rubricModel->getByParent();
            //print_r($rubricList);exit();
        } else {
            $id = DataUtils::checkIntVal($root);
            $rubricList = $rubricModel->getByParent($id);
        }
        $data = array();
        foreach ($rubricList as $rubric) {
            $rubricModel->attributes = $rubric;
            $data[] = $rubricModel->treeData(false);
        }
        echo CTreeView::saveDataAsJson($data);
    }
}