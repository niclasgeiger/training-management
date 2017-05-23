<?php header('P3P: CP="CAO PSA OUR"');?>
<div class="col-md-3 col-md-offset-3">
	<?=$this -> Form -> create('', array('role' => 'form', 'class' => 'form-horizontal')); ?>
	<fieldset>
		<legend><?=__('Willkommen!') ?></legend>
	
	<?php if((($output=$this -> Session -> flash())!="")): ?>
	<div class="alert alert-info">
		<?=$output ?>
	</div>
	
<?php endif; ?>
		<?php
		echo $this -> Form -> Input('username', array('label' => 'Benutzername', 'div' => 'form-group', 'class' => 'form-control'));
		echo $this -> Form -> Input('password', array('label' => 'Passwort', 'div' => 'form-group', 'class' => 'form-control'));
		?>
		<div class="col-md-3 col-md-offset-6">
			<?=$this -> Form -> button('Einloggen', array('class' => 'btn btn-primary btn-lg')) ?>
		</div>
	</fieldset>
	<?=$this -> Form -> end() ?>	
</div>
<div class="col-md-3 col-md-offset-3">
    <div class="well well-small ">
        Probleme mit dem Login?
        <br>
        <a href="mailto:trainerverwaltung@tsvbobingen.de">Kontakt aufnehmen</a>
    </div>
</div>
