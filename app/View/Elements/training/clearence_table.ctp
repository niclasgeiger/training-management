<?php
$month = $uncleared[0][0]['month'];
$year = $uncleared[0][0]['year'];
?>
<h3><?=$months[$month] ?> <?=$year ?></h3>
	<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>Übungsleiter</th>
			<th>Minuten</th>
			<th>Entgelt</th>
			<th>Einheiten</th>
			<th>freigeben</th>
			<th>Details</th>
		</tr>
		
<?php

	
 	foreach($uncleared as $unclear):
		if($unclear[0]['month']!= $month || $unclear[0]['year']!= $year):
			$year = $unclear[0]['year'];
			$month = $unclear[0]['month'];?>
	</table>
		</div>
			<h3><?=$months[$month] ?> <?=$year ?></h3>
			<div class="table-responsive">
			<table class="table table-hover">
				<tr>
					<th>Übungsleiter</th>
					<th>Minuten</th>
					<th>Entgelt</th>
					<th>Einheiten</th>
					<th>freigeben</th>
					<th>Details</th>
				</tr>

	<?php endif; ?>
	
	
	<tr>
		<td><?=$unclear['U']['name'] . ' ' . $unclear['U']['surname'] ?></td>
		<td><?=$unclear[0]['duration'] ?></td>
		<td><?=round($unclear[0]['compensation'], 2) ?> €</td>
		<td><?=$unclear[0]['count'] ?></td>
		<td><?=$this -> Html -> link('freigeben', array('action' => 'clear', $unclear[0]['month'], $unclear[0]['year'], $unclear['U']['user_id']), array('class' => 'btn btn-success')) ?></td>
		<td><?=$this -> Html -> link('Details', array('action' => 'details', $unclear[0]['month'], $unclear[0]['year'], $unclear['U']['user_id']), array('class' => 'btn btn-default')) ?></td>	
	</tr>
</div>
<?php endforeach; ?>
	
</table>

