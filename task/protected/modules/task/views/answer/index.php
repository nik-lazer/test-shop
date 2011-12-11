<?php
$this->breadcrumbs=array(
	'Ответы',
);

$this->menu=array(
	array('label'=>'Вернуться к списку вопросов', 'url'=>array('/task/quiz/index')),
);
?>

<h1>Ответы на вопрос<br />"<? echo $quest->name; ?>"</h1>

<div id="itemsDynamicPage">
<?php $this->renderPartial('itemsDynamicPage', array('dataProvider'=>$dataProvider));?>
</div>
<br />

<br />

<table>
<tr>
    <td>
        <h2>Добавить ответ</h2>
        <?php $this->renderPartial('_form', array('model'=>$model, 'crea'=>'1'));?>
    </td>
    <td>
        <div id="editItem" style="display:none;"></div>
    </td>
</tr>
</table>

