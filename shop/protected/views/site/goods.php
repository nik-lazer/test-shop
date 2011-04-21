<?php $this->pageTitle=Yii::app()->name; ?>

<?php if ($model): ?>
<a href="/<?php if($model['parent_id']): ?>site/index/pid/<?php echo $model['parent_id']; ?>/<?php endif; ?>">Вверх</a>
<?php endif; ?>

<?php if ($rows): ?>
<table>
	<thead>
		<th></th>
		<th>Код</th>
		<th>Название</th>
	</thead>
	<tbody>
	<?php foreach($rows as $row): ?>
		<tr>
		<td>
		<a href="/site/good/code/<?php echo $row['code']; ?>/">Редактировать</a>
		</td>
		<td><?php echo $row['code']; ?></td>
		<td><?php echo $row['name']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php  endif; ?>