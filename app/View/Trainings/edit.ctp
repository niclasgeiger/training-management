<div class="col-md-4 col-md-offset-3">
	<div class="panel panel-default">
		<div class=" panel-heading">
			<h4>Training bearbeiten</h4>
		</div>
		<div class="panel-body">

			<?=$this -> Form -> create('Training', array('role' => 'form', 'class' => 'form')) ?>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Datum</span>
					<div class="form-control">
						<?php
						echo $this -> Form -> input('date', array('label' => '', 'dateFormat' => 'DMY', 'minYear' => '2010', 'maxYear' => date('Y')));
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Anfangszeit</span>
					<div class="form-control">
						<?php
						echo $this -> Form -> input('time', array('label' => '', 'interval' => 5, 'timeFormat' => 24));
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Dauer in Minuten</span>
					<div class="form-control">
						<?=$this -> Form -> input('duration', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<?=$this -> Form -> button('Änderungen speichern', array('class' => 'btn btn-primary')) ?>
			<?=$this -> Html -> link("Abbrechen", array( 'action' => 'overview'), array('class' => 'btn btn-default')); ?>
			<?=$this -> Form -> end() ?>
		</div>
	</div>
</div>