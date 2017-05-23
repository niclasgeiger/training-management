<?php
$this -> set('indexAction', 'overview');
$sum = $sum[0][0];
?>
<div class="col-md-7 col-md-offset-5">
   <h1><?=$months[$month] ?> <?=$year ?></h1>
</div>

<div class="col-md-2">
	<?=	$this -> element('training/time_menue'); ?>
</div>
<?php if(!empty($trainings)):?>
<div class="col-md-7 col-md-offset-1"><br><br>
	
<?php if((($output=$this -> Session -> flash())!="")): ?>
	<div class="alert alert-info">
		<?=$output?>
	</div>
<?php endif; ?>
<div class="row-fluid">
	<div class="form-group col-md-4">
		<div class=" input-group">
			<span class="input-group-addon">Entgelt:</span><p class="form-control"><?=round($sum['sum_comp'], 2) ?> €</p>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class=" input-group">
			<span class="input-group-addon">Dauer:</span><p class="form-control"><?=(($sum['sum_dur']-$sum['sum_dur']%60)/60).' h '.($sum['sum_dur']%60).' min' ?></p>
		</div>
	</div>
	<div class="form-group col-md-4">
		<div class=" input-group">
			<span class="input-group-addon">Einheiten:</span><p class="form-control"><?=$sum['count'] ?></p>
		</div>
	</div>
</div>			
	
	
	
</div>
 
<div class="col-md-9 col-md-offset-2">
	<?=$this -> element('training/training_table') ?>
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
</div>
<?php endif; ?>



