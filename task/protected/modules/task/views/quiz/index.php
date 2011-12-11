<?php
$this->breadcrumbs=array(
	'Вопросы викторины',
);

$this->menu=array(
	array('label'=>'Добавить вопрос', 'url'=>array('create')),
);
?>

<h1>Вопросы викторины</h1>
<?php $this->renderPartial('itemsDynamicPage', array('dataProvider'=>$dataProvider));?>
