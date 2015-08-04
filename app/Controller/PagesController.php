<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController {

	public $uses = array();

	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}

		$this->loadModel('Uploadxml');

		$this->loadModel('Parsefile');
		$uploadxmls = $this->Uploadxml->find('all');	
			$parsefiles = $this->Parsefile->find('all', array(
			'joins' => array(
				array(
					'table' => 'uploadxmls',
					'type' => 'INNER',
					'conditions' => array(
						'uploadxmls.id = Parsefile.id_uploadxml',
						)
					)
				),

			'fields' => array('uploadxmls.*', 'Parsefile.*'),
			'order' => 'Parsefile.id_uploadxml ASC',
			));
		$this->set(compact('page', 'subpage', 'title_for_layout','uploadxmls','parsefiles'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

}
