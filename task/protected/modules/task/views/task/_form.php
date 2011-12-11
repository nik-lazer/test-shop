<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,
                        'type',
                         Task::$task_type
                );
                ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'lot_id'); ?>
		<?php echo $form->textField($model,'lot_id'); ?>
		<?php echo $form->error($model,'lot_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proportion'); ?>
		<?php echo $form->textField($model,'proportion',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'proportion'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->