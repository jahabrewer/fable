<?php
class Absence extends AppModel {
	var $name = 'Absence';
	var $displayField = 'absentee_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
}
