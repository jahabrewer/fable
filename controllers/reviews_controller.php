<?php
class ReviewsController extends AppController {

	var $name = 'Reviews';

	function index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid review', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Review->recursive = 0;
		$this->set('review', $this->Review->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Review->create();
			if ($this->Review->save($this->data)) {
				$this->Session->setFlash(__('The review has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.', true));
			}
		}
		$subjects = $this->Review->Subject->find('list', array(
			'conditions' => array('Subject.user_type_id' => 3)
		));
		$this->set(compact('subjects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid review', true));
			$this->redirect(array('action' => 'index'));
		}

		// check for ownership
		$user = $this->Session->read('User');
		$review = $this->Review->read('author_id', $id);
		if ($review['Review']['author_id'] != $user['User']['id']) {
			$this->Session->setFlash('You do not have permission to edit that review');
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if ($this->Review->save($this->data)) {
				$this->Session->setFlash(__('The review has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The review could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Review->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for review', true));
			$this->redirect(array('action'=>'index'));
		}

		// check for ownership
		$user = $this->Session->read('User');
		$review = $this->Review->read('author_id', $id);
		if ($review['Review']['author_id'] != $user['User']['id']) {
			$this->Session->setFlash('You do not have permission to delete that review');
			$this->redirect(array('action' => 'index'));
		}

		if ($this->Review->delete($id)) {
			$this->Session->setFlash(__('Review deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Review was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid review', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('review', $this->Review->read(null, $id));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for review', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Review->delete($id)) {
			$this->Session->setFlash(__('Review deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Review was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
