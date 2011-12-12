<?php

class QuizController extends TaskBaseController
{
        
        private $type = 1;
	
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Question;
                $model->type = $this->type;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Question']))
		{
			$model->attributes=$_POST['Question'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Question']))
		{
			$model->attributes=$_POST['Question'];
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
		$dataProvider=new CActiveDataProvider('Question',array(
                    'criteria'=>Question::model()->type($this->type)->getDbCriteria(),
                ));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionVotes()
        {
            if(Yii::app()->request->isAjaxRequest && !Yii::app()->user->isGuest && isset($_POST['user_answer'],$_POST['task_id'],$_POST['question_id'], $_POST['lot']))
            {

                $user_answer = $_POST['user_answer'];
                $task_id = $_POST['task_id'];
                $quest_id = $_POST['question_id'];
                $lot = $_POST['lot'];
                
                $user = TaskUser::model()->find(
                            'id_task=:task AND id_user=:user',
                            array(':task'=>$task_id, ':user'=>1) //user->id!!!        
                            );
                $votes = array();
                
                if(!empty($user->votes)){
                    $votes = unserialize(stripslashes($user->votes));
                }
                
                $count = sizeof($votes);
                $votes[$count]['id'] = $quest_id;
                $votes[$count]['answer'] = $user_answer;
                $votes = addslashes(serialize($votes));
                $user->votes = $votes;
                $user->save(false);
                
                $this->widget('task.components.TaskWidget', array(
                    'lot'=>$lot,
                    'user'=>$user,
                ));
                
            }
            
        }
        
        
}
