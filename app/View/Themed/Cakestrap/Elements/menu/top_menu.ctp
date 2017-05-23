<?php
$role = CakeSession::read('role');
$user_id = CakeSession::read('user_id');
if(CakeSession::read('firstlogin')){
	unset($role);
}
?>
<nav class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button><!-- /.navbar-toggle -->
		<?php
		#TODO: verlinkung auf Startseite immer
		echo $this -> Html -> Link('TSV Verwaltung', '#', array('class' => 'navbar-brand'));
 ?>
	</div><!-- /.navbar-header -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
			<?php
			if (isset($role)) {
				switch($role) {
					case(0) :
						echo '<li>' . $this -> Html -> link('Übungsstunde eintragen', array('controller' => 'Trainings', 'action' => 'create')) . '</li>';
						echo '<li>' . $this -> Html -> link('Stundenübersicht', array('controller' => 'Trainings', 'action' => 'overview')) . '</li>';
						break;
					case(1) :
						echo '<li>' . $this -> Html -> link('freigegebene Übungsstunden', array('controller' => 'Trainings', 'action' => 'cleared')) . '</li>';
						echo '<li>' . $this -> Html -> link('Übungsstunden freigeben', array('controller' => 'Trainings', 'action' => 'clear')) . '</li>';
						break;
					case(2) :
						echo '<li>' . $this -> Html -> link('abgerechnete Übungsstunden', array('controller' => 'Trainings', 'action' => 'paid')) . '</li>';
						echo '<li>' . $this -> Html -> link('Übungsstunden abrechnen', array('controller' => 'Trainings', 'action' => 'pay')) . '</li>';
						break;
					case(3) :
						echo '<li>' . $this -> Html -> link('Neuen Nutzer anlegen', array('controller' => 'Users', 'action' => 'create')) . '</li>';
						echo '<li>' . $this -> Html -> link('Nutzer Übersicht', array('controller' => 'Users', 'action' => 'overview')) . '</li>';
						break;
				}
			}
			?>
		
			<li><?=($user_id!=null) ? $this -> Html -> link('Bedienungsanleitung', array('controller' => 'users', 'action' => 'guidance')) : '' ?></li>
			<li><?=($user_id!=null) ? $this -> Html -> link('Ausloggen', array('controller' => 'users', 'action' => 'logout')) : '' ?></li>
		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
</nav><!-- /.navbar navbar-default -->