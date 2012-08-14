<?php
//print_r($data);
$this->widget('CTreeView', array(
        'url'=>CHtml::normalizeUrl(array('tree/data')),
        'htmlOptions'=>array('class'=>'treeview-black'),
    )
);

