<?php
class Application extends AppModel {
	var $actsAs = array('Containable');
	var $name = 'Application';

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
		),
		'Absence' => array(
			'className' => 'Absence',
			'foreignKey' => 'absence_id',
			'conditions' => '',
		)
	);

	function findApplicationsByAbsenceAndUser($absence_id, $user_id) {
		if (empty($absence_id) || empty($user_id)) {
			return null;
		}

		$ret = $this->find('all', array(
			'conditions' => array(
				'Application.user_id' => $user_id,
				'Application.absence_id' => $absence_id,
			),
		));

		return $ret;
	}

	function deleteAllApplicationsByAbsence($id) {
		if (empty($id)) {
			return false;
		}

		$ret = $this->deleteAll(array(
			'Application.absence_id' => $id,
		));
		return $ret;
	}

	// convert this to validation
	function beforeSave($options) {
		if (!empty($this->data['Application']['user_id']) && !empty($this->data['Application']['absence_id'])) {
			$ret = $this->findApplicationsByAbsenceAndUser($this->data['Application']['absence_id'], $this->data['Application']['user_id']);

			if (!empty($ret)) {
				return false;
			}
		}

		return true;
	}
}
