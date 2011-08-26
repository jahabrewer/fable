<?php
class ApplicationsController extends AppController {

	var $name = 'Applications';

	function teacher_accept($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid application', true));
			$this->redirect(array('controller' => 'absences', 'action' => 'index'));
		}

		// check for ownership
		$user = $this->Session->read('User');
		$application = $this->Application->read(null, $id);
		$absence = $this->Application->Absence->read(array('id', 'absentee_id', 'fulfiller_id'), $application['Application']['absence_id']);
		if (!$this->Application->Absence->isAbsenceOwnedByUser($application['Application']['absence_id'], $user['User']['id'])) {
			$this->Session->setFlash('You do not have permission to edit that absence');
			$this->redirect(array('controller' => 'absences', 'action' => 'index'));
		}

		// give this sub the absence and clear the applications
		$absence['Absence']['fulfiller_id'] = $application['Application']['user_id'];
		if ($this->Application->Absence->save($absence)) {
			$this->Application->deleteAllApplicationsByAbsence($application['Application']['absence_id']);
			$this->Session->setFlash('Substitute accepted');
			$this->redirect(array('controller' => 'absences', 'action' => 'view', $application['Application']['absence_id']));
		} else {
			$this->Session->setFlash('Substitute could not be accepted');
			$this->redirect(array('controller' => 'absences', 'action' => 'index'));
		}
	}
}
