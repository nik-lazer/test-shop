<?php $this->pageTitle=Yii::app()->name; ?>

<?php if ($model): ?>
<a href="/<?php if($model['parent_id']): ?>site/index/pid/<?php echo $model['parent_id']; ?>/<?php endif; ?>">Вверх</a>
<?php endif; ?>

<?php if ($rows): ?>
<table>
	<thead>
		<th></th>
		<th></th>
		<th>Название</th>
	</thead>
	<tbody>
	<?php foreach($rows as $row): ?>
		<tr>
		<td><a href="/site/index/pid/<?php echo $row['id']; ?>/"><?php echo ($row['child_count']?'Подгруппы':'Товары'); ?></a></td>
		<td>
		<?php if (!$row['child_count']): ?>
		<a href="/facet/list/rubric/<?php echo $row['id']; ?>/">Фасеты</a>
		<?php endif; ?>
		</td>
		<td><?php echo $row['name']; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php  endif; ?>