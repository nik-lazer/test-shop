<div id="task">
    <? if(!empty($message)): ?>
        <div id="tasl_error">
            <? echo $message;?>
        </div>
    <? else: ?>
        <? echo CHtml::beginForm(
                '/task/quiz/votes',
                'POST',
                array(
                    'name'=>'task-form'   
                ));?>
        <div id="question">
            <? echo $quest->name; ?>
        </div>
        <br />
        <? foreach($quest->ans as $k=>$v): ?>
           <? echo Chtml::radioButton('user_answer',false,array('value'=>$v->id)).' '.$v->value; ?><br />
        <? endforeach; ?>
        <br />
        <? echo CHtml::hiddenField('task_id', $model->id);?>
        <? echo CHtml::hiddenField('lot', $lot);?>
        <? echo CHtml::hiddenField('question_id', $quest->id);?>
        <? echo CHtml::ajaxSubmitButton(
                'Далее',
                Yii::app()->createUrl('/task/quiz/votes'),
                array(
                    'type'=>'POST',
                    'update'=>'#task',
                ),
                array(
                    'type'=>'submit',
                    'disabled'=>1,
                    'id'=>'btnTask',
                )
            );?>
        <? echo CHtml::endForm();?>
    <? endif; ?>
</div>
   