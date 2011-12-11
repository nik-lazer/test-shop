<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'template'=>'{summary} {pager} {items} {pager}',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                'id',
                array(
                    'name'=>'time_create',
                    'type'=>'raw',
                    'value'=>'date(Task::maskDateFormat,$data->time_create)',
                ),
		'lot_id',
                array(
                    'name'=>'type',
                    'type'=>'raw',
                    'value'=>'Task::getTaskType($data->type)'
                ),
		array(
                    'name'=>'status',
                    'type'=>'raw',
                    'value'=>'Task::getTaskStatus($data->status)'
                ),
                array(
                    'name'=>'time_start',
                    'type'=>'raw',
                    'value'=>'$data->time_start!=0?  date("d/m/Y H:i:s",$data->time_start): "-"'
                ),
		'count_users',
		'count_end_users',
                array(
                    'header'=>'Действия',
                    'class'=>'CButtonColumn',
                    'template'=>'{update} {delete}'
                  
                )
               ),
        ));

?>
