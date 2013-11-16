<?php
App::uses('AppController', 'Controller');
/**
 * Services Controller
 *
 * @property Service $Service
 */
class ServicesController extends AppController {
public $uses = array('Service', 'Student');
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
			$this->Service->recursive = 0;
			$this->set('Services', $this->paginate());
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
			if (!$this->Service->exists($id)) {
				throw new NotFoundException(__('Invalid Service'));
			}
			$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
			$this->set('Service', $this->Service->find('first', $options));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add($student_id = null) {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			if ($this->request->is('post')) {
				$this->Service->create();
				if ($this->Service->save($this->request->data)) {
					$this->Session->setFlash(__('The Service has been saved'), 'flash_good');
					$this->redirect(array('controller'=>'students','action' => 'view',$this->request->data['Service']['student_id']));
				} else {
					$this->Session->setFlash(__('The Service could not be saved. Please, try again.'));
				}
			}
			$students = $this->Student->find('list');
			$this->set(compact('students', 'student_id'));
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
			if (!$this->Service->exists($id)) {
				throw new NotFoundException(__('Invalid Service'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Service->save($this->request->data)) {
					$this->Session->setFlash(__('The Service has been saved'), 'flash_good');
					$this->redirect(array('controller'=>'students','action' => 'view',$this->request->data['Service']['student_id']));
				} else {
					$this->Session->setFlash(__('The Service could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
				$this->request->data = $this->Service->find('first', $options);
				$students = $this->Student->find('list');
				$this->set(compact('students', 'student_id'));
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
			$this->Service->id = $id;
			if (!$this->Service->exists()) {
				throw new NotFoundException(__('Invalid Service'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Service->delete()) {
				$this->Session->setFlash(__('Service deleted'), 'flash_bad');
				$this->redirect(array('controller'=>'students','action' => 'index'));
			}
			$this->Session->setFlash(__('Service was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
