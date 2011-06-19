<?php
class UsersController extends AppController {

	var $name = 'Users';

	/**
	 * Register action
	 */
	function register() {
		if(!empty($this->data)) {
			// unset unrequired validation rules
			unset($this->User->validate['username']['check_user']);

			// validate & save data
			if($this->User->save($this->data)) {
				// set Flash & redirect
				$this->Session->setFlash('You have successfully registered.','default',array('class'=>'flash_good'));
				$this->redirect(array('action'=>'login'));
			}
		}
	}

	/**
	 * Login action
	 */
	function login() {
		if(!empty($this->data)) {
			// unset unrequired validation rules
			unset($this->User->validate['username']['check_username_exists']);
			
			// validate form
			$this->User->set($this->data);
			if($this->User->validates()) {
				// update Last Login date
				$this->User->id = $this->User->_user['User']['id'];
				$this->User->saveField('last_login',date("Y-m-d H:i:s"));
				
				// save User to Session and redirect
				$this->Session->write('User', $this->User->_user);
				//$this->Session->setFlash('You have successfully logged in.','default',array('class'=>'flash_good'));
				$user = $this->User->_user;
				if ($user['User']['privileged']) {
					$this->Session->setFlash('privileged!');
					$this->redirect(array('controller' => 'absences', 'action'=>'index','admin'=>TRUE));
				} else {
					$this->Session->setFlash('unprivileged');
					$this->redirect(array('controller' => 'absences', 'action'=>'index','admin'=>FALSE));
				}
			}
		}
	}
	
	/**
	 * Logout action
	 */
	function logout() {
		$this->Session->delete('User');
		$this->Session->setFlash('You have successfully logged out.','default',array('class'=>'flash_good'));
		$this->redirect(array('action' => 'login'));
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
		$schools = $this->User->School->find('list');
		$this->set(compact('schools'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$schools = $this->User->School->find('list');
		$this->set(compact('schools'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$schools = $this->User->School->find('list');
		$this->set(compact('schools'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	/**
	 * Admin Add action
	 */
	function admin_add() {
		if(!empty($this->data)) {
			// unset unrequired validation rules
			unset($this->User->validate['username']['check_user']);
		
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The user has been saved');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.');
			}
		}
		$schools = $this->User->School->find('list');
		$this->set(compact('schools'));
		
		// set form legend text
		$this->set('legend','Add User');
	}

	function admin_edit($id = null) {
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid user');
			$this->redirect(array('action' => 'index'));
		}
		
		// get & check User
		$user = $this->User->read(null, $id);
		if(empty($user)) {
			$this->Session->setFlash('Invalid User');
			$this->redirect(array('action' => 'index'));
		}
		
		// unset unrequired validation rules
		unset($this->User->validate['username']['check_user']);
		unset($this->User->validate['username']['check_username_exists']);
		unset($this->User->validate['password']);
		
		if(!empty($this->data)) {
			// validate & save data
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The user has been saved');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.');
			}
		} else {
			// pre-populate data
			$this->data = $user;
			
			// remove Password
			$this->data['User']['password'] = '';
		}
		
		// set View variables
		$this->set('legend','Edit User');
		$this->set('edit',TRUE);
		
		$schools = $this->User->School->find('list');
		$this->set(compact('schools'));

		// use same View for adding & editing
		$this->render('admin_add');
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
