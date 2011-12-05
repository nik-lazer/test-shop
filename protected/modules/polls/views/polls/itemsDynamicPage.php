<?php 
//"replace"=>"#linkId".$data->id,
    $this->widget('zii.widgets.grid.CGridView', array(
	'template'=>'{summary} {pager} {items} {pager}',
	'dataProvider'=>$model->search(),
	'columns'=>array(
                'name',
                array(
                    'name'=>'published',
                    'type'=>'raw',
                    'value'=>'CHtml::ajaxLink(
				$data->published?
					CHtml::image(Yii::app()->request->baseUrl."/images/icons/Knob Valid Green.png")
				: 
					CHtml::image(Yii::app()->request->baseUrl."/images/icons/Knob Cancel.png")
				,
				array("/polls/polls/published", "id"=>$data->id),
				array(
					"type"=>"POST",
					"dataType"=>"html",
					"update"=>"#itemsDynamicPage",
				),
				array(
					"title"=>$data->published? Yii::t("global","Опубликовано"):Yii::t("global","Не опубликовано"),
                                        "id"=>"linkId".$data->id,
				)
                    )',
                    'htmlOptions'=>array('class'=>'published'),
                ),
                array( 
                    'header' => 'Ответы',
                    'visible'=>true,
                    'class'=>'CButtonColumn',
                    'template' => '{variablelist}',
                    'buttons'=>array(
                        'variablelist'=>array(
                            'label'=>'Список ответов',
                            'url'=>'Yii::app()->createUrl("/polls/variable/list", array("parent"=>$data->id))',
                            'imageUrl'=>Yii::app()->request->baseUrl."/images/icons/paper_content_48.png",
                        ),
                    )
                ),
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
