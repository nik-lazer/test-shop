<?php
Yii::import('task.models.*');
//Yii::import('task.controllers.*');

class TaskWidget extends CWidget
{
    //id лота
    public $lot=2;
    
    //Если виджет надо обновить ajax'ом, то передать надо только $user=>TaskUser
    //Модель пользователя с учетом задания 
    public $user;
    
    private $model;
    private $question;
    private $message;
    private $key=0;
   // private $statistic = false;
    private $statistic_message;


    public function init()
    {    
        if(!Yii::app()->user->isGuest){
            
            $id_user = 1; ////заменить на Yii::app()->user->id!!!!
            //Получаем нужное задание и все вопросы с вариантам ответов...(нужно кешировать!)
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
                //Если лот еще неактивен
                switch($this->model->status)
                {
                    case 0:
                    case 1:$this->message = 'Лот не активен'; break;
                    case 3:$this->message = 'Лот завершился'; break;
                }
                //А вот если активен, то погнали...
                if(empty($this->message)){
                    //Узнаем, наш юзер уже проходил задание или нет..
                    $user = empty($this->user)?
                            TaskUser::model()->find(
                                'id_task=:task AND id_user=:user',
                                array(':task'=>$this->model->id, ':user'=>$id_user)        
                            )
                            :
                            $this->user;
                    //Если да, то разбираем его ответы и узнаем id вопроса на который он не отвечал
                    //Если он ответил на все, выводим статистику)))
                    if($user!==null && !empty($user->votes))
                    {
                        $votes = unserialize(stripslashes($user->votes));
                        //Создаем два массива для хранения пользовательских id вопросов, id ответов
                        foreach($votes as $k=>$e){
                            $user_quest[] = $e['id'];
                            $user_answer[] = $e['answer'];
                        }
                        //Создаем массив с id всех вопросов, и массив с id всех правильных ответов
                        foreach($this->model->quest as $k=>$v1){
                            $model_quest[] = $v1->id;
                            foreach($v1->ans as $l=>$a){
                                if($a->is_answer){
                                    $model_answer[]=$a->id;
                                }
                            }
                        }
                        //Вычитаем по ключю из всех вопросов все вопросы на которые ответил пользователь
                        $raz = array_diff_key($model_quest, $user_quest);
                        //Узнаем следющий вопрос, или
                        if(!empty($raz)) {
                            foreach($raz as $k=>$v){
                                $this->key = $k;
                                break;
                            }
                        }
                        //Выводим статистику
                        else {
                            if(empty($user->time_end)){
                                $user->time_end = time()-$user->time_start;
                                $user->save(false);
                            }
                            $this->createStatistic($user_answer, $model_answer, $user->time_end);
                        }
                            
                    }
                    //Если user уже есть в базе к заданию, но не ответил ни на один вопрос, обновляем ему время старта.  
                    elseif($user!==null && empty($user->votes)) {
                        $user->time_start = time();
                        $user->save(false);
                        
                    }
                    //Если нету, то создаем
                    else {
                        $user = new TaskUser;
                        $user->time_start = time();
                        $user->id_user = $id_user;
                        $user->id_task = $this->model->id;
                        $user->save(false);
                    }
                    
                    $this->question = $this->model->quest[$this->key];
                }
            }             
        } 
        else 
        {
            $this->message = 'Чтобы принять участие неообходимо авторизироваться';   
        }
       
        
    }
    
    public function run()
    {
        Yii::app()->getClientScript()->registerCoreScript('jquery');
        if(empty($this->message)){
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
        else {
            $this->render('MessageTaskWidget', array('message'=>$this->message));
        }
    }

    
    private function createStatistic($user_answer, $model_answer, $time_end)
    {
        //$this->statistic=true;
        $count_quest = sizeof($this->model->quest);
        $correct = 0;
        foreach($user_answer as $k=>$v){
            if($v == $model_answer[$k])
            {
                $correct++;
            }    
        }
        $this->message = 'Вы ответили правильно на '.$correct.' вопроса из '.$count_quest.'
            <br>Потрачено времени '.date('H:i:s', $time_end);
    }
    
}
?>
