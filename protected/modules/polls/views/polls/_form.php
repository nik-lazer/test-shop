<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'polls-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model,
                        'published',
                        array('0'=>'Не опубликованно','1'=>'Опубликованно',)
                        );
                ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'statistic_type'); ?>
		<?php echo $form->dropDownList($model,
                        'statistic_type',
                        array('0'=>'Голосовое','1'=>'Процентное',)
                        );
                ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->