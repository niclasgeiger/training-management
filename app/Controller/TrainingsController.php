<?php
class TrainingsController extends AppController {
	public function index() {
		//Faulheit das rumzuschieben von overview
		return $this -> redirect(array('action' => 'overview'));
	}

	/*
	 * TRAINER
	 * Trainingsübersicht für Übungsleiter
	 */
	public function beforeFilter() {
		//indexAction für das TimeMenue

	}

	/** Trainer
	 * gibt übersicht über die eingetragenen Trainingsstunden
	 * TODO: Legende einfügen
	 */
	public function overview($month = null, $year = null) {
		//MONTH AND YEAR
		if ($month == null) {
			$month = date('n');
		}
		if ($year == null) {
			$year = date('Y');
		}
		$this -> set('month', $month);
		$this -> set('year', $year);

		//load User Model
		#$this->loadModel("Users");
		$user = AuthComponent::user();
		$this -> set('user', $user);

		//get Training records
		$conditions = array('MONTH(date)' => $month, 'YEAR(date)' => $year, 'user_id' => $user['id']);

		if ($month == 0) {
			unset($conditions['MONTH(date)']);
		}

		$trainings = $this -> Training -> find('all', array('conditions' => $conditions, 'order' => array('date' => 'desc', 'time' => 'desc'), 'fields' => array('id', 'compensation', 'date', 'time', 'duration', 'cleared', 'paid')));
		$this -> set('trainings', $trainings);

		$sum = $this -> Training -> find('all', array('conditions' => $conditions, 'fields' => array('SUM(compensation) as sum_comp', 'SUM(duration) as sum_dur', 'COUNT(Training.id) as count')));
		$this -> set('sum', $sum);

		$dates = $this -> Training -> query('SELECT DISTINCT MONTH(date) AS month,YEAR(date) AS year FROM trainings WHERE user_id = ' . $user['id'] . ' ORDER BY year DESC, month DESC');
		$this -> set('dates', $dates);
		//Monatsnamen
		$this -> set('months', array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'));

	}

	public function create() {
		if (!empty($this -> request -> data)) {
			$data = $this -> request -> data;
			$user = AuthComponent::user();
			$data['Training']['user_id'] = $user['id'];
			$data['Training']['department_id'] = $user['department_id'];
			$data['Training']['compensation'] = round(($user['wage'] * $data['Training']['duration'] / 60), 2);

			$this -> Training -> create();
			if ($this -> Training -> save($data)) {
				$this -> Session -> setFlash(__('Training erfolgreich eingetragen'));
				return $this -> redirect(array('action' => 'overview'));
			}
		}
	}

	public function delete($id) {
		#TODO: Fehlerabfrage? Requests sind gerade per get möglich!
		if ($this -> Training -> delete($id)) {
			$this -> Session -> setFlash("Das Training wurde erfolgreich gelöscht.");
			return $this -> redirect(array('action' => 'overview'));
		}
	}

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Training konnte nicht gefunden werden.'));
		}
		$training = $this -> Training -> findById($id);
		if (empty($this -> request -> data)) {
			$this -> request -> data = $training;
		} else {
			$this -> Training -> set($training);
			$data = $this -> request -> data;
			$user = AuthComponent::user();
			$data['Training']['compensation'] = round($data['Training']['duration'] / 60 * $user['wage'], 2);
			if ($this -> Training -> save($data)) {
				$this -> Session -> setFlash(__('Training erfolgreich abgeändert'));
				return $this -> redirect(array('action' => 'overview'));
			}
		}

	}

	/**
	 * zeigt Trainingsdetails an pro Trainer und Monat
	 */
	public function details($month, $year, $id) {
		$this -> loadModel('User');
		$conditions = array('MONTH(date)' => $month, 'YEAR(date)' => $year, 'user_id' => $id);

		$trainings = $this -> Training -> find('all', array('conditions' => $conditions, 'order' => array('date' => 'desc', 'time' => 'desc'), 'fields' => array('id', 'compensation', 'date', 'time', 'duration', 'cleared', 'paid', 'created')));
		$this -> set('trainings', $trainings);

		$user = $this -> User -> find('first', array('conditions' => array('User.id' => $id), 'fields' => array('name', 'surname')));
		$this -> set('user', $user['User']['name'].' '.$user['User']['surname']);

		$months = array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
		$this -> set('month', $months[$month]);
		$this -> set('year', $year);
		

	}

	/**
	 * für Abteilungsleiter
	 * Übersicht über Trainingsstunden die noch freizugeben sind
	 *
	 * TODO
	 * Auswahl pro Trainer..
	 * spans usw.. noch einfügen
	 * TODO
	 */
	public function clear($month = null, $year = null, $user_id = null) {
		$this -> set('months', array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'));

		//MONTH AND YEAR
		if ($month == null) {
			$month = date('n');
		}
		if ($year == null) {
			$year = date('Y');
		}
		$this -> set('month', $month);
		$this -> set('year', $year);

		$user = AuthComponent::user();
		$department = $user['department_id'];
		$this -> set('user', $user);

		//nur noch nicht freigegebene Trainingseinheiten
		$uncleared = $this -> Training -> query("SELECT Month(date) as month, Year(date) as year,name,surname,U.id as user_id,SUM(compensation) as compensation,SUM(duration) as duration,COUNT(T.id) as count FROM users as U, trainings as T WHERE U.id = T.user_id AND T.department_id='{$department}' AND cleared=0 GROUP BY Year(date),Month(date),T.user_id ORDER BY YEAR DESC, MONTH DESC, user_id DESC");
		$this -> set('uncleared', $uncleared);

		$this -> set('months', array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'));

		//Abfragen
		#TODO: extrem unsichere Art der abfrage!
		if (!empty($user_id)) {

			if ($this -> Training -> updateAll(array('cleared' => '1'), array('Training.department_id' => $department, 'user_id' => $user_id, 'Month(date)' => $month, 'Year(date) ' => $year))) {
				$this -> Session -> setFlash(__('Die Übungsstunden wurden erfolgreich freigeben.'));
				$this -> redirect(array('action' => 'clear'));
			} else {
				$this -> Session -> setFlash(__('Bei der Freigabe ist ein Fehler aufgetreten. Probieren Sie es bitte noch einmal.'));
				$this -> redirect(array('action' => 'clear'));
			}
		}

	}

	/**
	 * ABTEILUNGSLEITER
	 * Zeigt die bereits freigegebenen Stunden pro Trainer an
	 * TODO:implementieren
	 */
	public function cleared($month = null, $year = null) {
		//MONTH AND YEAR
		if ($month == null) {
			$month = date('n');
		}
		if ($year == null) {
			$year = date('Y');
		}
		$this -> set('month', $month);
		$this -> set('year', $year);
		#Monatsnamen
		$this -> set('months', array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'));

		#User und abteilung finden
		$user = AuthComponent::user();
		$department = $user['department_id'];

		#Archivdaten
		$dates = $this -> Training -> query('SELECT DISTINCT MONTH(date) AS month,YEAR(date) AS year FROM trainings WHERE cleared = 1 AND department_id = ' . $department . ' ORDER BY year DESC, month DESC');
		$this -> set('dates', $dates);

		#alle Monate auswählen
		$conditions = array('Training.department_id' => $department, 'cleared' => '1', 'Month(date)' => $month, 'Year(date)' => $year);
		if ($month == 0) {
			unset($conditions['Month(date)']);
		}

		#summe von allen freigaben im Monat
		$sum = $this -> Training -> find('all', array('conditions' => $conditions, 'fields' => array('Month(date) as month', 'Year(date) as year', 'SUM(compensation) as compensation', 'SUM(duration) as duration', 'COUNT(Training.id) as count')));

		$this -> set('sum', $sum);
		//bereits bearbeitete Datensätze finden
		$archive = $this -> Training -> find('all', array('conditions' => $conditions, 'fields' => array('Month(date) as month', 'Year(date) as year', 'User.id','User.name', 'User.surname', 'SUM(compensation) as compensation', 'SUM(duration) as duration', 'COUNT(Training.id) as count', 'Training.modified'), 'group' => array('Month(date)', 'user_id'), 'order' => array('year DESC, month DESC')));

		$this -> set('archive', $archive);
	}

	/**KASSENWART
	 * rechnet neue Trainingsstunden ab.
	 * TODO: sicherer implementieren von dem request (gerade einfach per url)
	 * 		Aber es geht zumindest nur dass einer was in seiner Abteilung verhaut wegen dem department check bei update
	 */
	public function pay($month = null, $year = null, $user_id = null) {
		$this -> set('months', array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'));

		//MONTH AND YEAR
		if ($month == null) {
			$month = date('n');
		}
		if ($year == null) {
			$year = date('Y');
		}
		$this -> set('month', $month);
		$this -> set('year', $year);

		$user = AuthComponent::user();
		$department = $user['department_id'];
		$this -> set('user', $user);

		//nur noch nicht freigegebene Trainingseinheiten
		$unpaid = $this -> Training -> query("SELECT Month(date) as month, Year(date) as year,name,surname,U.id as user_id,SUM(compensation) as compensation,SUM(duration) as duration,COUNT(T.id) as count FROM users as U, trainings as T WHERE U.id = T.user_id AND T.department_id='{$department}' AND paid=0 AND cleared=1 GROUP BY Month(date),T.user_id");
		$this -> set('unpaid', $unpaid);

		$this -> set('months', array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'));

		//Abfragen
		#TODO: extrem unsichere Art der abfrage!
		if (!empty($user_id)) {

			if ($this -> Training -> updateAll(array('paid' => '1'), array('Training.department_id' => $department, 'user_id' => $user_id, 'Month(date)' => $month, 'Year(date) ' => $year, 'cleared' => 1))) {
				$this -> Session -> setFlash(__('Die Übungsstunden wurden erfolgreich als überwiesen eingetragen.'));
				$this -> redirect(array('action' => 'pay'));
			} else {
				$this -> Session -> setFlash(__('Bei der Freigabe ist ein Fehler aufgetreten. Probieren Sie es bitte noch einmal.'));
				$this -> redirect(array('action' => 'pay'));
			}
		}
	}

	/**KASSENWART
	 * Zeigt die bereits abgerechneten Stunden pro Trainer an
	 * TODO:implementieren
	 */
	public function paid($month = null, $year = null) {
		//MONTH AND YEAR
		if ($month == null) {
			$month = date('n');
		}
		if ($year == null) {
			$year = date('Y');
		}
		$this -> set('month', $month);
		$this -> set('year', $year);
		#Monatsnamen
		$this -> set('months', array('Jahr', 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'));

		#User und abteilung finden
		$user = AuthComponent::user();
		$department = $user['department_id'];

		#Archivdaten
		$dates = $this -> Training -> query('SELECT DISTINCT MONTH(date) AS month,YEAR(date) AS year FROM trainings WHERE paid = 1 AND department_id = ' . $department . ' ORDER BY year DESC, month DESC');
		$this -> set('dates', $dates);

		#alle Monate auswählen
		$conditions = array('Training.department_id' => $department, 'paid' => '1', 'Month(date)' => $month, 'Year(date)' => $year);
		if ($month == 0) {
			unset($conditions['Month(date)']);
		}

		//bereits bearbeitete Datensätze finden
		$sum = $this -> Training -> find('all', array('conditions' => $conditions, 'fields' => array('Month(date) as month', 'Year(date) as year', 'SUM(compensation) as compensation', 'SUM(duration) as duration', 'COUNT(Training.id) as count'), 'order' => 'year DESC, month DESC '));

		$this -> set('sum', $sum);
		$archive = $this -> Training -> find('all', array('conditions' => $conditions, 'fields' => array('Month(date) as month', 'Year(date) as year', 'User.id', 'User.name', 'User.surname', 'SUM(compensation) as compensation', 'SUM(duration) as duration', 'COUNT(Training.id) as count', 'modified'), 'group' => array('Month(date)', 'user_id')));

		$this -> set('archive', $archive);
	}

}
?>