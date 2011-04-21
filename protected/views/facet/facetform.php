<div class="content">

<?php echo CHtml::beginForm('', 'post'); ?>

<?php echo CHtml::errorSummary($model); ?>
<?php echo CHtml::activeHiddenField($model, 'rubric_id'); ?>
<table>
<tr>
<td valign='top' align="left" class="form"><?php echo CHtml::activeLabelEx($model,'name'); ?>:</td>
<td><?php echo CHtml::activeTextField($model,'name',array('size'=>50, 'maxlength'=>512)); ?></td>
</tr>
<tr>
<td valign='top' align="left" class="form"><?php echo CHtml::activeLabelEx($model,'unit'); ?>:</td>
<td><?php echo CHtml::activeTextField($model,'unit',array('size'=>50, 'maxlength'=>100)); ?></td>
</tr>
</table>
<div class="action" align="right">
<?php echo CHtml::submitButton('Сохранить'); ?>
<?php echo CHtml::button('Отменить', array('onClick'=>'window.location="/facet/list/rubric/'.$model->rubric_id.'/"')) ?>
</div>
<?php echo CHtml::endForm(); ?>

</div><!-- content -->