<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'template'=>'{summary} {pager} {items} {pager}',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                'name',
                array(
                    'type'=>'raw',
                    'value'=>'CHtml::link("Список ответов", array("/task/answer/index", "quest"=>$data->id))',
                ),
                array(
                    'name'=>'complex',
                    'type'=>'raw',
                    'value'=>'Task::getComplex($data->complex)',
                    'htmlOptions'=>array('class'=>'complex')
                ),
                array(
                    'header'=>'Действия',
                    'class'=>'CButtonColumn',
                    'template'=>'{update} {delete}'
                )
               ),
        ));
?>
