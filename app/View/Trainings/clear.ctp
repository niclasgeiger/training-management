<div class="col-md-9">
	<?php if((($output=$this -> Session -> flash())!="")):
	?>
	<div class="alert alert-info">
		<?=$output ?>
	</div>
	<?php endif; ?>
	<?php
	if (!empty($uncleared)) {
		echo $this -> element('training/clearence_table');
	} else {
		echo '<p align="center"><h2>Alle eingetragenen Übungstunden wurden soweit bearbeitet.<h2></p>';
	}
	?>
</div>
