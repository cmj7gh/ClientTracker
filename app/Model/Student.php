<?php
App::uses('AppModel', 'Model');
/**
 * Student Model
 *
 * @property School $School
 * @property Meeting $Meeting
 */
class Student extends AppModel {


public $virtualFields = array(
    'name' => "CONCAT(Student.first_name, ' ', Student.last_name)",
	'fullName' => "CONCAT(Student.first_name, ' (', Student.nickname, ') ', Student.last_name)",
	'searchName' => "CONCAT(Student.first_name, ' ', Student.nickname, ' ', Student.last_name)"
);

public $displayField = 'name';

public $order = array('last_name' => 'ASC', 'first_name' => 'ASC');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/*'Semester' => array(
			'className' => 'Semester',
			'foreignKey' => 'internship_semester_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Meeting' => array(
			'className' => 'Meeting',
			'joinTable' => 'meetings_students',
			'foreignKey' => 'student_id',
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
		/*'Semester' => array(
			'className' => 'Semester',
			'joinTable' => 'students_semesters',
			'foreignKey' => 'student_id',
			'associationForeignKey' => 'semester_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)*/
	);
	
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Service' => array(
			'className' => 'Service',
			'foreignKey' => 'student_id',
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
		'Scholarship' => array(
			'className' => 'Scholarship',
			'foreignKey' => 'student_id',
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
		'StudentSemester'
	);

}

class SearchStudentForm extends Student {

}
