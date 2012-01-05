<?php
class NotificationsController extends AppController {

	var $name = 'Notifications';
	var $helpers = array('Time');

	function index() {
		$viewer_id = $this->viewVars['viewer_id'];
		$this->paginate = array(
			'conditions' => array(
				'Notification.user_id' => $viewer_id,
			),
			'contain' => array(
				'Absence.start',
				'Other.first_name',
				'Other.last_name',
				'NotificationType.string',
			),
		);
		$this->set('notifications', $this->paginate());
		$this->render('/notifications/index');
	}

	function teacher_index() {
		$this->index();
	}

	function substitute_index() {
		$this->index();
	}

	function admin_index() {
		$this->index();
	}
}
