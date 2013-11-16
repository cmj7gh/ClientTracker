<?php
App::uses('AppController', 'Controller');
/**
 * Schools Controller
 *
 * @property School $School
 */
class SchoolsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			$this->School->recursive = 0;
			$this->set('schools', $this->paginate());
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
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			if (!$this->School->exists($id)) {
				throw new NotFoundException(__('Invalid school'));
			}
			$options = array('conditions' => array('School.' . $this->School->primaryKey => $id));
			$this->set('school', $this->School->find('first', $options));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			if ($this->request->is('post')) {
				$this->School->create();
				if ($this->School->save($this->request->data)) {
					$this->Session->setFlash(__('The school has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The school could not be saved. Please, try again.'));
				}
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			if (!$this->School->exists($id)) {
				throw new NotFoundException(__('Invalid school'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->School->save($this->request->data)) {
					$this->Session->setFlash(__('The school has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The school could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('School.' . $this->School->primaryKey => $id));
				$this->request->data = $this->School->find('first', $options);
			}
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			$this->School->id = $id;
			if (!$this->School->exists()) {
				throw new NotFoundException(__('Invalid school'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->School->delete()) {
				$this->Session->setFlash(__('School deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('School was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
