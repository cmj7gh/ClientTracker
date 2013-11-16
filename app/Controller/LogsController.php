<?php
App::uses('AppController', 'Controller');
/**
 * Logs Controller
 *
 * @property Log $Log
 */
class LogsController extends AppController {
public $paginate = array('limit' => 100,'order' => array('Log.id' => 'desc'));

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
			$this->Log->recursive = 0;
			$this->set('logs', $this->paginate());
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
			$this->Log->id = $id;
			if (!$this->Log->exists()) {
				throw new NotFoundException(__('Invalid log'));
			}
			$this->set('log', $this->Log->read(null, $id));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->Session->setFlash(__('Logs can not be added, edited, or deleted, as they are created automatically by the system'));
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
		$this->Session->setFlash(__('Logs can not be added, edited, or deleted, as they are created automatically by the system'));
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
		$this->Session->setFlash(__('Logs can not be added, edited, or deleted, as they are created automatically by the system'));
 	  $this->redirect(array('action' => 'index'));
	}
}
