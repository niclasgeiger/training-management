<div class="table-responsive">
<table class="table table-hover">
	<tr>
		<th>Datum</th>
		<th>Anfangszeit</th>
		<th>Dauer</th>
		<th>Entgelt</th>
		<th>Bearbeiten</th>
		<th>Löschen</th>
	</tr>
	<?php foreach ($trainings as $training): ?>
	<?php
	if ($training['Training']['paid']) {
		echo '<tr class="success">';
	} elseif ($training['Training']['cleared']) {
		echo '<tr class="warning">';
	} else {
		echo '<tr class="active">';
	}
	?>
		<td><?=$this->Time->format('d.m.Y',$training['Training']['date']) ?></td>
		<td><?=$this->Time->format('H:i', $training['Training']['time']) ?></td>
		<td><?=$training['Training']['duration'] ?></td>
		<td><?=$training['Training']['compensation'] ?></td>
		<td><?=($training['Training']['cleared'])?'':$this->Html->link('Bearbeiten',array('action' => 'edit', $training['Training']['id']),array('class' => 'btn btn-warning'))?></td>
		<td><?=($training['Training']['cleared'])?'':$this->Html->link('Löschen',array('action' => 'delete', $training['Training']['id']),array('class' => 'btn btn-danger'))?></td>
	</tr>
	<?php endforeach; ?>
	
</table>
</div>