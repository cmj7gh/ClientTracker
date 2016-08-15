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
		/*public $hasAndBelongsToMany = array(
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
		);*/
	
        public $hasMany = array(
            'StudentSemester'
        );

        // Data is nested one level down, move everything one level up
        private function moveUp($semester) {
            return $semester['semesters'];
        }

        // Return an array of only semester IDs
        private function getIds($semesters) {
            $ids = array();
            foreach ($semesters as $semester) {
                array_push($ids, $semester['id']);
            }
            return $ids;
        }

        // Returns all semesters as a list, after moving nested object data up one level
        public function getAllSemesters() {
            $allSemesters = $this->query("SELECT * from semesters order by year, semester");
            return array_map(array($this, "moveUp"), $allSemesters);
        }

        // Returns a well-formatted SQL list of semesters
        public function getSemesterRangeString($startSemester, $endSemester) {
            $rangeSemesters = $this->query("SELECT * FROM semesters where id >= " . $startSemester . " AND id <= " . $endSemester);
            $rangeSemesters = array_map(array($this, "moveUp"), $rangeSemesters);
            return '(' . join(',', $this->getIds($rangeSemesters)) . ')';
        }

}
