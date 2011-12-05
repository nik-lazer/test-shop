<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'variable-form',
	'enableAjaxValidation'=>true,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	
        <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>
        <?php echo $form->hiddenField($model,'polls_id');?>
	<div class="row">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить');?>
	</div>

<?php $this->endWidget(); ?>