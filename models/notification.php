<?php
class Notification extends AppModel {
	var $name = 'Notification';
	var $actsAs = array('Containable');
	var $order = 'Notification.created DESC';

	var $belongsTo = array(
		'NotificationType' => array(
			'className' => 'NotificationType',
			'foreignKey' => 'notification_type_id',
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Absence' => array(
			'className' => 'Absence',
			'foreignKey' => 'absence_id',
		),
		'Other' => array(
			'className' => 'User',
			'foreignKey' => 'other_id',
		)
	);
}
