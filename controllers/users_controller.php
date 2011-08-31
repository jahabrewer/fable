<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Time');

	/**
	 * Register action
	 */
	 /*
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
	*/

	/**
	 * Login action
	 */
	function login() {
		if(!empty($this->data)) {
			// unset unrequired validation rules
			unset($this->User->validate['username']['check_username_exists']);
			unset($this->User->validate['email_address']);
			
			// validate form
			$this->User->set($this->data);
			if($this->User->validates()) {
				// update Last Login date
				$this->User->id = $this->User->_user['User']['id'];
				$this->User->saveField('last_login',date("Y-m-d H:i:s"));
				
				// save User to Session and redirect
				$this->Session->write('User', $this->User->_user);
				$user = $this->User->_user;
				if ($this->User->isAdmin($user['User'])) {
					$this->Session->setFlash('You successfully logged in as a privileged user');
					$this->redirect(array(
						'controller' => 'absences',
						'action' => 'index',
						'admin' => true,
					));
				} else if ($this->User->isTeacher($user['User'])) {
					$this->Session->setFlash('You successfully logged in as a teacher');
					$this->redirect(array(
						'controller' => 'absences',
						'action' => 'index',
						'teacher' => true,
					));
				} else if ($this->User->isSubstitute($user['User'])) {
					$this->Session->setFlash('You successfully logged in as a substitute');
					$this->redirect(array(
						'controller' => 'absences',
						'action' => 'index',
						'substitute' => true,
					));
				}
			}
		}
	}

	/**
	 * Logout action
	 */
	function logout() {
		$this->Session->delete('User');
		$this->Session->setFlash('You have successfully logged out', 'default');
		$this->redirect(array(
			'action' => 'login',
			'substitute' => false,
			'admin' => false,
			'teacher' => false,
		));
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		$this->layout = 'admin';
		$this->view($id);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->User->recursive = 2;
		$user = $this->User->read(null, $id);
		$schools = $this->User->School->find('list');
		$this->set(compact('user', 'schools'));
	}

	function edit($id, $check_ownership = true) {
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid user');
			$this->redirect(array('controller' => 'absences', 'action' => 'index'));
		}
		$this->User->recursive = 1;
		
		// get & check User
		$user = $this->User->read(null, $id);
		if(empty($user)) {
			$this->Session->setFlash('Invalid user');
			$this->redirect(array('controller' => 'absences', 'action' => 'index'));
		}

		// check for ownership
		$session_user = $this->Session->read('User');
		if (($user['User']['id'] != $session_user['User']['id']) && $check_ownership) {
			$this->Session->setFlash('You may only edit your user profile');
			$this->redirect(array('action' => 'view', $id));
		}
		
		// unset unrequired validation rules
		unset($this->User->validate['username']['check_user']);
		unset($this->User->validate['username']['check_username_exists']);
		unset($this->User->validate['password']);
		
		if(!empty($this->data)) {
			// validate & save data
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The user has been saved');
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.');
			}
		} else {
			// pre-populate data
			$this->data = $user;
			
			// remove Password
			$this->data['User']['password'] = '';
		}
		
		$schools = $this->User->School->find('list');
		$userTypes = $this->User->UserType->find('list');
		$educationLevels = $this->User->EducationLevel->find('list');
		$preferredSchools = $schools;
		$selectedSchools = array();
		if (!empty($this->data['PreferredSchool'])) foreach ($this->data['PreferredSchool'] as $school) array_push($selectedSchools, $school['id']);
		$this->set(compact('schools', 'userTypes', 'educationLevels', 'preferredSchools', 'selectedSchools'));
	}

	function admin_index() {
		$this->layout = 'admin';
		$this->index();
	}

	function admin_add() {
		$this->layout = 'admin';
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
		$userTypes = $this->User->UserType->find('list');
		$schools = $this->User->School->find('list');
		$educationLevels = $this->User->EducationLevel->find('list');
		$preferredSchools = $schools;
		$legend = 'Add User';
		$this->set(compact('legend', 'schools', 'userTypes', 'educationLevels', 'preferredSchools'));
	}

	function admin_edit($id = null) {
		$this->layout = 'admin';
		$this->edit($id, false);
		/*
		if(!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid user');
			$this->redirect(array('controller' => 'absences', 'action' => 'index'));
		}
		$this->User->recursive = 1;
		
		// get & check User
		$user = $this->User->read(null, $id);
		if(empty($user)) {
			$this->Session->setFlash('Invalid user');
			$this->redirect(array('controller' => 'absences', 'action' => 'index'));
		}
		
		// unset unrequired validation rules
		unset($this->User->validate['username']['check_user']);
		unset($this->User->validate['username']['check_username_exists']);
		unset($this->User->validate['password']);
		
		if(!empty($this->data)) {
			// validate & save data
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('The user has been saved');
				$this->redirect(array('action' => 'view', $id));
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
		$legend = 'Edit User';
		$edit = TRUE;
		
		$schools = $this->User->School->find('list');
		$userTypes = $this->User->UserType->find('list');
		$educationLevels = $this->User->EducationLevel->find('list');
		$preferredSchools = $schools;
		$selectedSchools = array();
		if (!empty($this->data['PreferredSchool'])) foreach ($this->data['PreferredSchool'] as $school) array_push($selectedSchools, $school['id']);
		$this->set(compact('legend', 'edit', 'schools', 'userTypes', 'educationLevels', 'preferredSchools', 'selectedSchools'));
		*/
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

	function teacher_edit($id = null) {
		$this->layout = 'teacher';
		$this->edit($id);
	}

	function teacher_view($id = null) {
		$this->layout = 'teacher';
		$this->view($id);
	}

	function teacher_logout() {
		$this->logout();
	}

	function substitute_view($id = null) {
		$this->layout = 'substitute';
		$this->view($id);
	}

	function substitute_edit($id = null) {
		$this->layout = 'substitute';
		$this->edit($id);
	}

	function substitute_logout() {
		$this->logout();
	}

	function admin_logout() {
		$this->logout();
	}
}
