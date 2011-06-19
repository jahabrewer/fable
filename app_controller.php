<?php
class AppController extends Controller {

	/**
	 * Callback
	 */
	function beforeFilter() {
		$user = $this->Session->read('User');
		// require login for all pages
		if($this->action != 'login' && is_null($user)) {
			// set Flash and redirect to login page
			$this->Session->setFlash('You need to be logged in for that action.','default',array('class'=>'flash_bad'));
			$this->redirect(array('controller'=>'users','action'=>'login','admin'=>FALSE));
		} else if (isset($this->params['admin']) && $this->params['admin'] && ($user['User']['user_type_id'] != 1)) {
			$this->Session->setFlash('You need to have administrative privileges for that action.','default',array('class'=>'flash_bad'));
			$this->redirect(array('controller'=>'users','action'=>'login','admin'=>FALSE));
		}
	}
}
