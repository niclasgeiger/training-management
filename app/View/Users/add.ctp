<div class="users form">
	<?=$this->Form->create('User');?>
	<fieldset>
		<legend><?=__('Nutzer hinzufügen');?></legend>
		<?php
			
			echo $this->Form->input('username');
			echo $this->Form->input('name');
			echo $this->Form->input('surname');
			
			echo $this->Form->input('password');
			echo $this->Form->input('email');
			echo $this->Form->input('wage');
			$options = array();
			foreach($departments as $department){
				$options[$department['Department']['id']] = $department['Department']['name'];
			}
			echo $this->Form->input('department_id', array('options'=>$options));
			echo $this->Form->input('role', array('options'=>array('0'=>'Übungsleiter', '1'=>'Kassenwart', '2'=>'Abteilungsleiter')));
		?>
	</fieldset>
	<?=$this->Form->end(__('Erstellen'));?>
	
</div>
