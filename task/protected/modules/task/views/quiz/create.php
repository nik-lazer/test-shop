<?php
$this->breadcrumbs=array(
	'Вопросы викторины'=>array('index'),
	'Новый вопрос',
);

$this->menu=array(
	array('label'=>'Список вопросов', 'url'=>array('index')),
);
?>

<h1>Создание вопроса викторины</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>