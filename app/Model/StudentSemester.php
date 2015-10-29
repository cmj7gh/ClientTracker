<?php
App::uses('AppModel', 'Model');
/**
 * StudentSemester Model
 *
 */
class StudentSemester extends AppModel {
	public $belongsTo = array(
        'Student', 'Semester', 'Program'
    );
}
