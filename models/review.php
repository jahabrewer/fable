<?php
class Review extends AppModel {
	var $name = 'Review';

	var $belongsTo = array(
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
		),
		'Subject' => array(
			'className' => 'User',
			'foreignKey' => 'subject_id',
		)
	);
}
