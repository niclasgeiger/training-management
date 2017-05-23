<?php

class Training extends AppModel {
	#TODO: Formatierungen ändern -> DATUM!!
	public $belongsTo = 'User';
	public $validate = array(
		'duration'=>array(
			'rule'=>'numeric',
			'message'=>'Bitte geben Sie die Dauer in Minuten ein.',
			'allowEmpty'=>'false'		
		)
	
	);
	
	
	
	#TODO: make it work!
	public function getEditOptions() {
		$user = AuthComponent::user();
		$role = $user['role'];
		if ($role == 0) {
			$options = array();
			$options['edit'] = array('name' => 'Bearbeiten', 'direction' => array('controller' => 'Trainings', 'action' => 'edit'), 'options' => array('class' => 'btn btn-warning'));
			$options['delete'] = array('name' => 'Löschen', 'direction' => array('controller' => 'Trainings', 'controller' => 'delete'), 'options' => array('class' => 'btn btn-danger'));
			return $options;
		}
		return array();
	}
	#TODO: get this to work!
	public function getAllTrainingDates(){
		$user = AuthComponent::user();
		$id = $user['id'];
		$dates=$this->Trainings->find('all',array(
			'user_id'=>$user['id'],
			'fields'=>'DISTINCT MONTH(date),YEAR(date)'
		));
		return $dates;
	}
	/*public function save($data = null, $validate = true, $fieldList = array()) {
	 	$this->set($data);
		$user_id = CakeSession::read('user_id');
	 	$this->set('user_id',$user_id);
		$department_id = CakeSession::read('department_id');
	 	$this->set('department_id',$department_id);
		debug($this->data);
	 	return parent::save($this->data, $validate, $fieldList);	
	}*/


}
?>