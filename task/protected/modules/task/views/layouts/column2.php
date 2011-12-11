<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
        <div id="sidebar">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Операции',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
                                    array('label'=>'Задания', 'url'=>array('/task/task/index')),
                                    array('label'=>'Вопросы викторины', 'url'=>array('/task/quiz/index')),
                                    array('label'=>'Вопросы памяти', 'url'=>array('/task/memory/index')),
                                    array('label'=>'Вопросы логики', 'url'=>array('/task/logic/index')),
                                    array('label'=>'Вопросы сообразительности', 'url'=>array('/task/ingenuity/index')),
                                ),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
                        
                        $this->beginWidget('zii.widgets.CPortlet');
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations_task'),
			));
			$this->endWidget();
		?>
	</div>
	<div>
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	
</div>
<?php $this->endContent(); ?>