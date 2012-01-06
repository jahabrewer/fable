<?php
class AppController extends Controller {

	var $uses = array('User');
	var $components = array('ComponentLoader');

	/**
	 * Callback
	 */
	function beforeFilter() {
		$this->ComponentLoader->load('Session');
		$user = $this->Session->read('User');

		// require login for all pages
		if($this->action != 'login' && is_null($user)) {
			// set Flash and redirect to login page
			$this->Session->setFlash('You must be logged in');
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => false,
			));
		}

		// set vars for user type
		$viewer_id = $user['User']['id'];
		$viewer_is_admin = $this->User->isAdmin($user['User']);
		$viewer_is_teacher = $this->User->isTeacher($user['User']);
		$viewer_is_substitute = $this->User->isSubstitute($user['User']);
		if ($viewer_is_admin) {
			$home_link_target = '/admin/';
		} else if ($viewer_is_teacher) {
			$home_link_target = '/teacher/';
		} else if ($viewer_is_substitute) {
			$home_link_target = '/substitute/';
		}

		// check user type and route
		if (isset($this->params['admin']) && $this->params['admin'] && !$viewer_is_admin) {
			$this->Session->setFlash('You must be an administrator to access that page');
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => false,
			));
		} else if (isset($this->params['teacher']) && $this->params['teacher'] && !$viewer_is_teacher) {
			$this->Session->setFlash('You must be a teacher to access that page');
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'teacher' => false,
			));
		} else if (isset($this->params['substitute']) && $this->params['substitute'] && !$viewer_is_substitute) {
			$this->Session->setFlash('You must be a substitute to access that page');
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'substitute' => false,
			));
		}

		// export vars
		$this->set(compact('viewer_id', 'viewer_is_admin', 'viewer_is_teacher', 'viewer_is_substitute', 'home_link_target'));
	}

	function _create_notification($notification_type_name, $absence_id, $user_id, $other_id) {
		$this->loadModel('NotificationType');
		$this->loadModel('Notification');
		$this->loadModel('User');
		// figure out which notification type this is
		$notification_type = $this->NotificationType->find('first', array(
			'conditions' => array('NotificationType.name' => $notification_type_name)
		));
		// record notification
		$notification = array(
			'user_id' => $user_id,
			'absence_id' => $absence_id,
			'other_id' => $other_id,
			'notification_type_id' => $notification_type['NotificationType']['id'],
		);
		$this->Notification->save($notification);

		// get user information for email
		$user = $this->User->read('email_address', $user_id);
		$notification = $this->Notification->find('first', array(
			'conditions' => array('Notification.id' => $this->Notification->id),
			'contain' => array('Other.first_name', 'Other.last_name', 'Absence.start'),
		));
		// send an email
		$this->ComponentLoader->load('Email');
		/*
		$this->Email->smtpOptions = array(
			'port' => '465',
			'host' => 'ssl://smtp.gmail.com',
			'username' => 'jahabrewer@gmail.com',
			'password' =>
		);
		$this->Email->delivery = 'smtp';
		*/
		$this->Email->delivery = 'debug';
		$this->Email->from = 'Fable <noreply@example.com>';
		$this->Email->to = $user['User']['email_address'];
		$this->Email->subject = 'hi!';
		$body = str_replace(
			array(
				'%other_firstname%',
				'%other_lastname%',
				'%absence_start%',
			),
			array(
				$notification['Other']['first_name'],
				$notification['Other']['last_name'],
				date('F j', strtotime($notification['Absence']['start'])),
			),
			$notification_type['NotificationType']['string']
		);
		$body .= "\nView the affected absence at:\n";
		//TODO: it's pointless to link to the actual absence here
		// until login remembers where users were intending to go
		// instead of dumping them at absences index
		$body .= Configure::read('BASEURL');
		$this->Email->send($body);
	}
}
