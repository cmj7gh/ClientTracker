<?php
App::uses('AppModel', 'Model');
/**
 * Program Model
 *
 */
class Program extends AppModel {
	public $displayField = 'name';
	
	public $hasMany = array(
        'StudentSemester'
    );
}
