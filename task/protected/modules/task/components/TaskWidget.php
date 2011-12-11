<?php
Yii::import('task.models.*');
//Yii::import('task.controllers.*');

class TaskWidget extends CWidget
{
   
    public $lot=2;
    protected $model;
    protected $question;
    protected $message;
    protected $key=0;


    public function init()
    {    
        if(!Yii::app()->user->isGuest){
            
            $this->model = Task::model()->with('quest.ans')->find(array(
                   'condition'=>'lot_id=:lot',
                   'params'=>array(':lot'=>$this->lot),
                   'order' => 't.id ASC',
                   'limit'=>1,
                ));

            if($this->model===null){
                $this->message = 'У этого лота нет заданий';
            }
            else {
                
                switch($this->model->status)
                {
                    case 0:
                    case 1:$this->message = 'Лот не активен'; break;
                    case 3:$this->message = 'Лот завершился'; break;
                }
                if(empty($this->message)){
                    
                    $user = TaskUser::model()->find(
                            'id_task=:task AND id_user=:user',
                            array(':task'=>$this->model->id, ':user'=>1)        ////заменить на Yii::app()->user->id!!!!
                            );
                    if($user!==null)
                    {
                        $votes = unserialize(stripslashes($user->votes));
                        foreach($votes as $k=>$e){
                            $v[] = $e['sort'];
                        }
                        foreach($this->model->quest as $k=>$v){
                            $q[] = $v->id;
                        }
                        $raz = array_diff($q, $v);
                        $this->key = $raz[0];
                    }
                    
                    //unset($this->model->quest);
                    $this->question = $this->model->quest[$this->key];
                    unset($this->model->quest);
                }
            }             
        }
        else {
            
            $this->message = 'Чтобы принять участие неообходимо зарегистрироваться';
            
            
        }
        
    }
    
    public function run()
    {
        if(!Yii::app()->user->isGuest){
            Yii::app()->getClientScript()->registerCoreScript('jquery');
            if($this->model->type==1){
                $this->render('QuizTaskWidget', array(
                    'message'=>$this->message,
                    'model'=>$this->model,
                    'key'=>$this->key,
                    'lot'=>$this->lot,
                    'quest'=>$this->question,
                    )
                );
            }
        }
    }

}
?>
