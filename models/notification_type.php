<?php
class NotificationType extends AppModel {
	var $name = 'NotificationType';
	var $displayField = 'name';

	var $hasMany = array(
		'Notification' => array(
			'className' => 'Notification',
			'foreignKey' => 'notification_type_id',
			'dependent' => false,
		)
	);

}
