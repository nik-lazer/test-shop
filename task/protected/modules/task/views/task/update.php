<?php
$this->breadcrumbs=array(
	'Задания'=>array('index'),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список заданий', 'url'=>array('index')),
	array('label'=>'Создать задание', 'url'=>array('create')),
);
?>

<h1>Редактирование задания <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>