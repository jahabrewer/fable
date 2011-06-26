<?php
class UserType extends AppModel {
	var $name = 'UserType';
	var $displayField = 'name';

	var $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_type_id',
			'dependent' => false,
		)
	);

}
