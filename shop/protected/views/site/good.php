<h3>Редактирование товара <?php echo $model->name; ?> (код <?php echo $model->code; ?>)</h3>
<?php if ($rows): ?>
<form action="/site/good/code/<?php echo $model->code; ?>/" method="post">
<table>
	<?php foreach ($rows as $row): ?>
	<tr>
		<td>
		<?php echo $row['name'].($row['unit']?', '.$row['unit']:''); ?>
		</td>
		<td>
		<input type="text" name="facets[<?php echo $row['id']; ?>]" value="<?php echo $row['val']; ?>">
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<div>
	<input type="submit" value="Сохранить">
	<input type="reset" value="Отменить">
</div>
</form>
<?php endif; ?>
