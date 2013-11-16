<?php
App::uses('AppModel', 'Model');
/**
 * Meeting Model
 *
 * @property Student $Student
 * @property User $User
 */
class Meeting extends AppModel {

    public $validate = array(
        'semester' => array(
                'checkUnique' => array(
                    'rule' => array('checkUnique', array('semester', 'title', 'center_id')),
                    'message' => 'This field need to be non-empty and the row need to be unique'
                ),
            ),
		'title' => array(
                'checkUnique' => array(
                    'rule' => array('checkUnique', array('semester', 'title', 'center_id')),
                    'message' => 'A Session With This Number Has Already Been Created This Semester At This School!'
                ),
            ),
		'center_id' => array(
                'checkUnique' => array(
                    'rule' => array('checkUnique', array('semester', 'title', 'center_id')),
                    'message' => 'This field need to be non-empty and the row need to be unique'
                ),
            )
    );

	function checkUnique($data, $fields) {
		if (!is_array($fields)) {
			$fields = array($fields);
		}
		foreach($fields as $key) {
			$tmp[$key] = $this->data[$this->name][$key];
		}
		if (isset($this->data[$this->name][$this->primaryKey]) && $this->data[$this->name][$this->primaryKey] > 0) {
			$tmp[$this->primaryKey." !="] = $this->data[$this->name][$this->primaryKey];
		}
		//return false;
        return $this->isUnique($tmp, false); 
    }

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Center' => array(
			'className' => 'Center',
			'foreignKey' => 'center_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Student' => array(
			'className' => 'Student',
			'joinTable' => 'meetings_students',
			'foreignKey' => 'meeting_id',
			'associationForeignKey' => 'student_id',
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
		'User' => array(
			'className' => 'User',
			'joinTable' => 'users_meetings',
			'foreignKey' => 'meeting_id',
			'associationForeignKey' => 'user_id',
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
