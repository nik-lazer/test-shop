<?php

class FacetController extends Controller {
	public function actionList() {
		$rubricId = DataUtils::checkIntVal(Yii::app()->request->getQuery('rubric',0));
		$rubricModel = new RubricModel();
		$rubric = $rubricModel->getById($rubricId);
		if (!$rubric['id']) $this->redirect('/');
		$facetModel = new FacetModel();
		$rows = $facetModel->getByRubric($rubricId);
		$this->breadcrumbs = $rubricModel->getParents($rubricId);
		$this->breadcrumbs['Фасеты'] = Yii::app()->getRequest()->getUrl();
		$this->render('list', array('rubric'=>$rubric,'rows'=>$rows));
	}
	
	public function actionAdd() {
		$facetModel = new FacetModel();
		if (isset($_POST['FacetModel'])) {
			$facetModel->attributes = $_POST['FacetModel'];
			$rubricId = $facetModel->rubric_id;
			if ($facetModel->validate()) {
				$facetModel->save();
				$this->redirect('/facet/list/rubric/'.$facetModel->rubric_id.'/');
			}
		} else {
			$rubricId = DataUtils::checkIntVal(Yii::app()->request->getQuery('rubric',0));
			$facetModel->rubric_id = $rubricId;
		}
		$rubricModel = new RubricModel();
		$row = $rubricModel->getById($rubricId);
		if (!$row['id']) $this->redirect('/');
		$this->breadcrumbs = $rubricModel->getParents($rubricId);
		$this->breadcrumbs['Добавление фасета'] = Yii::app()->getRequest()->getUrl(); 
		$this->render('add', array('model'=>$facetModel));
	}
	
	public function actionEdit() {
		$id = DataUtils::checkIntVal(Yii::app()->request->getParam('id',0));
		$facetModel = new FacetModel($id);
		if (!$facetModel->id) $this->redirect('/');
		if (isset($_POST['FacetModel'])) {
			$facetModel->attributes = $_POST['FacetModel'];
			if ($facetModel->validate()) {
				$facetModel->save('update');
				$this->redirect('/facet/list/rubric/'.$facetModel->rubric_id.'/');
			}
		}
		$rubricModel = new RubricModel();
		$this->breadcrumbs = $rubricModel->getParents($facetModel->rubric_id);
		$this->breadcrumbs['Редактирование фасета'] = Yii::app()->getRequest()->getUrl(); 
		$this->render('edit', array('model'=>$facetModel));
	}
	
	public function actionDelete() {
		$id = DataUtils::checkIntVal(Yii::app()->request->getQuery('id',0));
		$facetModel = new FacetModel($id);
		$rubricId = $facetModel->rubric_id;
		$facetModel->delete($id);
		$this->redirect('/facet/list/rubric/'.$rubricId.'/');
	}
}