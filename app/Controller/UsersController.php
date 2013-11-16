<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
public $uses = array('User');



	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login');
		//$this->Auth->fields = array(
        //    'username' => 'email',
        //    'password' => 'password'
        //);
    }

	public function login() {
		if($this->request->is('post')) {        //Only run on POST; GET requests simply load the view.
            if ($this->Auth->login()) {
                if($this->Auth->user()) {
					//I had to take this line out, because apparently if output starts before the redirect, the PHP on the next page doesn't execute
					//this created an ugly race conditiont hat sucked to debug.... this print wasn't doing anything anyway.
                    //echo("login successful");
					$this->after_login();
                } else {
                    //$this->redirect($this->Auth->redirect());
					$this->Session->setFlash(__('something failed...'));
					$this->redirect(array('controller'=>'pages', 'action'=>'welcome'));
                }
            } else {
				//debug("something went wrong!");
				$this->Session->setFlash(__('Invalid username or password, try again'));
				$this->redirect(array('controller'=>'pages', 'action'=>'welcome'));
            }
        } else {
				//debug("something went wrong!");
				$this->Session->setFlash(__('Invalid username or password, try again'));
				$this->redirect(array('controller'=>'pages', 'action'=>'welcome'));
        }
	}
	
	public function after_login() {
		/*This stuff is left over from the Wash stuff. We shouldn't need it here, but I'm leaving it just in case...
		$user = $this->Session->read('Auth.User');
		if($user['role'] == 'provie'){
			$provie = $this->Provy->find('first', array('conditions' => array('Provy.user_id' => $user['id'])));
			$this->redirect(array('controller'=>'provies', 'action'=>'view', $provie['Provy']['id']));
		}else if($user['office'] != null){
			$this->redirect(array('controller'=>'pages', 'action'=>'officer_home'));
		}else if($user['role'] == 'member'){
			$this->redirect(array('controller'=>'pages', 'action'=>'member_home'));
		}else if($user['role'] == 'alum'){
			$this->redirect(array('controller'=>'pages', 'action'=>'alum_home'));
		}else{
			$this->Session->setFlash(__('You have successfully logged in, but your profile is not yet complete. Please complete this biographical information then email cmj7gh@virginia.edu to complete your registration.'), 'flash_good');
			$this->redirect(array('controller'=>'users', 'action'=>'edit', $user['id']));
		}*/
		$this->Session->setFlash(__('Login Successful'), 'flash_good');
		$this->redirect(array('controller'=>'pages', 'action'=>'officer_home'));
    }
	
	public function logout() {
		$this->Session->setFlash(__('You have successfully logged out.'), 'flash_good');
		$this->redirect($this->Auth->logout());
		//$this->redirect(array('controller'=>'pages', 'action'=>'welcome'));
	}
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
			$this->User->recursive = 0;
			$this->set('users', $this->paginate());
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
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
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
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			$meetings = $this->User->Meeting->find('list');
			$centers = $this->User->Center->find('list');
			$this->set(compact('meetings', 'centers'));
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
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'), 'flash_good');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->User->find('first', $options);
			}
			$meetings = $this->User->Meeting->find('list');
			$centers = $this->User->Center->find('list');
			$this->set(compact('meetings', 'centers'));
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
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->User->delete()) {
				$this->Session->setFlash(__('User deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
