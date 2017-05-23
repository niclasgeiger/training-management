<div class="col-md-9">
	<?php if((($output=$this -> Session -> flash())!="")):
	?>
	<div class="alert alert-info">
		<?=$output ?>
	</div>
	<?php endif; ?>
	<?php
	if (!empty($unpaid)) {
		echo $this -> element('training/payment_table');
	} else {
		echo '<p align="center"><h2>Alle freigegebenen Übungstunden wurden soweit bearbeitet.<h2></p>';
	}
	?>
</div>
