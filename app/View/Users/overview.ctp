<?php if((($output=$this -> Session -> flash())!="")): ?>
	<div class="alert alert-info">
		<?=$output?>
	</div>
	
<?php endif; 
	?>
<?php foreach($departments as $department):?>
	<?php
		if(empty($department['User']))
			continue;
	?>
 	<div class="panel panel-primary">
		<div class="panel-heading">
			<?=$department['Department']['name'] ?>
		</div>
		<div class="panel">
	
<div class="table-responsive">
<table class="table table-hover">
	<tr>
		<th>Nachname</th>
		<th>Vorname</th>
		<th>Nutzername</th>
		<th>Stundensatz</th>
		<th>email-Adresse</th>
		<th>Aufgabe</th>
		<th>Bearbeiten</th>
        <th>Löschen</th>
	</tr>
	<?php foreach($department['User'] as $user):?>
	<tr>
		<td><?=$user['surname'] ?></td>
		<td><?=$user['name'] ?></td>
		<td><?=$user['username'] ?></td>
		<td><?=($user['wage']!=null)?$user['wage']:'-' ?></td>
		<td><?=$user['email'] ?></td>
		<td>
		<?php
			switch($user['role']) {
                case(0):
                    echo "Übungsleiter";
                    break;
                case(1):
                    echo "Abteilungsleiter";
                    break;
                case(2):
                    echo "Kassenwart";
                    break;
            }
		?>
		</td>
		<td><?=$this -> Html -> link('Bearbeiten', array('action' => 'edit',$user['id']), array('class' => 'btn btn-default')) ?></td>
        <td><?=$this -> Html -> link('Löschen', array('action' => 'delete_confirm',$user['id']), array('class' => 'btn btn-danger')) ?></td>

        <?php endforeach; ?>
	</tr>
	
</table>
</div>
</div>
</div>
<?php endforeach; ?>