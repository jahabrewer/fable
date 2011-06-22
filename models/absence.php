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
				'message' => 'The absence must begin in the future'
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
