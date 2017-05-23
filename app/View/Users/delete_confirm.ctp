<div class="col-md-4 col-md-offset-3">
    <div class="panel panel-primary">
        <div class=" panel-heading">
            <h4>Löschen bestätigen</h4>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <p>Wirklich folgenden Nutzer löschen?</p>
                <table>
                    <tr>
                        <th>Nutzername</th>
                        <th>Vorname</th>
                        <th>Nachname</th>
                    </tr>
                    <tr>
                        <td><?= $user['username']?></td>
                        <td><?= $user['name']?></td>
                        <td><?= $user['surname']?></td>
                    </tr>
                </table>
            </div>
            <div class="form-group">
                <?=$this -> Form -> link('Löschen', array( 'action' => 'delete', $user['id']),array('class' => 'btn btn-danger')); ?>
                <?=$this -> Html -> link("Abbrechen", array( 'action' => 'overview'), array('class' => 'btn btn-default')); ?>
            </div>

        </div>
    </div>
</div>
