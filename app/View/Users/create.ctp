<div class="col-md-4 col-md-offset-3">
	<div class="panel panel-primary">
		<div class=" panel-heading">
			<h4>Neuen Nutzer anlegen</h4>
		</div>
		<div class="panel-body">
			<?=$this -> Form -> create('User', array('role' => 'form', 'class' => 'form')) ?>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Nutzername*</span>
					<div class="form-control">
						<?=$this -> Form -> input('username', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Vorname*</span>
					<div class="form-control">
						<?=$this -> Form -> input('name', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Nachname*</span>
					<div class="form-control">
						<?=$this -> Form -> input('surname', array('label' => '', 'class' => 'form-control')); ?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Passwort*</span>
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
				<div class="input-group">
					<span class="input-group-addon">Aufgabe*</span>
					<div class="btn-group-vertical" data-toggle="buttons">
						<label class="btn btn-default">
							<input type="radio" name="User[role]" id="trainer" value="0" >
							Übungsleiter </label>
						<label class="btn btn-default">
							<input type="radio" name="User[role]" id="finance" value="1" >
							Abteilungsleiter</label>
						<label class="btn btn-default">
							<input type="radio" name="User[role]" id="executive" value="2">
							Kassenwart </label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Abteilung</span>
					<div class="form-control">
						<select name="User[department_id]">
							<?php
							foreach ($departments as $department) {
								echo '<option value="' . $department['Department']['id'] . '"';
								echo '>' . $department['Department']['name'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="form-control">
						<small>* = Pflichtfelder</small>
					</div>
				</div>
			</div>
			<div class="form-group">
				<?=$this -> Form -> button('Nutzer anlegen', array('class' => 'btn btn-primary')) ?>
				<?=$this -> Html -> link("Abbrechen", array( 'action' => 'overview'), array('class' => 'btn btn-default')); ?>
				<?=$this -> Form -> end() ?>
			</div>

		</div>
	</div>
</div>
