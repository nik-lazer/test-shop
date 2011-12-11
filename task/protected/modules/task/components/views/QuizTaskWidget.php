<div id="task">
    <? if(!empty($message)): ?>
        <div id="tasl_error">
            <? echo $message;?>
        </div>
    <? else: ?>
        <? echo CHtml::beginForm();?>
        <div id="question">
            <? echo $quest->name; ?>
        </div>
        <br />
        <? foreach($quest->ans as $k=>$v): ?>
           <? echo Chtml::radioButton('user_answer',false,array('value'=>$v->id)).' '.$v->value; ?><br />
        <? endforeach; ?>
        <br />
        <? echo CHtml::submitButton('Далее', array('disabled'=>1, 'id'=>'btnTask'))?>
        <? echo CHtml::endForm();?>
    <? endif; ?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('input[name="user_answer"]').change(function(){
           $('#btnTask').attr('disabled', false);
        });
        
    })
</script>    