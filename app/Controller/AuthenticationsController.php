<?php
App::uses('AppController', 'Controller');
/**
 * Authentications Controller
 *
 * @property Authentication $Authentication
 */
class AuthenticationsController extends AppController {
public $paginate = array('limit' => 100,'order' => array('Authentication.id' => 'desc'));
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You do not have permissions to view authentications'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
		$this->Authentication->recursive = 0;
		$this->set('authentications', $this->paginate());
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You do not have permissions to view authentications'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			$this->Authentication->id = $id;
			if (!$this->Authentication->exists()) {
				throw new NotFoundException(__('Invalid authentication'));
			}
			$this->set('authentication', $this->Authentication->read(null, $id));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->Session->setFlash(__('Authentications can not be added, edited, or deleted, as they are created automatically by the system'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Session->setFlash(__('Authentications can not be added, edited, or deleted, as they are created automatically by the system'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Session->setFlash(__('Authentications can not be added, edited, or deleted, as they are created automatically by the system'));
		$this->redirect(array('action' => 'index'));
	}
}
