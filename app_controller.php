<?php
class AppController extends Controller {

	var $uses = array('User');

	/**
	 * Callback
	 */
	function beforeFilter() {
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
}
