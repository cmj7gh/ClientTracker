<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Authentication $Authentication
 * @property Log $Log
 * @property Meeting $Meeting
 * @property School $School
 */
class User extends AppModel {

	public $virtualFields = array(
		 'display_name' => 'CONCAT(User.first_name, " ", User.last_name, " (", User.email, ")")'
	);
	
	public $displayField = 'display_name';

	public $order = array('User.display_name'=>'ASC');
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Authentication' => array(
			'className' => 'Authentication',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Log' => array(
			'className' => 'Log',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Meeting' => array(
			'className' => 'Meeting',
			'joinTable' => 'users_meetings',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'meeting_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Center' => array(
			'className' => 'Center',
			'joinTable' => 'users_centers',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'center_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
