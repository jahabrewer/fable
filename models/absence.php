<?php
class Absence extends AppModel {
	var $name = 'Absence';
	var $displayField = 'absentee_id';

	var $validate = array(
		'start' => array(
			'startBeforeEnd' => array(
				'rule' => array('startBeforeEnd', 'end'),
				'message' => 'The absence must start before it ends'
			),
			'futureDate' => array(
				'rule' => array('futureDate', 'start'),
				'message' => 'The absence must begin in the future',
				'on' => 'create'
			)
		)
	);

	var $belongsTo = array(
		'Absentee' => array(
			'className' => 'User',
			'foreignKey' => 'absentee_id',
		),
		'Fulfiller' => array(
			'className' => 'User',
			'foreignKey' => 'fulfiller_id',
		),
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
		)
	);

	var $hasMany = array(
		'Application' => array(
			'className' => 'Application',
			'foreignKey' => 'absence_id',
			'dependent' => false,
		),
	);

	function isAbsenceInFuture($absence) {
		if (strtotime($absence['start']) <= time()){
			return false;
		}
		return true;
	}

	function isAbsenceOwnedByUser($absence_id, $user_id) {
		$absence = $this->read(array('absentee_id'), $absence_id);
		if (isset($absence['Absence']['absentee_id']) && ($absence['Absence']['absentee_id'] == $user_id)) {
			return true;
		}

		return false;
	}

	function isAbsenceFulfilledByUser($absence_id, $user_id) {
		$absence = $this->read(array('fulfiller_id'), $absence_id);
		if (isset($absence['Absence']['fulfiller_id']) && ($absence['Absence']['fulfiller_id'] == $user_id)) {
			return true;
		}

		return false;
	}

	function isAbsenceFulfilled($absence_id) {
		$absence = $this->read(array('fulfiller_id'), $absence_id);
		if (!empty($absence['Absence']['fulfiller_id'])) {
			return true;
		}

		return false;
	}

	function startBeforeEnd($field=array(), $compare_field) {
		foreach($field as $key => $value) {
			$v1 = $value;
			$v2 = $this->data[$this->name][$compare_field];
			if ($v1 >= $v2) {
				return FALSE;
			}
		}
		return TRUE;
	}

	function futureDate($data, $field){
		if (strtotime($data[$field]) <= time()){
			return FALSE;
		}
		return TRUE;
	} 
}
