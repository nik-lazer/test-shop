<?php

class TaskController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Task;

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save())
                        {
                            //Создаем рандомный список вопросов с учетом пропорции и типа задания.        
                            
                            $prop = explode('/',$model->proportion);
                            $criteria = new CDbCriteria;
                            $criteria1 = new CDbCriteria;
                            $criteria2 = new CDbCriteria;
                            $criteria->condition = 'type=:type AND complex=0';
                            $criteria1->condition = 'type=:type AND complex=1';
                            $criteria2->condition = 'type=:type AND complex=2';                            
                            $criteria->params = array(':type'=>$model->type);
                            $criteria1->params = array(':type'=>$model->type);
                            $criteria2->params = array(':type'=>$model->type);
                            $criteria->order = 'RAND()';
                            $criteria1->order = 'RAND()';
                            $criteria2->order = 'RAND()';
                            $criteria->limit = $prop[0]; 
                            $criteria1->limit = $prop[1]; 
                            $criteria2->limit = $prop[2]; 

                            $modelQ = Question::model()->findAll($criteria);
                            $modelQ1 = Question::model()->findAll($criteria1);
                            $modelQ2 = Question::model()->findAll($criteria2);
                                
                            foreach ($modelQ as $v){
                                $rel = new TaskQuestionRelation;
                                $rel->task_id = $model->id;
                                $rel->quest_id = $v->id;
                                $rel->save();
                            }
                            foreach ($modelQ1 as $v){
                                $rel = new TaskQuestionRelation;
                                $rel->task_id = $model->id;
                                $rel->quest_id=$v->id;
                                $rel->save();                                
                            }
                            foreach ($modelQ2 as $v){
                                $rel = new TaskQuestionRelation;
                                $rel->task_id = $model->id;
                                $rel->quest_id=$v->id;
                                $rel->save();
                            }                     
                            //$this->redirect(array('index'));
                        }        
                }
                else {

		$this->render('create',array(
			'model'=>$model,
		));
                }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Task']))
		{
			$model->attributes=$_POST['Task'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Task');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Task::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}