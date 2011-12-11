<?php
$js_func = <<<EOD
function() {
    var url = $(this).attr('href');
    $.get(url, function(data) {
        
        $('#editItem').slideUp('slow', function() {
            $('#editItem').html('');
            $('#editItem').append(data);
            $('#editItem').slideDown('slow');
        });
    });
    return false;
}
EOD;

    $this->widget('zii.widgets.grid.CGridView', array(
	'template'=>'{summary} {pager} {items} {pager}',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                'value',
                array(
                    'name'=>'is_answer',
                    'type'=>'raw',
                    'value'=>'$data->is_answer?"Да":"Нет"'
                ),
                array(
                    'header'=>'Действия',
                    'class'=>'CButtonColumn',
                    'template'=>'{update} {delete}',
                    'buttons'=>array(
                        'update'=>array(
                            'url'=>'Yii::app()->createUrl("/task/answer/update", array("id"=>$data->id))',
                            'click'=>$js_func,
                        )
                    )
               )
        ),
    ));
?>
