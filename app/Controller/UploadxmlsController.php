<?php
App::uses('AppController', 'Controller');

class UploadxmlsController extends AppController {

	public $components = array('Paginator');

	public function add() {
		if ($this->request->is('post')) {
			$this->Uploadxml->create();
			if ($this->Uploadxml->save($this->request->data)) {
				$this->Session->setFlash(__('The xml file has been saved.'));
				return $this->redirect(array('controller' => 'pages','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The xml file could not be saved. Please, try again.'));
				return $this->redirect(array('controller' => 'pages','action' => 'index'));
			}
		}
	}


	public function edit($id = null) {
		
		if (!$this->Uploadxml->exists($id)) {
			throw new NotFoundException(__('Invalid uploadxml'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Uploadxml']['id'] = $id;
			if ($this->Uploadxml->save($this->request->data)) {
				$this->Session->setFlash(__('The xml file has been edited'));
				return $this->redirect(array('controller' => 'pages','action' => 'index'));
			} else {
				$this->Session->setFlash(__('The xml file could not be saved. Please, try again.'));
				return $this->redirect(array('controller' => 'pages','action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Uploadxml.' . $this->Uploadxml->primaryKey => $id));
			$this->request->data = $this->Uploadxml->find('first', $options);
		}
	}

}
