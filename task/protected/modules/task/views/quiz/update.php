<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список вопросов', 'url'=>array('index')),
	array('label'=>'Варианты ответов на "'.$model->name.'"', 'url'=>array('/task/answer/index', 'quest'=>$model->id)),
);
?>

<h1>Редактирование "<?php echo $model->name; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>