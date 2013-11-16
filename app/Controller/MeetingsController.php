<?php
App::uses('AppController', 'Controller');
/**
 * Meetings Controller
 *
 * @property Meeting $Meeting
 */
class MeetingsController extends AppController {
public $uses = array('School', 'Center', 'User', 'Meeting', 'Student');
/**
 * index method
 *
 * @return void
 */
	public function index($who = null) {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			$this->Meeting->recursive = 0;
			$this->set('schools', $this->Meeting->Center->find('list'));
			if(isset($who) && $who == 'my'){
				$schools = $this->School->query("SELECT users_centers.center_id FROM users JOIN users_centers on users_centers.user_id = users.id
													WHERE users.id = " . $this->currentUser['id']);
				$school_ids = array();
				foreach($schools as $s){
					$school_ids[] = $s['users_centers']['center_id'];
				}
				//var_dump($school_ids);
				$this->set('meetings', $this->paginate('Meeting', array('center_id IN' => $school_ids)));
			}else{
				$this->set('meetings', $this->paginate('Meeting'));
			}
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
			if (!$this->Meeting->exists($id)) {
				throw new NotFoundException(__('Invalid meeting'));
			}
			$options = array('conditions' => array('Meeting.' . $this->Meeting->primaryKey => $id));
			$this->set('meeting', $this->Meeting->find('first', $options));
			$this->set('schools', $this->Meeting->School->find('list'));
		}
	}
	
	
	
		public function before_add() {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			if ($this->request->is('post')) {
				//die(var_dump($this->request->data));
				$locations = implode('|', $this->request->data['Center']);
				//die(var_dump($locations));
				$this->redirect(array('action' => 'add', $locations));
			}
			$centers = $this->Center->query("SELECT centers.id 
											FROM users_centers 
												JOIN centers on users_centers.center_id = centers.id
											WHERE users_centers.user_id = " . $this->currentUser['id']);
			$center_ids = array();
			foreach($centers as $c){
				$center_ids[] = $c['centers']['id'];
			}
			$this->set('center_ids', $center_ids);
			//var_dump($school_ids);
			$this->set('centers', $this->Meeting->Center->find('list'));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add($locations = null) {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			if ($this->request->is('post')) {
				$requestData = $this->request->data;
				$requestData['User']['0'] = $this->currentUser['id'];
				$requestData['Meeting']['semester'] = $this->currentSemester;
				if(isset($locations)){
					$locs = explode('|', $locations);
					$requestData['Meeting']['school_id'] = $locs[0];
					
				}
				$this->Meeting->create();
				if ($this->Meeting->save($requestData)) {
					$this->Session->setFlash(__('The meeting has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The meeting could not be saved. Please, try again.'), 'flash_bad');
				}
			}
				if(isset($locations)){
					$locations = explode('|', $locations);
					echo($locations[0]);
					$students = $this->School->Student->find('all', array('conditions' => array('School.center_id' => $locations[0])));
					/*$students = $this->Student->query("SELECT students.id, CONCAT(students.first_name, ' ', students.last_name) as name 
								FROM students 
									JOIN schools on students.school_id = schools.id
								WHERE schools.center_id = " . $locations[0]);
					$student_ids = array();
					foreach($students as $s){
						var_dump($s);
						$students[] = array('Student' => array('id' =>$s['students']['id'], 'name' => $s[0]['name']));
					}*/
				}else{
					$students = $this->Meeting->Student->find('all');
				}
				$users = $this->Meeting->User->find('list');
				$schools = $this->Meeting->Center->School->find('list');
				$this->set(compact('students', 'users', 'schools'));	
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
			if (!$this->Meeting->exists($id)) {
				throw new NotFoundException(__('Invalid meeting'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Meeting->save($this->request->data)) {
					$this->Session->setFlash(__('The meeting has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The meeting could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Meeting.' . $this->Meeting->primaryKey => $id));
				$this->request->data = $this->Meeting->find('first', $options);
			}
			$students = $this->Meeting->Student->find('all');
			$users = $this->Meeting->User->find('list');
			$schools = $this->Meeting->School->find('list');
			$this->set(compact('students', 'users', 'schools'));
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
			$this->Meeting->id = $id;
			if (!$this->Meeting->exists()) {
				throw new NotFoundException(__('Invalid meeting'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Meeting->delete()) {
				$this->Session->setFlash(__('Meeting deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Meeting was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
