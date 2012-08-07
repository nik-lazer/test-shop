<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$pid = DataUtils::checkIntVal(Yii::app()->request->getQuery('pid',0));
		$searchCriteria = new stdClass();
        
		$pages = new CPagination();
        //$pages->pageSize = 100;
        //$pages->setCurrentPage(0);
        $searchCriteria->select = '*';
        $searchCriteria->filters = array('code' => '00001');
        //$searchCriteria->query = '@name '.$query.'*';
        //$searchCriteria->paginator = $pages;
        //$searchCriteria->groupby = $groupby;
        //$searchCriteria->orders = array('name' => 'ASC');
        $searchCriteria->from = 'shop';
        $resIterator = Yii::App()->search->search($searchCriteria); // interator result
        /* OR */
        $resArray = Yii::App()->search->searchRaw($searchCriteria); // array result

        $rubricModel = new RubricModel();
		$model = $rubricModel->getById($pid);
		$childCount = $rubricModel->getChildCount($pid);
		$this->breadcrumbs = $rubricModel->getParents($pid);
		if ($childCount) {
			$rows = $rubricModel->getByParent($pid);
			$this->render('index', array('model'=>$model,'rows'=>$rows));
		} else {
			$goodsModel = new GoodsModel();
			$rows = $goodsModel->getByRubric($pid);
			$this->render('goods', array('model'=>$model,'rows'=>$rows));
		}
	}
	
	public function actionGood() {
		$code = Yii::app()->request->getQuery('code');
		$goodsModel = new GoodsModel($code);
		if (!$goodsModel->code) $this->redirect('/');
		$rubricId = $goodsModel->getRubricId($code);
		if (isset($_POST['facets'])) {
			Yii::log(print_r($_POST, true));
			$facets = $_POST['facets'];
			if (is_array($facets)) {
				foreach ($facets as $facet=>$value) {
					$model = new FacetGoodsModel($facet, $code);
					Yii::log(print_r($model, true),'info', 'application');
					$model->code = $code;
					$model->facet_id = $facet;
					$model->val = $value;
					if ($model->validate())
						$model->save();
				}
				$this->redirect('/site/good/code/'.$code.'/');
			}
		}
		$model = new FacetGoodsModel();
		$rows = $model->getList($rubricId, $code);
		$rubricModel = new RubricModel();
		$this->breadcrumbs = $rubricModel->getParents($rubricId);
		$this->breadcrumbs[$goodsModel->name] = Yii::app()->getRequest()->getUrl(); 
		$this->render('good', array('model'=>$goodsModel,'rows'=>$rows));
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}