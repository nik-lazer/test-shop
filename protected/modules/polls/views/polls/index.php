<?php
$this->breadcrumbs=array(
	'Polls',
);

$this->menu=array(
	array('label'=>'Создать опрос', 'url'=>array('create')),
);
?>

<h1>Опросы</h1>
<div id="itemsDynamicPage">
<? $this->renderPartial('itemsDynamicPage', array('model'=>$model));?>
</div>