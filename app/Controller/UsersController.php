<?php
App::uses('AuthComponent', 'Controller/Component');

class UsersController extends AppController {
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('login');
		$this -> loadModel('Department');
		#$this->Auth->authenticate = array('Form');
	}

	public function login() {
		if ($this -> request -> is('post')) {
			#$this->request->data['password']= AuthComponent::password($this->request->data['password']);
			if ($this -> Auth -> login()) {
				$user = AuthComponent::user();
				CakeSession::write('user_id', $user['id']);
				CakeSession::write('department_id', $user['department_id']);
				CakeSession::write('role', $user['role']);
				if ($user['firstlogin']) {
					CakeSession::write('firstlogin', true);
					return $this -> redirect(array('action' => 'firstlogin'));
				}
				return $this -> redirect($this -> Auth -> loginRedirect);
			}
			$this -> Session -> setFlash(__('Ungültige Nutzername/Password-Kombination. Bitte versuchen Sie es noch einmal.'));
		}
	}

	public function logout() {
		CakeSession::delete('user_id');
		CakeSession::delete('department_id');
		CakeSession::delete('role');
		return $this -> redirect($this -> Auth -> logout());
	}

	public function firstlogin() {
		$user_id = CakeSession::read('user_id');
		$user = $this -> User -> findById($user_id);
		$this->set('user',$user);
		if ($this -> request -> is('post')) {
			$data = $this -> request -> data;
			$password = $data['User']['password'];
			$password_confirm = $data['User']['password_confirm'];
			//Passwörter nicht gleich
			if ($password != $password_confirm) {
				return $this -> Session -> setFlash('Die eingegebenen Passwörter stimmen nicht überein.');
			}

			unset($data['User']['password_confirm']);
			$data['User']['id'] = $user_id;
			$data['User']['firstlogin']=0;
			$data['User']['password']=AuthComponent::password($data['User']['password']);
			if ($this -> User -> save($data)) {
				CakeSession::delete('firstlogin');
				return $this->redirect(array('action'=>'index'));
			}
			return $this -> Session -> setFlash('Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Administrator unter "trainerverwaltung@tsv-bobingen.de".');
		}
	}
	public function guidance(){
		$role = CakeSession::read('role');
		$this->set('role',$role);
	}

	public function index($role = 0) {
		$role = CakeSession::read('role');
		switch($role) {
			//Trainer
			case(0) :
				return $this -> redirect(array('controller' => 'Trainings', 'action' => 'overview'));
				break;
			//Kassenwart
			case(1) :
				return $this -> redirect(array('controller' => 'Trainings', 'action' => 'clear'));
				break;
			//Abteilungsleiter
			case(2) :
				return $this -> redirect(array('controller' => 'Trainings', 'action' => 'pay'));
				break;
			//Admin
			case(3) :
				return $this -> redirect(array('controller' => 'Users', 'action' => 'overview'));
				break;
		}
	}

	public function overview() {
		#$user = $this -> User -> find('all', array('order' => array('department_id ASC','surname ASC','User.name ASC')));
		$departments = $this -> Department -> find('all');
		$this -> set('departments', $departments);
		#$this -> set('user', $user);

	}

	public function create() {
		$departments = $this -> Department -> find('all', array('recursive' => 0));
		$this -> set('departments', $departments);

		if (!empty($this -> request -> data)) {
			$this -> User -> create();
			$data = $this -> request -> data;
			#$data['User']['id'] = $id;
			if ($data['User']['wage'] == '') {
				unset($data['User']['wage']);
			}
			$data['User']['password'] = AuthComponent::password($data['User']['password']);
			#$this -> set('info', $data);
			if ($this -> User -> save($data)) {
				$this -> Session -> setFlash(__('Der Nutzer wurde erfolgreich angelegt.'));
				return $this -> redirect(array('action' => 'overview'));
			} else {
				$this -> Session -> setFlash(__('Der Nutzer konnte nicht angelegt werden!'));
			}
		}
	}

	public function delete_confirm($id){
        $user = $this -> User -> findById($id);
        $this -> set('user', $user['User']);
    }

	public function delete($id) {
        if (!$id) {
            throw new NotFoundException(__('id konnte nicht gefunden werden.'));
        }
        $user = $this -> User -> findById($id);
        $user->delete($user['User']['id']);
        return $this -> redirect(array('action' => 'overview'));
    }

	public function edit($id) {
		if (!$id) {
			throw new NotFoundException(__('id konnte nicht gefunden werden.'));
		}
		$user = $this -> User -> findById($id);
		$this -> set('role', $user['User']['role']);
		$this -> set('department_id', $user['User']['department_id']);
		$departments = $this -> Department -> find('all', array('recursive' => 0));
		$this -> set('departments', $departments);

		$user['User']['password'] = '';
		if (empty($this -> request -> data)) {
			$this -> request -> data = $user;

		} else {
			$data = $this -> request -> data;
			$data['User']['id'] = $id;
			
			if ($data['User']['wage'] == '') {
				unset($data['User']['wage']);
			}
			if ($data['User']['password'] == '' || $data['User']['password'] == null ) {
				unset($data['User']['password']);
			}
			else{
				$data['User']['password'] = AuthComponent::password($data['User']['password']);
				$data['User']['firstlogin'] = 1;
			}
			if ($this -> User -> save($data)) {
				$this -> Session -> setFlash(__('Der Nutzer wurde erfolgreich abgeändert.'));
				return $this -> redirect(array('action' => 'overview'));
			}
		}
	}

}
