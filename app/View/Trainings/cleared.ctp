<?php
	$this->set('indexAction','cleared');
?>
<div class="col-md-2">
	<?=	$this->element('training/time_menue');?>
</div>
<div class="col-md-9">
<div class="panel panel-default">
	
<div class="panel-heading">
   <h1><?=$months[$month] ?> <?=$year ?></h1><br>
  </div>
<div class="panel-body">
	<?php
	if(!empty($archive)){ 
		echo $this->element('training/archive_table');
	}
	else{
		echo '<p align="center"><h2>Bisher wurden noch keine Datensätze bearbeitet.<h2></p>';
	}
	?>
</div>
</div></div>