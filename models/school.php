<?php
class School extends AppModel {
	var $name = 'School';
	var $displayField = 'name';

	var $hasMany = array(
		'Absence' => array(
			'className' => 'Absence',
			'foreignKey' => 'school_id',
			'dependent' => false,
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'school_id',
			'dependent' => false,
		)
	);

	var $hasAndBelongsToMany = array(
		'Substitute' => array (
			'className'	=> 'User',
			//'joinTable'	=> 'schools_users'
		)
	);
}
