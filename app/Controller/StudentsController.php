<?php
App::uses('Sanitize', 'Utility', 'AppController', 'Controller');
/**
 * Students Controller
 *
 * @property Student $Student
 */
class StudentsController extends AppController {
public $uses = array('School', 'User', 'Student', 'Semester');

    public $paginate = array(
        'limit' => 100
    );

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
			$this->Student->recursive = 0;
			if(isset($who) && $who == 'my'){
				$schools = $this->School->query("SELECT users_schools.school_id FROM users JOIN users_schools on users_schools.user_id = users.id
													WHERE users.id = " . $this->currentUser['id']);
				$school_ids = array();
				foreach($schools as $s){
					$school_ids[] = $s['users_schools']['school_id'];
				}
				//var_dump($school_ids);
				$this->set('students', $this->paginate('Student', array('Student.school_id IN' => $school_ids, 'graduated' =>false, 'civics_status !=' => 'none')));
			}else if(isset($who) && $who == 'alumni'){
				$this->set('students', $this->paginate('Student', array('graduated'=>true, 'civics_status'=>'member')));
			}else if(isset($who) && $who == 'started'){
				$this->set('students', $this->paginate('Student', array('civics_status != '=>'member')));
			}else if(isset($who) && $who == 'members'){
				$this->set('students', $this->paginate('Student', array('civics_status'=>'member')));
			}else{
				$this->set('students', $this->paginate('Student'));
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
			if (!$this->Student->exists($id)) {
				throw new NotFoundException(__('Invalid student'));
			}
			$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
			$this->set('student', $this->Student->find('first', $options));
			$semesters = $this->Student->Semester->find('list', array('order'=> 'startingDate'));
			$this->set(compact('semesters'));
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
				$this->Student->create();
				$requestData = $this->request->data;
				$requestData['Student']['modified_by'] = $this->currentUser['display_name'];
				
				//if the student is a member, set their civics_status to "member", and add semester_member to their semesters_active
				//if the student is not a member, but they started, set their civics_status to "started"
				if(isset($requestData['Student']['semester_started']) && $requestData['Student']['semester_started'] != ''){
					$requestData['Student']['civics_status'] = 'started';
				}
				if(isset($requestData['Student']['semester_started']) && $requestData['Student']['semester_started'] != '' && isset($requestData['Student']['semester_member']) && $requestData['Student']['semester_member'] != ''){
					$requestData['Student']['civics_status'] = 'member';
				}

				
				if ($this->Student->save($requestData)) {
					//update semesters_active
					if(isset($requestData['Student']['semester_started']) && $requestData['Student']['semester_started'] != '' && isset($requestData['Student']['semester_member']) && $requestData['Student']['semester_member'] != ''){
						$result = $this->Student->query("INSERT INTO students_semesters(student_id, semester_id) values (" . $this->Student->id . ", " . $requestData['Student']['semester_member'] . ")");
					}
					$this->Session->setFlash(__('The student has been saved'), 'flash_good');
					$this->redirect(array('action' => 'view',$this->Student->id));
				} else {
					$this->Session->setFlash(__('The student could not be saved. Please, try again.'));
				}
			}
			$schools = $this->Student->School->find('list');
			$semesters = $this->Student->Semester->find('list');
			$meetings = $this->Student->Meeting->find('list');
			$this->set(compact('schools', 'meetings', 'semesters'));
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
			if (!$this->Student->exists($id)) {
				throw new NotFoundException(__('Invalid student'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				//die(var_dump($this->request->data));
				$requestData = $this->request->data;
				$requestData['Student']['modified_by'] = $this->currentUser['display_name'];
				if(isset($requestData['Student']['semester_started']) && $requestData['Student']['semester_started'] != ''){
					$requestData['Student']['civics_status'] = 'started';
				}
				if(isset($requestData['Student']['semester_started']) && $requestData['Student']['semester_started'] != '' && isset($requestData['Student']['semester_member']) && $requestData['Student']['semester_member'] != ''){
					$requestData['Student']['civics_status'] = 'member';
				}
				if(isset($requestData['Student']['semester_started']) && $requestData['Student']['semester_started'] != '' && isset($requestData['Student']['semester_member']) && $requestData['Student']['semester_member'] != ''){
						$result = $this->Student->query("INSERT IGNORE INTO students_semesters(student_id, semester_id) values (" . $id . ", " . $requestData['Student']['semester_member'] . ")");
				}
				
				if ($this->Student->save($requestData)) {
					$this->Session->setFlash(__('The student has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The student could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
				$this->request->data = $this->Student->find('first', $options);
			}
			$schools = $this->Student->School->find('list');
			$meetings = $this->Student->Meeting->find('list');
			$semesters = $this->Student->Semester->find('list');
			$this->set(compact('schools', 'meetings', 'semesters'));
			$options = array('conditions' => array('Student.' . $this->Student->primaryKey => $id));
			$this->set('student', $this->Student->find('first', $options));
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
			$this->Student->id = $id;
			if (!$this->Student->exists()) {
				throw new NotFoundException(__('Invalid student'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Student->delete()) {
				$this->Session->setFlash(__('Student deleted'), 'flash_good');
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Student was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function search() {
		if($this->request->is('get')) {
			$conditions = array();
			if(isset($_GET['searchString'])){
				$searchString = Sanitize::clean($_GET['searchString']);
			}
			if(isset($_GET['searchType'])){
				$searchType = Sanitize::clean($_GET['searchType']);
			}
			if (isset($searchString) && isset($searchType) && $searchString != null && $searchType != null) {
				$conditions = array("$searchType LIKE" => '%' . str_replace(' ', '%', $searchString) . '%');
			}
			$results = $this->Paginate('Student', $conditions);
			$this->set('students', $results);
		}else {
			$this->Session->setFlash(__("not post"), 'flash_good');
			$results = $this->Paginate('Student');
			$this->set('students', $results);
		}
	}
	
	public function addSemester($id = null) {
		if($this->request->is('post')) {
			$semester = $this->request->data['Student']['semester'];
			if ($id != null && $semester != null) {
				$result = $this->Student->query("INSERT IGNORE INTO students_semesters(student_id, semester_id) values (" . $id . ", " . $semester . ")");
				if($result){
								$this->Session->setFlash(__('Semester Added'), 'flash_good');
								$this->redirect(array('action' => 'view', $id));
				}
			}
		}
								$this->Session->setFlash(__('Semester Added'), 'flash_good');
								$this->redirect(array('action' => 'view', $id));
	}
}
