<div class="polls_widget" id="polls_widget">
<?php echo CHtml::beginForm();?>
<table class="polls_widget">
<tr>
    <td><?php echo $model->name;?></td>
</tr>
<?php foreach($model->variable as $item): ?>
<tr>
    <td><?php echo CHtml::radioButton('pollsvar', false, array('value'=>$item->id)), $item->name;?></td>
</tr>        
<?php endforeach; ?>
<tr>
    <td>
        <?php echo CHtml::hiddenField('pollsid', $model->id);?>
        <?php if(!Yii::app()->user->isGuest){
            echo '<span>Чтобы голосовать, Вы должны </span>'.CHtml::link('зарегистрироваться', Yii::app()->createUrl('/site/login'));
        } else {
            echo CHtml::ajaxSubmitButton('Голосовать',
                    array('/polls/polls/vote'),
                    array(
                        "type"=>"POST",
                        "dataType"=>"html",
			"replace"=>"#polls_widget",
                    )
            );
        } 
        ?>
    </td>
</tr>    
</table>

<?php echo CHtml::endForm();?>
</div>