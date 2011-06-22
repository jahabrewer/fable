<?php
class Absence extends AppModel {
	var $name = 'Absence';
	var $displayField = 'absentee_id';

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
