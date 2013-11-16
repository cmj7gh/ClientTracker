<?php
App::uses('AppController', 'Controller');
/**
 * Settings Controller
 *
 * @property Setting $Setting
 */
class SettingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Setting->recursive = 0;
		$this->set('settings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
		$this->set('setting', $this->Setting->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Setting->create();
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'));
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
		if (!$this->Setting->exists($id)) {
			throw new NotFoundException(__('Invalid setting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash(__('The setting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The setting could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
			$this->request->data = $this->Setting->find('first', $options);
		}
	}
	
	public function newSemester() {
		if($this->currentUser == null){
			$this->Session->setFlash(__('You must log in to do that!'));
			$this->redirect(array('controller'=>'pages','action' => 'home'));
		}else{
			if ($this->request->is('post')) {
				//find the students who will be updated, and display their names
				$updatedToStarted = $this->Setting->query("
														SELECT first_name, last_name 
														FROM students
														WHERE id IN
														(
															select attendance.student_id
															from 
															(
																select student_id, count(student_id) as meetings 
																from meetings_students 
																where meeting_id in 
																(
																	SELECT id 
																	from meetings 
																	where semester = '" . $this->currentSemester . "'
																) 
																group by student_id
															) 
															as attendance 
															where attendance.meetings >= 3
															AND attendance.meetings < 6
														)
														AND civics_status='none'
													");
													
				$updatedToMember =	$this->Setting->query("
														Select first_name, last_name
														From students
														WHERE id IN
														(
															select student_id 
															from 
															(
																select student_id, count(student_id) as meetings 
																from meetings_students 
																where meeting_id in 
																(
																	SELECT id 
																	from meetings 
																	where semester = '" . $this->currentSemester . "'
																) 
																group by student_id
															) 
															as attendance 
															where attendance.meetings >= 6
														)
														AND (civics_status = 'none' OR civics_status = 'started')
														");
														
				$returningMember =	$this->Setting->query("
														Select first_name, last_name
														From students
														WHERE id IN
														(
															select student_id 
															from 
															(
																select student_id, count(student_id) as meetings 
																from meetings_students 
																where meeting_id in 
																(
																	SELECT id 
																	from meetings 
																	where semester = '" . $this->currentSemester . "'
																) 
																group by student_id
															) 
															as attendance 
														)
														AND (civics_status = 'member')
														");
				//update student statuses
				
				$this->Setting->query("
										UPDATE students 
										set civics_status = 'started'
										WHERE id IN
										(
											select attendance.student_id
											from 
											(
												select student_id, count(student_id) as meetings 
												from meetings_students 
												where meeting_id in 
												(
													SELECT id 
													from meetings 
													where semester = '" . $this->currentSemester ."'
												) 
												group by student_id
											) 
											as attendance 
											where attendance.meetings >= 3
										)
										AND civics_status='none'
									");
				//must handle the returning members before handling the new members, else we would handle those new members twice		
				$this->Setting->query("
									UPDATE students
									SET semesters_active = CONCAT(semesters_active, ', " . $this->currentSemester . "')
									WHERE id IN
									(
										select student_id 
										from 
										(
											select student_id, count(student_id) as meetings 
											from meetings_students 
											where meeting_id in 
											(
												SELECT id 
												from meetings 
												where semester = '" . $this->currentSemester ."'
											) 
											group by student_id
										) 
										as attendance 
									)
									AND civics_status = 'member'
									");
									
				$this->Setting->query("
									UPDATE students
									SET civics_status = 'member', semester_joined='" . $this->currentSemester . "', semesters_active = '" . $this->currentSemester . "'
									WHERE id IN
									(
										select student_id 
										from 
										(
											select student_id, count(student_id) as meetings 
											from meetings_students 
											where meeting_id in 
											(
												SELECT id 
												from meetings 
												where semester = '" . $this->currentSemester ."'
											) 
											group by student_id
										) 
										as attendance 
										where attendance.meetings >= 6
									)
									AND (civics_status = 'none' OR civics_status = 'started')
									");
													
				//set new semester name
				$this->Setting->query("
									UPDATE settings
									SET value = '" . $this->request->data['Setting']['name'] . "'
									WHERE value = '" . $this->currentSemester . "'
									");
				//display success
				
				$this->set('updatedToStarted',$this->updatedToStarted = $updatedToStarted);
				$this->set('updatedToMember', $this->updatedToMember = $updatedToMember);
				$this->set('newSemester', $this->newSemester = $this->request->data['Setting']['name']);
				$this->set('returningMember', $this->returningMember = $returningMember);
			}
			//else display a page asking for the new semester title and warning that this is impossible to undo 
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
		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Invalid setting'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Setting->delete()) {
			$this->Session->setFlash(__('Setting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Setting was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
