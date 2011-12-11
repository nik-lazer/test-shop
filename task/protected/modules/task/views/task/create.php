<?php
$this->breadcrumbs=array(
	'Задания'=>array('index'),
	'Добавление',
);

$this->menu=array(
	array('label'=>'Список заданий', 'url'=>array('index')),
);
?>

<h1>Добавление задания</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>