<?php
# Cras justo odio<span class="badge">14</span> für Kassenwart/Abteilungsleiter
# TODO: alle Monate auswahl (jahr!)
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		Datum
	</div>
	<div class="panel-body">
		<div class="btn-group-vertical">
			<?php 
			if(!empty($dates)){
				$year=$dates[0][0]['year'];
				
				echo '<div class="btn-group">';
					#<button type="button" class="btn btn-default">';
				echo $this->Html->link($year,array('action'=>$indexAction,0,$year),array('class'=>'btn btn-default'));
				echo '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">';
				foreach($dates as $date){
					//komischer Index bei find()	
					$date = $date[0];
					//neues DropDown Menü pro neuem Jahr
					if($date['year']!=$year){
						echo 
						'</ul></div>
						<div class="btn-group">';
						echo $this->Html->link($date['year'],array('action'=>$indexAction,0,$date['year']),array('class'=>'btn btn-default'));;
						echo '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">';
					}
					$year = $date['year'];
					echo '<li>'.$this->Html->link($months[$date['month']],array('action'=>$indexAction,$date['month'],$date['year'])).'</li>';	
				}
				echo '</ul></div>';
			}
			else{
				echo "Keine Daten gefunden.";
			}
			?>
			</div>
	</div>
</div>

