<div class="col-md-4 col-md-offset-3">
	<div class="panel panel-primary">
		<div class=" panel-heading">
			<h4>Nutzer bearbeiten</h4>
		</div>
		<div class="panel-body">
			<?=$this -> Form -> create('User', array('role' => 'form', 'class' => 'form')) ?>

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Nutzername</span>
					<div class="form-control">
						<?=$this -> Form -> input('username', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Vorname</span>
					<div class="form-control">
						<?=$this -> Form -> input('name', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Nachname</span>
					<div class="form-control">
						<?=$this -> Form -> input('surname', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Passwort</span>
					<div class="form-control">
						<?=$this -> Form -> input('password', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Stundensatz</span>
					<div class="form-control">
						<?=$this -> Form -> input('wage', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">email-Adresse</span>
					<div class="form-control">
						<?=$this -> Form -> input('email', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>

			<div class="form-group">
				<?=$this -> Form -> button('Änderungen speichern', array('class' => 'btn btn-primary')) ?>
				<?=$this -> Html -> link("Abbrechen", array('action' => 'overview'), array('class' => 'btn btn-default')); ?>
				<?=$this -> Form -> end() ?>
			</div>
		</div>
	</div>
</div>
