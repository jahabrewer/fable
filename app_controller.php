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
			$this->Session->setFlash('You need to be logged in for that action.','default',array('class'=>'flash_bad'));
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => false,
			));
		}

		// check user type and route
		if (isset($this->params['admin']) && $this->params['admin'] && !$this->User->isAdmin($user['User'])) {
			$this->Session->setFlash('You must be an administrator to access that page');
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'admin' => false,
			));
		} else if (isset($this->params['teacher']) && $this->params['teacher'] && !$this->User->isTeacher($user['User'])) {
			$this->Session->setFlash('You must be a teacher to access that page');
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'teacher' => false,
			));
		} else if (isset($this->params['substitute']) && $this->params['substitute'] && !$this->User->isSubstitute($user['User'])) {
			$this->Session->setFlash('You must be a substitute to access that page');
			$this->redirect(array(
				'controller' => 'users',
				'action' => 'login',
				'substitute' => false,
			));
		}
	}
}
