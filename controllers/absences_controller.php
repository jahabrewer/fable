<?php
class AbsencesController extends AppController {

	var $name = 'Absences';
	var $helpers = array('Time', 'Html');
	var $components = array('Email');

	function index() {
		if (isset($this->params['named']['filter'])) {
			$filter = $this->params['named']['filter'];
			if ($filter == 'expired') {
				$this->paginate = array(
					'conditions' => array('Absence.start <= NOW()')
				);
			} elseif ($filter == 'fulfilled') {
				$this->paginate = array(
					'conditions' => array('Absence.fulfiller_id IS NOT NULL')
				);
			} elseif ($filter == 'all') {
				$this->paginate = array();
			}
		} else {
			$this->paginate = array(
				'conditions' => array('Absence.start > NOW() AND Absence.fulfiller_id IS NULL')
			);
		}
		$this->Absence->recursive = 1;
		$this->set('absences', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Absence->recursive = 2;
		$this->set('absence', $this->Absence->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Absence->create();
			if ($this->Absence->save($this->data)) {
				$this->Session->setFlash(__('The absence has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.', true));
			}
		}

		// set default school to user's school
		$user = $this->Session->read('User');
		$this->data['Absence']['school_id'] = $user['User']['school_id'];

		$absentees = $this->Absence->Absentee->find('list');
		$fulfillers = $this->Absence->Fulfiller->find('list');
		$schools = $this->Absence->School->find('list');
		$this->set(compact('absentees', 'fulfillers', 'schools'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}

		// check for ownership
		$user = $this->Session->read('User');
		if (!$this->Absence->isAbsenceOwnedByUser($id, $user['User']['id'])) {
			$this->Session->setFlash('You do not have permission to edit that absence');
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if ($this->Absence->save($this->data)) {
				$this->Session->setFlash(__('The absence has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Absence->read(null, $id);
		}
		$absentees = $this->Absence->Absentee->find('list');
		$fulfillers = $this->Absence->Fulfiller->find('list');
		$schools = $this->Absence->School->find('list');
		$this->set(compact('absentees', 'fulfillers', 'schools'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for absence', true));
			$this->redirect(array('action'=>'index'));
		}
		// check for ownership
		$user = $this->Session->read('User');
		if (!$this->Absence->isAbsenceOwnedByUser($id, $user['User']['id'])) {
			$this->Session->setFlash('You do not have permission to delete that absence');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->Absence->delete($id)) {
			$this->Session->setFlash(__('Absence deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Absence was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_release($id = null) {
		$this->release($id);
	}

	function release($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for absence', true));
			$this->redirect(array('action'=>'index'));
		}
		// check for fulfiller_id match
		$user = $this->Session->read('User');
		$this->data = $this->Absence->read(null, $id);
		if (!empty($this->data['Absence']['fulfiller_id']) &&
			($this->data['Absence']['fulfiller_id'] == $user['User']['id'])) {
			$this->data['Absence']['fulfiller_id'] = null;
			if ($this->Absence->save($this->data)) {
				$this->Session->setFlash(__('The absence has been released', true));
				$this->_send_email_notification(array('message_type' => 'released'), $this->data['Absence']['id']);
			} else {
				$this->Session->setFlash(__('The absence could not be released.', true));
			}
		} else {
			$this->Session->setFlash(__('You must be the fulfiller to release an absence', true));
		}

		$this->redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this->index();
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Absence->recursive = 0;
		$this->set('absence', $this->Absence->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Absence->create();
			if ($this->Absence->save($this->data)) {
				$this->Session->setFlash(__('The absence has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.', true));
			}
		}
		$absentees = $this->Absence->Absentee->find('list');
		$fulfillers = $this->Absence->Fulfiller->find('list');
		$schools = $this->Absence->School->find('list');
		$this->set(compact('absentees', 'fulfillers', 'schools'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Absence->save($this->data)) {
				$this->Session->setFlash(__('The absence has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Absence->read(null, $id);
		}
		$absentees = $this->Absence->Absentee->find('list');
		$fulfillers = $this->Absence->Fulfiller->find('list');
		$schools = $this->Absence->School->find('list');
		$this->set(compact('absentees', 'fulfillers', 'schools'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for absence', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Absence->delete($id)) {
			$this->Session->setFlash(__('Absence deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Absence was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function apply($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}

		$user = $this->Session->read('User');

		// check for substitute status
		if ($user['User']['user_type_id'] != 3) {
			$this->Session->setFlash('You must be a substitute to apply for absences');
			$this->redirect(array('action' => 'index'));
		}

		$data = array(
			'user_id' => $user['User']['id'],
			'absence_id' => $id,
		);
		if ($this->Absence->Application->save($data)) {
			$this->Session->setFlash('Application successful');
		} else {
			$this->Session->setFlash('You have already applied for that absence');
		}
		$this->redirect(array('action' => 'index'));
	}

	function unapply($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}

		$user = $this->Session->read('User');

		// has the user applied? (deleteall works regardlessly, but
		// the successful delete message will confuse users)
		$tmp = $this->Absence->Application->findApplicationsByAbsenceAndUser($id, $user['User']['id']);
		if (empty($tmp)) {
			$this->Session->setFlash(__('You did not apply for that absence', true));
			$this->redirect(array('action' => 'index'));
		}

		$conditions = array(
			'Application.user_id' => $user['User']['id'],
			'Application.absence_id' => $id
		);
		if ($this->Absence->Application->deleteAll($conditions)) {
			$this->Session->setFlash('Application deleted successfully');
		} else {
			$this->Session->setFlash('Application was not deleted successfully');
		}
		$this->redirect(array('action' => 'index'));
	}

	function accept($absence_id, $substitute_id) {
		if (!$absence_id || !$substitute_id) {
			$this->Session->setFlash(__('Invalid absence or substitute', true));
			$this->redirect(array('action' => 'index'));
		}

		// check for ownership
		$user = $this->Session->read('User');
		$absence = $this->Absence->read(array('id', 'absentee_id', 'fulfiller_id'), $absence_id);
		if (!$this->Absence->isAbsenceOwnedByUser($absence_id, $user['User']['id'])) {
			$this->Session->setFlash('You do not have permission to edit that absence');
			$this->redirect(array('action' => 'index'));
		}

		// did this sub actually submit an application?
		$tmp = $this->Absence->Application->findApplicationsByAbsenceAndUser($absence_id, $substitute_id);
		if (empty($tmp)) {
			$this->Session->setFlash('That user did not apply for this absence');
			$this->redirect(array('action' => 'index'));
		}

		// give this sub the absence and clear the applications
		$absence['Absence']['fulfiller_id'] = $substitute_id;
		if ($this->Absence->save($absence)) {
			$this->Absence->Application->deleteAllApplicationsByAbsence($absence_id);
			$this->Session->setFlash('Substitute accepted');
			$this->redirect(array('action' => 'view', $absence_id));
		} else {
			$this->Session->setFlash('Substitute accepted');
			$this->redirect(array('action' => 'index'));
		}
	}

	function _send_email_notification($options, $absence_id) {
		$this->Absence->recursive = 2;
		if (empty($options) || !isset($options['message_type']) || empty($absence_id)) {
			$this->Session->setFlash('Email notification not sent');
		} else {
			$absence = $this->Absence->read(array('start', 'absentee_id', 'fulfiller_id'), $absence_id);
			if ($absence['Absentee']['absence_change_notify']) {
				$date = $absence['Absence']['start'];
				$absentee_email = $absence['Absentee']['email_address'];
				/*$this->Email->smtpOptions = array(
					'port' => '465',
					'host' => 'ssl://smtp.gmail.com',
					'username' => 'jahabrewer@gmail.com',
					'password' => 
				);
				$this->Email->delivery = 'smtp';*/
				$this->Email->delivery = 'debug';
				$this->Email->from = 'Fable <noreply@example.com>';
				$this->Email->to = $absentee_email;

				switch ($options['message_type']) {
				case 'taken':
					$fulfiller_name = $absence['Fulfiller']['first_name'] . ' ' . $absence['Fulfiller']['last_name'];
					$this->Email->subject = 'Absence Fulfilled';
					$this->Email->send('Your absence beginning on ' . $date . ' was fulfilled by ' . $fulfiller_name . '.');
					break;
				case 'released':
					$this->Email->subject = 'Absence Released';
					$this->Email->send('Your absence beginning on ' . $date . ' was released.');
				}
			}
		}
		$this->redirect(array('action' => 'index'));
	}
}
