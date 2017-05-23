<?

class User extends AppModel {
	public $belongsTo = 'Department';
	public $hasMany = 'Training';
	#TODO: validate hinzufügen

	public $validate = array(
		'username' => array(
			array('rule' =>'isUnique','message' => 'Dieser Nutzername ist bereits vergeben.'),
			array('rule'=>'alphaNumeric','allowEmpty' => false, 'message' => 'Bitte geben Sie den Nutzernamen ein.')
		), 
		'name' => array(
			'rule' => '/[A-Za-z]+/', 
			'allowEmpty' => false, 
			'message' => 'Bitte geben Sie den Vornamen ein.'
		), 
		'surname' => array(
			'rule' => '/[A-Za-z]+/', 
			'allowEmpty' => false, 
			'message' => 'Bitte geben Sie den Nachnamen ein.'
		), 
		'wage' => array(
			'rule' => '/\d+[,]{0,1}\d*/', 
			'allowEmpty' => true, 
			'message' => 'Stundensatz bitte als Zahl eingeben.'
		), 
		'email' => array(
			'rule' => 'email', 
			'allowEmpty' => true, 
			'message' => 'Bitte geben Sie eine gültige email-Adresse ein.'
		), 
		'role' => array(
			'rule'=>'/\d+/',
			'allowEmpty' => false, 
			'message' => 'Bitte wählen Sie eine Aufgabe aus.'
		)
	);


}
