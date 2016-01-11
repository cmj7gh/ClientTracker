<?php
App::uses('AppModel', 'Model');
/**
 * Program Model
 *
 */
class Program extends AppModel {
	public $displayField = 'name';
	public $order = array('Program.name'=>'ASC');
	
	public $hasMany = array(
        'StudentSemester', 'School'
    );
	
	public $belongsTo = array(
        'Programtype'
    );
}
