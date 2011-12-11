<?php
$this->breadcrumbs=array(
	'Задания',
);

$this->menu=array(
	array('label'=>'Добавить задание', 'url'=>array('create')),
);
?>

<h1>Задания</h1>

<?php $this->renderPartial('itemsDynamicPage', array('dataProvider'=>$dataProvider));?>
