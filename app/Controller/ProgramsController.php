<?php
App::uses('AppController', 'Controller');
/**
 * Programs Controller
 *
 * @property Program $Program
 */
class ProgramsController extends AppController {

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
			$this->Program->recursive = 0;
			$this->set('programs', $this->paginate());
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
			if (!$this->Program->exists($id)) {
				throw new NotFoundException(__('Invalid program'));
			}
			$options = array('conditions' => array('Program.' . $this->Program->primaryKey => $id));
			$this->set('program', $this->Program->find('first', $options));
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
			$schools = $this->Program->School->find('list');
			$programtypes = $this->Program->Programtype->find('list');
			$this->set(compact('schools','programtypes'));
			if ($this->request->is('post')) {
				$requestData = $this->request->data;
				$requestData['School']['schoolName'] = $schools[$requestData['School']['school_id']];
				$requestData['School']['programtypeName'] = $programtypes[$requestData['School']['programtype_id']];
				$requestData['School']['programName'] = $requestData['School']['programtypeName'] . ' at ' . $requestData['School']['schoolName']; //eg. "CE-BELL at Wheaton High School"
				$this->Program->create();
				if ($this->Program->save(array('Program'=>array('name'=>$requestData['School']['programName'],'programtype_id' => $requestData['School']['programtype_id'])))) {
					$this->Program->query("INSERT INTO programs_Schools(program_id, school_id) VALUES (" . $this->Program->id . ',' . $requestData['School']['school_id'] . ")");
					$this->Session->setFlash(__('The program has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The program could not be saved. Please, try again.'));
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
			if (!$this->Program->exists($id)) {
				throw new NotFoundException(__('Invalid program'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Program->save($this->request->data)) {
					$this->Session->setFlash(__('The program has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The program could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Program.' . $this->Program->primaryKey => $id));
				$this->request->data = $this->Program->find('first', $options);
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
			$this->Program->id = $id;
			if (!$this->Program->exists()) {
				throw new NotFoundException(__('Invalid program'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Program->delete()) {
				$this->Session->setFlash(__('Program deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Program was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
