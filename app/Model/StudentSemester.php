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

    // Data is nested one level down, move everything one level up
    private function moveUp($studentSemester) {
        return $studentSemester['student_semesters']['student_id'];
    }

	private function getStudentSemesters($includedSemesters) {
		$studentSemesters = $this->query("SELECT student_id from student_semesters WHERE semester_id in " . $includedSemesters);
		return array_map(array($this, "moveUp"), $studentSemesters);
	}

    // Returns a well-formatted SQL list of semesters
    public function getStudentSemestersList($includedSemesters) {
        $studentSemesters = $this->getStudentSemesters($includedSemesters);
        return '(' . join(',', $studentSemesters) . ')';
    }
}
