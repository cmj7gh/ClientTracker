<?php
App::uses('AppController', 'Controller');
/**
 * Scholarships Controller
 *
 * @property Scholarship $Scholarship
 */
class ScholarshipsController extends AppController {
public $uses = array('Scholarship', 'Student');
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
			$this->Scholarship->recursive = 0;
			$this->set('Scholarships', $this->paginate());
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
			if (!$this->Scholarship->exists($id)) {
				throw new NotFoundException(__('Invalid Scholarship'));
			}
			$options = array('conditions' => array('Scholarship.' . $this->Scholarship->primaryKey => $id));
			$this->set('Scholarship', $this->Scholarship->find('first', $options));
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
				$this->Scholarship->create();
				if ($this->Scholarship->save($this->request->data)) {
					$this->Session->setFlash(__('The Scholarship has been saved'), 'flash_good');
					$this->redirect(array('controller'=>'students','action' => 'view',$this->request->data['Scholarship']['student_id']));
				} else {
					$this->Session->setFlash(__('The Scholarship could not be saved. Please, try again.'));
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
			if (!$this->Scholarship->exists($id)) {
				throw new NotFoundException(__('Invalid Scholarship'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Scholarship->save($this->request->data)) {
					$this->Session->setFlash(__('The Scholarship has been saved'), 'flash_good');
					$this->redirect(array('controller'=>'students','action' => 'view',$this->request->data['Scholarship']['student_id']));
				} else {
					$this->Session->setFlash(__('The Scholarship could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Scholarship.' . $this->Scholarship->primaryKey => $id));
				$this->request->data = $this->Scholarship->find('first', $options);
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
			$this->Scholarship->id = $id;
			if (!$this->Scholarship->exists()) {
				throw new NotFoundException(__('Invalid Scholarship'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Scholarship->delete()) {
				$this->Session->setFlash(__('Scholarship deleted'), 'flash_bad');
				$this->redirect(array('controller'=>'students','action' => 'index'));
			}
			$this->Session->setFlash(__('Scholarship was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
