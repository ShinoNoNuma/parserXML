<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {
		  public $components = array(
        'RequestHandler',
        'Session'
    );
    public $helpers = array('Html', 'Form', 'Session');

     public function beforeFilter() {
      if ($this->request->is('ajax')) {
    $this->layout=null;

}
}
}
