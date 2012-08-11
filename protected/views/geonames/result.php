<h3><?php echo count($list); ?></h3>
<table>
<?php foreach ($list as $row): ?>
	<?php if (is_array($row)): ?>
	<tr>
		<td><?php echo $row['geonameId']; ?></td>
		<td><?php echo $row['name']; ?></td>
	</tr>
	<?php else: ?>
	<tr>
		<td><?php echo $row->id; ?></td>
		<td><?php echo $row->name; ?></td>
	</tr>
	<?php endif; ?>
<?php endforeach;; ?>
</table>