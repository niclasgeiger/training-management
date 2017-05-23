<div class="panel">
	<div class="panel panel-default">
		<div class="panel-heading">	<h4>Gesamt</h4></div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th></th>
						<th>Minuten</th>
						<th>Entgelt</th>
						<th>Einheiten</th>
					</tr>
			<?php foreach($sum as $entry):?>	
					<tr>
						<td><b>gesamt:</b></td>
						<td><?=$entry[0]['duration'] ?></td>
						<td><?=round($entry[0]['compensation'], 2) ?> €</td>
						<td><?=$entry[0]['count'] ?></td>
					</tr>
		<?php endforeach; ?>
				</table>
			</div>	
		</div>	
	</div>	
</div>
<div class="panel">
	<div class="panel panel-default">
		<div class="panel-heading">	<h4>Einzelübersicht</h4></div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover">
					<tr>
						<th>Übungsleiter</th>
						<th>Minuten</th>
						<th>Entgelt</th>
						<th>Einheiten</th>
						<th>Datum</th>
						<th>Details</th>
					</tr>
<?php foreach($archive as $entry):?>	
					<tr>
						<td><?=$entry['User']['name'] . ' ' . $entry['User']['surname'] ?></td>
						<td><?=$entry[0]['duration'] ?></td>
						<td><?=round($entry[0]['compensation'], 2) ?> €</td>
						<td><?=$entry[0]['count'] ?></td>
						<td><?=$months[$entry[0]['month']] . ' ' . $entry[0]['year'] ?></td>
						<td><?=$this -> Html -> link('Details', array('action' => 'details', $entry[0]['month'], $entry[0]['year'], $entry['User']['id']), array('class' => 'btn btn-default')) ?></td>	
					</tr>
<?php endforeach; ?>
				</table>
			</div>	
		</div>
	</div>
</div>