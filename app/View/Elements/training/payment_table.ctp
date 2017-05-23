<?php
	$month = $unpaid[0][0]['month'];
	$year = $unpaid[0][0]['year'];
?>
<h3><?=$months[$month] ?> <?=$year ?></h3>
	<div class="table-responsive">
	<table class="table table-hover">
		<tr>
			<th>Übungsleiter</th>
			<th>Minuten</th>
			<th>Entgelt</th>
			<th>Einheiten</th>
			<th>abrechnen</th>
			<th>Details</th>
		</tr>
<?php
 	foreach($unpaid as $unpay):
		//komische Arraybelegung
		
		
		
		if($unpay[0]['month']!= $month || $unpay[0]['year']!= $year):
			$year = $unpay[0]['year'];
			$month = $unpay[0]['month'];?>
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
					<th>abrechnen</th>
					<th>Details</th>
				</tr>
	<?php endif; ?>
	
	
	<tr>
		<td><?=$unpay['U']['name'] .' '. $unpay['U']['surname'] ?></td>
		<td><?=$unpay[0]['duration'] ?></td>
		<td><?=round($unpay[0]['compensation'],2) ?> €</td>
		<td><?=$unpay[0]['count'] ?></td>
		<td><?=$this->Html->link('als abgerechnet markieren',array('action' => 'pay', $unpay[0]['month'], $unpay[0]['year'],$unpay['U']['user_id']),array('class' => 'btn btn-success'))?></td>
		<td><?=$this -> Html -> link('Details', array('action' => 'details', $unpay[0]['month'], $unpay[0]['year'], $unpay['U']['user_id']), array('class' => 'btn btn-default')) ?></td>	
	</tr>
	


</div>
<?php endforeach; ?>
	
</table>
