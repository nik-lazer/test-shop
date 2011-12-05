<?php
$this->breadcrumbs=array(
	'Polls'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список опросов', 'url'=>array('index')),
	array('label'=>'Создать опрос', 'url'=>array('create')),
);
?>

<h1>Update Polls <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>