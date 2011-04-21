<h3>Фасеты для рубрики <?php echo $rubric['name']; ?></h3>
<a href="/facet/add/rubric/<?php echo $rubric["id"]; ?>/">Добавить</a>
<?php if ($rows): ?>
<table>
<thead>
	<th></th>
	<th></th>
	<th>Название</th>
	<th>Единица измерения</th>
</thead>
<tbody>
<?php foreach ($rows as $row): ?>
<tr>
	<td><a href="/facet/edit/id/<?php echo $row["id"]; ?>/">Редактировать</a></td>
	<td><a href="/facet/delete/id/<?php echo $row["id"]; ?>/">Удалить</a></td>
	<td><?php echo $row["name"]; ?></td>
	<td><?php echo $row["unit"]; ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>