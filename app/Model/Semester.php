<?php
App::uses('AppModel', 'Model');
/**
 * Meeting Model
 *
 * @property Student $Student
 * @property User $User
 */
class Semester extends AppModel {

public $virtualFields = array(
    'name' => "CONCAT(Semester.semester, ' ', Semester.year)"
);

public $displayField = 'name';
public $order = 'startingDate';
/**
 * Display field
 *
 * @var string
 */



	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
/**
 * belongsTo associations
 *
 * @var array
 */


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Student' => array(
			'className' => 'Student',
			'joinTable' => 'students_semesters',
			'foreignKey' => 'semester_id',
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
		)
	);

}