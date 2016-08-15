<?php
App::uses('AppModel', 'Model');
/**
 * StudentSemester Model
 *
 */
class ProgramsSchools extends AppModel {

	public $belongsTo = array(
        'Student', 'Semester', 'Program'
    );

    // Data is nested one level down, move everything one level up
    private function moveUp($programSchool) {
        return $programSchool['programs_schools']['school_id'];
    }

	private function getProgramsSchools($program_id) {
		$programsSchools = $this->query("SELECT school_id FROM programs_schools WHERE program_id = " . $program_id);
		return array_map(array($this, "moveUp"), $programsSchools);
	}

    // Returns a well-formatted SQL list of semesters
    public function getProgramsSchoolsList($program_id) {
        $programsSchools = $this->getProgramsSchools($program_id);
        $result = join(',', $programsSchools);
        if (count($programsSchools) == 0) {
            $result = 'NULL';
        }
        return '(' . $result . ')';
    }
}