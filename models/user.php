<?php
class User extends AppModel {

	/**
	 * Name of Class
	 * @var string
	 */
	var $name = 'User';

	var $displayField = 'username';

	var $belongsTo = array(
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
		)
	);
	
	var $hasMany = array(
		'AbsenceMade' => array(
			'className' => 'Absence',
			'foreignKey' => 'absentee_id',
			'dependent' => false,
		),
		'AbsenceFilled' => array(
			'className' => 'Absence',
			'foreignKey' => 'fulfiller_id',
			'dependent' => false,
		)
	);

	/**
	 * Validation rules
	 * @var array
	 */
	var $validate = array(
		'username'=>array(
			'alphaNumeric'=>array(
				'rule'=>'alphaNumeric',
				'allowEmpty'=>FALSE,
				'message'=>'Please insert a username'
			),
			'check_user'=>array(
				'rule'=>'check_user',
				'message'=>'Either your Username or Password is invalid',
				'last'=>TRUE
			),
			'check_username_exists'=>array(
				'rule'=>'check_username_exists',
				'message'=>'Username already exists, please choose another',
			),
		),
		'password'=>array(
			'alphaNumeric'=>array(
				'rule'=>'alphaNumeric',
				'allowEmpty'=>FALSE,
				'message'=>'Please insert a password'
			)
		)
	);
	
	/**
	 * Private User
	 * @var array
	 */
	var $_user = array();
	
	
	/**
	 * Check a User is valid
	 * @param array $check
	 * @return bool
	 */
	function check_user($check) {
		// only check if Username & Password are present
		if(!empty($check['username']) && !empty($_POST['data']['User']['password'])) {
			// get User by username
			$user = $this->find('first',array('conditions'=>array('User.username'=>$check['username'])));
			
			// invalid User
			if(empty($user)) {
			return FALSE;
			}
			
			// compare passwords
			$salt = Configure::read('Security.salt');
			if($user['User']['password'] != md5($_POST['data']['User']['password'].$salt)) {
			return FALSE;
			}
			
			// save User
			$this->_user = $user;
		}
		
	return TRUE;
	}
	
	
	/**
	 * Check a username exists in the database
	 * @param array $check
	 * @return bool
	 */
	function check_username_exists($check) {
		// get User by username
		if(!empty($check['username'])) {
			$user = $this->find('first',array('conditions'=>array('User.username'=>$check['username'])));
			
			// invalid User
			if(!empty($user)) {
			return FALSE;
			}
		}
		
	return TRUE;
	}
	
	
	/**
	 * BeforeSave Callback
	 */
	function beforeSave() {
		// hash Password
		if(!empty($this->data['User']['password'])) {
			$salt = Configure::read('Security.salt');
			$this->data['User']['password'] = md5($this->data['User']['password'].$salt);
		} else {
			// remove Password to prevent overwriting empty value
			unset($this->data['User']['password']);
		}
		
	return TRUE;
	}
}
