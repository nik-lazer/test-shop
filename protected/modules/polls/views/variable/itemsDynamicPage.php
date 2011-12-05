<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'variable-grid',
	'template'=>'{summary} {pager}<br>{items} {pager}',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
                'name',
                'sort',
                array( 
                    'header' => 'Действия',
                    'visible'=>true,
                    'class'=>'CButtonColumn',
                    'template' => '{update}&nbsp;&nbsp;{delete}',
                    'buttons'=>array(
                        'update'=>array(
                            'imageUrl'=>Yii::app()->request->baseUrl."/images/icons/pencil_48.png",
                        ),
                        'delete'=>array(
                            'imageUrl'=>Yii::app()->request->baseUrl."/images/icons/cross_48.png",
                        ),
                    )
                ),
	),
        ));
?>
