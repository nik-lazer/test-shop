<?php
$this->breadcrumbs=array(
	'Опросы'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список опросов', 'url'=>array('index')),
	array('label'=>'Manage Polls', 'url'=>array('admin')),
);
?>

<h1>Create Polls</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>