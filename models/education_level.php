<?php
class EducationLevel extends AppModel {
	var $name = 'EducationLevel';
	var $displayField = 'name';

	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'education_level_id',
			'dependent' => false,
		)
	);

}
