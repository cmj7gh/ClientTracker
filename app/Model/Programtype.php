<?php
App::uses('AppModel', 'Model');
/**
 * Programtype Model
 *
 */
class Programtype extends AppModel {
	public $displayField = 'name';
	
	public $hasMany = array(
        'Program'
    );
}
