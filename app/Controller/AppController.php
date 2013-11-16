<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Html', 'Session');
	public $uses = array('User', 'Setting');
	public $components = array(
    'Auth'=> array(
        'authenticate' => array(
            'Form' => array(
                'fields' => array('username' => 'email', 'password' => 'password')
            )
        ),
		'logoutRedirect' => array('controller' => 'pages', 'action' => 'welcome'),
		'unauthorizedRedirect' => array('controller' => 'pages', 'action' => 'welcome'),
		'loginAction' => array('controller' => 'pages', 'action' => 'welcome')
	), 'Session', 'SQLLog'
	);
	
	public function beforeFilter() {
	  $currentUser = $this->Session->read('Auth.User');
	  $currentSemester = $this->Setting->find('first', array('fields' => array('status'), 'conditions' => array('setting' => 'CurrentSemester')));
	  $this->set('currentUser', $this->currentUser = $currentUser, 'currentSemester', $this->currentSemester = $currentSemester['Setting']['status']);
	  $this->SQLLog->LogEvent();
	}
}
