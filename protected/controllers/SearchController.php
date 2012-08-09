<?php

class SearchController extends Controller {
    public function actionIndex() {
        		$searchCriteria = new stdClass();
        
		$pages = new CPagination();
        //$pages->pageSize = 100;
        //$pages->setCurrentPage(0);
        $searchCriteria->select = '*';
        //$searchCriteria->filters = array('name' => 'Белизна');
        //$searchCriteria->query = '@name '.$query.'*';
        //$searchCriteria->paginator = $pages;
        //$searchCriteria->groupby = $groupby;
        //$searchCriteria->orders = array('name' => 'ASC');
        $searchCriteria->from = 'facet_index';
        $resIterator = Yii::App()->search->search($searchCriteria); // interator result
        /* OR */
        $resArray = Yii::App()->search->searchRaw($searchCriteria); // array result
        print_r($resArray);
        
    }
    
    public function actionTest() {
        $list = Yii::App()->search->select('*')->
            from(‘facet_index’)->
            //where('Белизна')->
            orderby(array('name desc'))->
            //filters(array('rubric_id'=>4))->
            search();
        print_r($list);
    }
}