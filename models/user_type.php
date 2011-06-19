<?php
class UserType extends AppModel {
	var $name = 'UserType';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_type_id',
			'dependent' => false,
		)
	);

}
