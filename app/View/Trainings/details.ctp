<div clasS="col-md-2">
<a href="javascript:history.back();" class="btn btn-default"><span class=".glyphicon .glyphicon-chevron-left"></span>zurück</a>
</div>
<div class="col-md-9">
	<h2>Übersicht der eingetragenen Übungsstunden</h2>
	<h3>ÜL <?=$user?> am <?=$month?> <?=$year ?></h3>
	<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<th>eingetragen am</th>
				<th>Datum</th>
				<th>Anfangszeit</th>
				<th>Dauer</th>
				<th>Entgelt</th>
			</tr>
	<?php foreach($trainings as $training):?>
			<?php
			if ($training['Training']['paid']) {
				echo '<tr class="success">';
			} elseif ($training['Training']['cleared']) {
				echo '<tr class="warning">';
			}	 else {
				echo '<tr class="active">';
			}?>
				<td><?=$this -> Time -> format('d.m.Y (H:i)',$training['Training']['created']); ?></td>
				<td><?=$this -> Time -> format('d.m.Y', $training['Training']['date']); ?></td>
				<td><?=$this -> Time -> format('H:i', $training['Training']['time']); ?></td>
				<td><?=$training['Training']['duration'] ?> min</td>
				<td><?=round($training['Training']['compensation'], 2); ?> €</td>
			</tr>
	<?php endforeach;?>
		</table>
	</div>
</div>

<div class="col-md-9 col-md-offset-2">
	<div class="table-responsive">
<table class="table table-hover">
	<tr>
		<td><b>Legende:</b></td>
		<td><?=$this->Html->image('awaiting_legend.png')?> = wartet auf Freigabe</td>
		<td><?=$this->Html->image('cleared_legend.png')?> = wartet auf Überweisung</td>
		<td><?=$this->Html->image('paid_legend.png')?> = abgerechnet und überwiesen</td>
	</tr>
</table>
</div>
