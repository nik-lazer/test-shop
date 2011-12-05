<?php
Yii::import('polls.models.*');

class PollsWidget extends CWidget
{
    public $registerView = false;
    public $visible = true;
    public $showStatistic = true;


    protected $model;
    
    public function init()
    {    
        
        if(($this->registerView && !Yii::app()->user->isGuest() && $this->visible) || (!$this->registerView && $this->visible) )
        {   
            if(!Yii::app()->user->isGuest){
                $this->model = Polls::model()
                        ->published()
                        ->with(array('variable', 'votes'=>array(
                                    'condition'=>'id_user=:id_user',
                                   'params'=>array(':id_user'=>Yii::app()->user->id),
                                   'limit'=>1
                               )))
                        ->find();
            }
            else {
                $this->model = Polls::model()->published()->with('variable')->find();
            }
            
        }
    }
    
    public function run()
    {
        if(empty($this->model)){
            $this->render('');
        }
        else {
            $this->render('PollsWidget', array('model'=>$this->model));
        }
        
    }
}
?>
