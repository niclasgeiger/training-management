<?php if((($output=$this -> Session -> flash())!="")):
?>
<div class="alert alert-info">
	<?=$output ?>
</div>
<?php endif; ?>
<div class="row-fluid marketing">
	<div class="col-md-5 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2>Passwortänderung</h2>
			</div>
			<div class="panel-body">
				<ul class="list-group">
					<li class="list-group-item">
						<p>
							Herlich willkommen bei der neuen Übungsleiterverwaltung des TSV Bobingen!
						</p>
						<p>
							Bevor Sie anfangen können Ihre Abrechnungen zu erstellen, geben Sie bitte noch <?=($user['User']['email'] == "")?'Ihre email-Adresse und':''?> ein neues Passwort an.
						</p>
					</li>
					<li class="list-group-item">
						<fieldset>
							<?php
							echo $this -> Form -> create();
							if ($user['User']['email'] == "") {
								echo $this -> Form -> Input('email', array('label' => 'email-Adresse', 'div' => 'form-group', 'class' => 'form-control'));
							}
							echo $this -> Form -> Input('password', array('label' => 'Neues Passwort', 'div' => 'form-group', 'class' => 'form-control'));
							echo $this -> Form -> Input('password_confirm', array('type' => 'password', 'label' => 'Neues Passwort bestätigen', 'div' => 'form-group', 'class' => 'form-control'));
							?>
							<div class="col-md-3 col-md-offset-6">
								<?=$this -> Form -> button('Bestätigen', array('class' => 'btn btn-primary btn-lg')) ?>
							</div>
						</fieldset>
						<?=$this -> Form -> end() ?>
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>
