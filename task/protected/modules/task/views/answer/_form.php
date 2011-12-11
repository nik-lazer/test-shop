<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'answer-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'is_answer'); ?>
		<?php echo $form->dropDownList($model,
                        'is_answer',
                         array('Нет', 'Да')
                );
                ?>
	</div>
        <?
            echo $form->hiddenField($model, 'quest_id');
        ?>
        <? if(isset($crea)):?>
            <div class="row buttons">
                    <?php echo CHtml::ajaxSubmitButton(
                            'Создать',
                            $this->createUrl('/task/answer/create'),
                            array(
                                'type'=>'POST',
                                'update'=>'#itemsDynamicPage',
                            )
                            ); ?>
            </div>
        <? else: ?>
            <div class="row buttons">
                <? echo CHtml::submitButton('Обновить')?>
            </div>    
        <? endif;?>
<?php $this->endWidget(); ?>
</div>