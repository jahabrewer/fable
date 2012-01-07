<?php
class AbsencesController extends AppController {

	var $name = 'Absences';
	var $helpers = array('Time', 'Html', 'Js');
	var $components = array('Email', 'RequestHandler');

	function index() {
		$type = 'null';

		$viewer_id = $this->viewVars['viewer_id'];
		$viewer_is_admin = $this->viewVars['viewer_is_admin'];
		$viewer_is_teacher = $this->viewVars['viewer_is_teacher'];
		$viewer_is_substitute = $this->viewVars['viewer_is_substitute'];

		// default to no highlighting
		$highlight_mine = false;
		$highlight_available = false;
		$highlight_pending = false;
		$highlight_fulfilled = false;
		$highlight_expired = false;
		$highlight_all = false;

		// handle filters
		if (isset($this->params['named']['filter'])) {
			$filter = $this->params['named']['filter'];
			if ($filter == 'available') {
				$this->paginate = array(
					'conditions' => array('Absence.start > NOW() AND Absence.fulfiller_id IS NULL')
				);
				$type = 'Available';
				$highlight_available = true;
			} elseif ($filter == 'my') {
				$this->paginate = array(
					'conditions' => array(
						'OR' => array(
							'Absence.fulfiller_id' => $viewer_id,
							'Absence.absentee_id' => $viewer_id,
						),
						'Absence.start > NOW()',
					),
				);
				$type = 'My';
				$highlight_mine = true;
			} elseif ($filter == 'pending') {
				$this->paginate = array('Application' => array(
					'conditions' => array('Application.user_id' => $viewer_id),
					'contain' => array(
						'Absence.Absentee.username',
						'Absence.Fulfiller.username',
						'Absence.School.name',
					),
				));
				$type = 'Pending';
				$highlight_pending = true;
			} elseif ($filter == 'expired') {
				$this->paginate = array(
					'conditions' => array('Absence.start <= NOW()')
				);
				$type = 'Expired';
				$highlight_expired = true;
			} elseif ($filter == 'fulfilled') {
				$this->paginate = array(
					'conditions' => array('Absence.fulfiller_id IS NOT NULL')
				);
				$type = 'Fulfilled';
				$highlight_fulfilled = true;
			} elseif ($filter == 'all') {
				$this->paginate = array();
				$type = 'All';
				$highlight_all = true;
			}
		} else {
			// default behavior (no filter)
			if ($viewer_is_admin) {
				$this->paginate = array(
					'conditions' => array('Absence.start > NOW() AND Absence.fulfiller_id IS NULL')
				);
				$type = 'Available';
				$highlight_available = true;
			} else {
				$this->paginate = array(
					'conditions' => array(
						'OR' => array(
							'Absence.fulfiller_id' => $viewer_id,
							'Absence.absentee_id' => $viewer_id,
						),
						'Absence.start > NOW()',
					),
				);
				$type = 'My';
				$highlight_mine = true;
			}
		}

		$show_my_filter = !$viewer_is_admin;
		$show_add = $viewer_is_teacher;
		$show_pending_filter = $viewer_is_substitute;
		$show_available_filter = !$viewer_is_teacher;
		// when using the pending filter, the results array is
		// constructed differently because the information comes from
		// application
		$use_alt_array = isset($filter) && ($filter == 'pending');

		// retrieve notifications
		$notifications = $this->Absence->Notification->find('all', array(
			'conditions' => array(
				'Notification.user_id' => $viewer_id,
			),
			'contain' => array(
				'Absence.start',
				'Other.first_name',
				'Other.last_name',
				'NotificationType.string',
			),
			'limit' => 5,
		));

		// mark viewer's notifications as not new
		$this->Absence->Notification->updateAll(
			array('Notification.new' => 0),
			array('Notification.user_id' => $viewer_id)
		);

		$this->Absence->recursive = 1;
		$absences = $use_alt_array ? $this->paginate('Application') : $this->paginate();
		$this->set(compact('absences', 'notifications', 'type', 'show_my_filter', 'show_pending_filter', 'show_available_filter', 'highlight_mine', 'highlight_available', 'highlight_fulfilled', 'highlight_expired', 'highlight_all', 'highlight_pending', 'show_add', 'use_alt_array'));
		$this->render('/absences/index');
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Absence->recursive = 2;
		$viewer_id = $this->viewVars['viewer_id'];
		$viewer_is_admin = $this->viewVars['viewer_is_admin'];
		$viewer_is_substitute = $this->viewVars['viewer_is_substitute'];

		$user = $this->Session->read('User');

		$absence = $this->Absence->read(null, $id);
		$application = $this->Absence->Application->find('first', array('conditions' => array('absence_id' => $id, 'user_id' => $viewer_id)));
		$absence_is_fulfilled = !empty($absence['Absence']['fulfiller_id']);
		$absence_is_in_future = $this->Absence->isAbsenceInFuture($absence['Absence']);
		$viewer_is_fulfiller = isset($absence['Absence']['fulfiller_id']) && ($absence['Absence']['fulfiller_id'] == $viewer_id);
		$viewer_is_absentee = isset($absence['Absence']['absentee_id']) && ($absence['Absence']['absentee_id'] == $viewer_id);
		$viewer_is_applicant = !empty($application);

		// set view vars
		$show_edit = $viewer_is_admin || $viewer_is_absentee;
		$show_delete = $viewer_is_admin || $viewer_is_absentee;
		$show_created = $viewer_is_admin;
		$show_modified = $viewer_is_admin;
		// show apply only if sub has no application and the absence
		// isn't fulfilled
		$show_apply = $viewer_is_substitute && !$viewer_is_applicant && !$absence_is_fulfilled && $absence_is_in_future;
		// show release only if the viewer is the fulfiller
		$show_release = $viewer_is_fulfiller;
		// show retract only if the viewer has applied for the absence
		$show_retract = $viewer_is_applicant;
		// only show applications to admins and owners
		$show_applications = ($viewer_is_admin || $viewer_is_absentee) && $absence_is_in_future && !$absence_is_fulfilled;
		// to notify user that she has applied for the absence
		$show_application_deny_mesg = $viewer_is_substitute && !$show_apply;
		$show_sub_status = $viewer_is_substitute && $absence_is_in_future;
		$sub_status_1 = !$viewer_is_applicant && !$absence_is_fulfilled;
		$sub_status_2 = $viewer_is_applicant;
		$sub_status_3 = $absence_is_fulfilled;
		if ($viewer_is_fulfiller) {
			$application_deny_mesg = 'You are this absence\'s fulfiller';
		} else if ($absence_is_fulfilled) {
			$application_deny_mesg = 'This absence is being fulfilled by someone else';
		} else if (!$absence_is_in_future) {
			$application_deny_mesg = 'This absence has already happened';
		} else {
			$application_deny_mesg = 'Teacher decision';
		}

		// permissions
		$allow_applicant_selection = $viewer_is_absentee;

		$this->set(compact('user', 'absence', 'show_edit', 'show_delete', 'show_created', 'show_modified', 'show_apply', 'show_release', 'show_applications', 'application_deny_mesg', 'show_application_deny_mesg', 'allow_applicant_selection', 'show_retract', 'show_sub_status', 'sub_status_1', 'sub_status_2', 'sub_status_3'));
		$this->render('/absences/view');
	}

	function add() {
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}

		// check for ownership
		$viewer_id = $this->viewVars['viewer_id'];
		$viewer_is_admin = $this->viewVars['viewer_is_admin'];
		if (!$viewer_is_admin && !$this->Absence->isAbsenceOwnedByUser($id, $viewer_id)) {
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
		} else {
			$this->data = $this->Absence->read(null, $id);
		}
		$absentees = $this->Absence->Absentee->find('list', array('conditions' => 'Absentee.user_type_id = 2'));
		$fulfillers = $this->Absence->Fulfiller->find('list', array('conditions' => 'Fulfiller.user_type_id = 3'));
		$schools = $this->Absence->School->find('list');
		$allow_absentee_change = $viewer_is_admin;
		$this->set(compact('absentees', 'fulfillers', 'schools', 'allow_absentee_change'));
		$this->render('/absences/edit');
	}

	function delete($id = null) {
	}

	function substitute_release($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for absence', true));
			$this->redirect(array('action'=>'index'));
		}

		// check for fulfiller_id match
		$viewer_id = $this->viewVars['viewer_id'];
		$this->data = $this->Absence->read(null, $id);
		if ($this->Absence->isAbsenceFulfilledByUser($id, $viewer_id)) {
			$this->data['Absence']['fulfiller_id'] = null;
			if ($this->Absence->save($this->data)) {
				$this->Session->setFlash(__('The absence has been released', true));

				// send notification
				$absence = $this->Absence->read('absentee_id', $id);
				$this->_create_notification('absence_released', $id, $absence['Absence']['absentee_id'], $viewer_id);
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
		$this->view($id);
	}

	/*
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
	*/

	function admin_edit($id = null) {
		$this->edit($id);
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

	function substitute_apply($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}

		$viewer_id = $this->viewVars['viewer_id'];
		$viewer_is_substitute = $this->viewVars['viewer_is_substitute'];

		// check for substitute status
		if (!$viewer_is_substitute) {
			$this->Session->setFlash('You must be a substitute to apply for absences');
			$this->redirect(array('action' => 'index'));
		}

		$data = array(
			'user_id' => $viewer_id,
			'absence_id' => $id,
		);
		if ($this->Absence->Application->save($data)) {
			$this->Session->setFlash('Application successful');

			// send notification
			$absence = $this->Absence->read('absentee_id', $id);
			$this->_create_notification('application_submitted', $id, $absence['Absence']['absentee_id'], $viewer_id);
		} else {
			$this->Session->setFlash('You have already applied for that absence');
		}
		$this->redirect(array('action' => 'view', $id));
	}

	function substitute_retract($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid absence', true));
			$this->redirect(array('action' => 'index'));
		}

		$viewer_id = $this->viewVars['viewer_id'];

		// has the user applied? (deleteall works regardlessly, but
		// the successful delete message will confuse users)
		$tmp = $this->Absence->Application->findApplicationsByAbsenceAndUser($id, $viewer_id);
		if (empty($tmp)) {
			$this->Session->setFlash(__('You did not apply for that absence', true));
			$this->redirect(array('action' => 'index'));
		}

		$conditions = array(
			'Application.user_id' => $viewer_id,
			'Application.absence_id' => $id
		);
		if ($this->Absence->Application->deleteAll($conditions)) {
			$this->Session->setFlash('Application retracted');

			// send notification
			$absence = $this->Absence->read('absentee_id', $id);
			$this->_create_notification('application_retracted', $id, $absence['Absence']['absentee_id'], $viewer_id);
		} else {
			$this->Session->setFlash('Application was not retracted successfully');
		}
		$this->redirect(array('action' => 'view', $id));
	}

	function substitute_index($filter = null) {
		$this->index();
	}

	function substitute_view($id = null) {
		$this->view($id);

		$user = $this->Session->read('User');
		$application = $this->Absence->Application->find('first', array('conditions' => array('absence_id' => $id, 'user_id' => $user['User']['id'])));
		// show apply only if user has no application and the absence
		// isn't fulfilled
		$show_apply = empty($application) && !$this->Absence->isAbsenceFulfilled($id);
		// show release only if the user is the fulfiller
		$show_release = $this->Absence->isAbsenceFulfilledByUser($id, $user['User']['id']);
		// to notify user that she has applied for the absence
		$show_applied_message = !empty($application);
		$this->set(compact('self_fulfilled', 'show_apply', 'show_release', 'show_applied_message'));
	}

	function teacher_index() {
		$this->index();
	}

	function teacher_add() {
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

		// set absentee to self
		$this->data['Absence']['absentee_id'] = $user['User']['id'];

		$absentees = $this->Absence->Absentee->find('list', array('conditions' => 'Absentee.user_type_id = 2'));
		$fulfillers = $this->Absence->Fulfiller->find('list', array('conditions' => 'Fulfiller.user_type_id = 3'));
		$schools = $this->Absence->School->find('list');
		$this->set(compact('absentees', 'fulfillers', 'schools'));
	}

	function teacher_view($id = null) {
		$this->view($id);

		$user = $this->Session->read('User');
		$this->set('self_owned', $this->Absence->isAbsenceOwnedByUser($id, $user['User']['id']));
	}

	function teacher_edit($id = null) {
		$this->edit($id);
	}

	function teacher_delete($id = null) {
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
}
