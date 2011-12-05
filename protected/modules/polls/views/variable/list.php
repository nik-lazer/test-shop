<h1>Варианты ответов для <br>"<?php echo $title; ?>"</h1>
<div id="itemsDynamicPage">
<?php $this->renderPartial('itemsDynamicPage', array('dataProvider'=>$dataProvider)) ?>
</div>
<h2>Новый ответ</h2>
<div class="form">
<?php $this->renderPartial('_form', array('model'=>$model)) ?>
</div>