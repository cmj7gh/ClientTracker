<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Student', 'Semester', 'StudentSemester', 'Birthday', 'ProgramsSchools');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */

	// Returns the birthday information for the table back to client
	public function birthdays() {
		$this->autoRender = null;
		$this->layout = null;
		return json_encode($this->Birthday->getBirthdayInfo());
	}

	// Returns the list of semesters for the search form back to client
	public function semesters() {
		$this->autoRender = null;
		$this->layout = null;
		return json_encode($this->Semester->getAllSemesters());
	}

	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		/****************
			NOTE: I'm breaking the sub-page and title_for_layout functionality so that I can re-purpose $path[1] as an argument to the /charts/ page
				Before I did this I kept getting errors saying "view not found /pages/charts/maryland.ctp (ie, it was using Maryland as a page instead of a chart)
				Someday someone should re-write this as an AJAX call...
		****************/
		$argument = 'all';
		
		if (!empty($path[1])) {
			//$subpage = $path[1];
			$argument = $path[1];
			//$path[1] = NULL;
			$path = array($path[0]);
		}
		//if (!empty($path[$count - 1])) {
		//	$title_for_layout = Inflector::humanize($path[$count - 1]);
		//}
		
		if($page == 'officer_home'){
			//birthdays
			$todayStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from users where MONTH(birthday) = MONTH(now()) AND DAYOFMONTH(birthday) = DAYOFMONTH(now())");
			$todayStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from students where dateDeleted IS NULL AND MONTH(birthday) = MONTH(now()) AND DAYOFMONTH(birthday) = DAYOFMONTH(now())");
			$nextDay = $this->Student->query("SELECT DAYOFWEEK(DATE_ADD(NOW(), INTERVAL 2 DAY)) as day");
			$tomorrowStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
			$tomorrowStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from students where dateDeleted IS NULL AND MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
			$nextDayStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");
			$nextDayStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from students where dateDeleted IS NULL AND MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");

			//all LP Students
			$totalStudentsWorkedWith = $this->Student->query("SELECT count(*) from students WHERE dateDeleted IS NULL");
			$totalMembers = $this->Student->query("SELECT count(*) from students where  dateDeleted IS NULL AND civics_status = 'member'");
			$totalCountries = $this->Student->query("select count(distinct country) from (select country from students where dateDeleted IS NULL union select country2 as country from students where dateDeleted IS NULL) as countries where country is not null and country != '' order by country");
			$totalInternshipLocations = $this->Student->query("Select count(distinct internship_location) from students where dateDeleted IS NULL");
			$totalInternsAllTime = $this->Student->query("SELECT count(*) from students where dateDeleted IS NULL AND internship_semester_id is not null");
			$lastSemester = $this->Student->query("Select status from settings where dateDeleted IS NULL AND  setting='LastSemester'");
			$lastSemesterId = $lastSemester[0]['settings']['status'];
			$totalStartedLastSemester = $this->Student->query("Select count(*) from students where  dateDeleted IS NULL AND semester_member = " . $lastSemesterId);
			$totalParticipantsLastSemester = $this->Student->query("Select count(distinct student_id) from meetings join meetings_students on meetings.id = meetings_students.meeting_id where meetings.semester_id = " . $lastSemesterId); 
			$totalInternsLastSemester = $this->Student->query("SELECT count(*) from students where dateDeleted IS NULL AND internship_semester_id = " . $lastSemesterId);
			
			//data for Pie Charts
			$studentsInHS = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND graduated = 0 AND graduation_year >= " . date('Y'));
			$studentsInCollege = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND graduated = 1 AND college = 1 AND graduated_college = 0");
			$studentsWorking = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed != 'no' ");
			$studentsUnemployed = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed = 'no' ");
			$other = $totalStudentsWorkedWith[0][0]['count(*)'] - ($studentsInHS[0][0]['count(*)'] + $studentsInCollege[0][0]['count(*)'] + $studentsWorking[0][0]['count(*)'] + $studentsUnemployed[0][0]['count(*)']);
			$males = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND gender = 'Male'");
			$females = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND gender = 'Female'");
			$unknownGender = $totalStudentsWorkedWith[0][0]['count(*)'] - ($males[0][0]['count(*)'] + $females[0][0]['count(*)'] );
			
			
			//Find my schools
			$mySchools = $this->Student->query("SELECT schools.id, schools.name from schools JOIN users_centers on schools.center_id = users_centers.center_id WHERE users_centers.user_id = " . $this->currentUser['id']);
			
			$schoolCount = 0;
			foreach($mySchools as $school){
				$mySchools[$schoolCount]['schools']['studentsWorkedWith'] = $this->Student->query("SELECT count(*) from students where dateDeleted IS NULL AND school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['members'] = $this->Student->query("SELECT count(*) from students where dateDeleted IS NULL AND civics_status = 'member' AND school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['countries'] = $this->Student->query("SELECT count(distinct country) from students where dateDeleted IS NULL AND school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['internship_locations'] = $this->Student->query("SELECT count(distinct internship_location) from students where dateDeleted IS NULL AND school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['started_last_semester'] = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND semester_member = " . $lastSemesterId . " AND school_id = ". $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['participated_last_semester'] = $this->Student->query("Select count(distinct student_id) from meetings join meetings_students on meetings.id = meetings_students.meeting_id join students on students.id = meetings_students.student_id where students.dateDeleted IS NULL AND meetings.semester_id = " . $lastSemesterId . " AND students.school_id = " . $school['schools']['id']); 
				$mySchools[$schoolCount]['schools']['interns_last_semester'] = $this->Student->query("SELECT count(*) from students where dateDeleted IS NULL AND internship_semester_id = " . $lastSemesterId . " AND school_id = ". $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['interns_all_time'] = $this->Student->query("SELECT count(*) from students where dateDeleted IS NULL AND internship_semester_id is not null AND school_id = ". $school['schools']['id']);
				$schoolCount++;
			}
			
			$this->set(compact('totalStudentsWorkedWith', 'totalMembers', 
								'totalCountries', 'totalInternshipLocations',
								'todayStaffBirthdays', 'todayStudentBirthdays', 
								'nextDay', 'tomorrowStaffBirthdays', 
								'tomorrowStudentBirthdays', 'nextDayStaffBirthdays', 
								'nextDayStudentBirthdays', 'mySchools',
								'totalStartedLastSemester', 'totalParticipantsLastSemester',
								'totalInternsLastSemester', 'totalInternsAllTime',
								'studentsInHS','studentsInCollege','studentsWorking',
								'studentsUnemployed','other',
								'males', 'females', 'unknownGender'));
		}
		
		if($page == 'charts'){
			//die(var_dump($subpage));
			
			//We're going to filter this whole page based on which school the student is in. let's create a where clause that can be appended to each of these queries
			//TODO: Make this dynamic so that it picks up new schools. This will probably take a data model change to add a "counties" table with a "state" column
			$whereClause = 'WHERE 1=1';
			$textForChartHeader = ' (All Alumni)';
			IF($argument == 'maryland'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Montgomery','Prince George'))";
				$textForChartHeader = ' (Maryland Alumni)';
			}ELSE IF($argument == 'virginia'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Alexandria','Fairfax','Arlington'))";
				$textForChartHeader = ' (Virginia Alumni)';
			}ELSE IF($argument == 'dc'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('District of Colombia'))";
				$textForChartHeader = ' (Washington DC Alumni)';
			}ELSE IF($argument == 'montgomery'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Montgomery'))";
				$textForChartHeader = ' (Montgomery County, MD Alumni)';
			}ELSE IF($argument == 'princeGeorges'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Prince George'))";
				$textForChartHeader = " (Prince George\'s County, MD Alumni)";
			}ELSE IF($argument == 'baltimore'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Baltimore'))";
				$textForChartHeader = ' (Baltimore, MD Alumni)';
			}ELSE IF($argument == 'arlington'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Arlington'))";
				$textForChartHeader = ' (Arlington, VA Alumni)';
			}ELSE IF($argument == 'fairfax'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Fairfax'))";
				$textForChartHeader = ' (Fairfax, VA Alumni)';
			}ELSE IF($argument == 'alexandria'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Alexandria'))";
				$textForChartHeader = ' (Alexandria, VA Alumni)';
			}
			
			//DEPRECATING the "where are they now" chart - we didn't have the data to support it!
			//data for "Where are they now" Pie Chart
			$totalStudentsWorkedWith = $this->Student->query("SELECT count(*) from students");
			$studentsInHS = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND graduated = 0 AND graduation_year >= " . date('Y'));
			$studentsInCollege = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND college = 1 AND graduated_college = 0 and college_graduation_year >= " . date('Y'));
			$studentsWorking = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed IN ('part','full') ");
			$studentsUnemployed = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed = 'no' ");
			$other = $totalStudentsWorkedWith[0][0]['count(*)'] - ($studentsInHS[0][0]['count(*)'] + $studentsInCollege[0][0]['count(*)'] + $studentsWorking[0][0]['count(*)'] + $studentsUnemployed[0][0]['count(*)']);

			
			//data for "Gender" pie chart (not currently displayed)
			$males = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND gender = 'Male'");
			$females = $this->Student->query("Select count(*) from students where dateDeleted IS NULL AND gender = 'Female'");
			$unknownGender = $totalStudentsWorkedWith[0][0]['count(*)'] - ($males[0][0]['count(*)'] + $females[0][0]['count(*)'] );
			
			//data for "Highest Level of Education Attained" pie chart (re-use studentsInHS and studentsInCollege)
			//These queries all use the view vw_students_members_and_interns - which filters out any students who haven't actually participated in an LP program and any deleted students
			$totalMemberInterns = $this->Student->query("Select count(*) FROM vw_students_members_and_interns " . $whereClause);
			$membersInHS = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND graduated = 0 AND dropped_out_of_high_school = 0 AND graduation_year >= " . date('Y'));
			$studentsDroppedOutOfHS = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND dropped_out_of_high_school = 1 and ged = 0 and college = 0");
			$studentsWithGED = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND ged = 1 and college = 0");
			$studentsGraduatedHS = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND graduated = 1 and college = 0");
			$studentsGraduatedCollege = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND graduated_college = 1 and grad_school = 0");
			$studentsWithSomeCollege = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND college = 1 AND graduated_college = 0 and grad_school = 0");
			//$studentsDidNotCompleteCollege = $this->Student->query("Select count(*) from vw_students_members_and_interns where college = 1 AND graduated_college = 0 and college_graduation_year < " . date('Y'));
			$studentsInGradSchool = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND grad_school = 1 AND graduated_grad_school = 0");
			$studentsGraduatedGradSchool = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND grad_school = 1 AND graduated_grad_school = 1");
			$nonMembersInterns = $this->Student->query("Select count(*) from students ". $whereClause . " AND dateDeleted IS NULL AND id not in (select id from vw_students_members_and_interns)" );
			
			$UnknownEducation = $totalMemberInterns[0][0]['count(*)'] - ($membersInHS[0][0]['count(*)']
																				+ $studentsDroppedOutOfHS[0][0]['count(*)']
																				+ $studentsWithGED[0][0]['count(*)']
																				+ $studentsGraduatedHS[0][0]['count(*)']
																				+ $studentsWithSomeCollege[0][0]['count(*)']
																				+ $studentsGraduatedCollege[0][0]['count(*)']
																				+ $studentsInGradSchool[0][0]['count(*)']
																				+ $studentsGraduatedGradSchool[0][0]['count(*)']);															
			
			$this->set(compact('studentsInHS','studentsInCollege','totalMemberInterns','membersInHS','studentsWorking','studentsUnemployed','other','males','females','unknownGender'
								,'studentsDroppedOutOfHS','studentsWithGED','studentsGraduatedHS','studentsGraduatedCollege','studentsInGradSchool','studentsGraduatedGradSchool'
								,'studentsWithSomeCollege','UnknownEducation','argument','textForChartHeader','nonMembersInterns'));
		}
		if($page == 'stats'){
			$startSemester = $this->currentSemester;
			if(isset($_GET['StartSemester'])){
				$startSemester = $_GET['StartSemester'];
			}
			$EndSemester = $this->currentSemester;
			if(isset($_GET['EndSemester'])){
				$EndSemester = $_GET['EndSemester'];
			}
			$includedSemesters = $this->Semester->getSemesterRangeString($startSemester, $EndSemester);
			$studentSemesters = $this->StudentSemester->getStudentSemestersList($includedSemesters);
			$semesters = $this->Semester->getAllSemesters();

			$StatsType = 'Total';
			if(isset($_GET['StatsType'])){
				$StatsType = $_GET['StatsType'];
			}				
			$which = 'Total';
			if(isset($_GET['which'])){
				$which = $_GET['which'];
			}			
			
			$myPrograms = $this->Student->query("SELECT id, name from programs");

			$programCount = 0;
			foreach($myPrograms as $program) {
				$programs_schools = $this->ProgramsSchools->getProgramsSchoolsList($program['programs']['id']);
				$myPrograms[$programCount]['programs']['participated_last_semester'] = $this->Student->query("SELECT count(*) AS participated_students FROM students WHERE dateDeleted IS NULL AND school_id IN " . $programs_schools . " AND id in " . $studentSemesters);
				$myPrograms[$programCount]['programs']['countries'] = $this->Student->query("SELECT count(distinct country) AS countries_represented FROM students WHERE dateDeleted IS NULL AND school_id IN " . $programs_schools . " AND id in " . $studentSemesters);
                $myPrograms[$programCount]['programs']['internship_locations'] = $this->Student->query("SELECT count(distinct internship_location) AS internship_locations FROM students WHERE dateDeleted IS NULL AND school_id IN " . $programs_schools . " AND internship_semester_id IN " . $includedSemesters . " AND id IN " . $studentSemesters);
				// $myPrograms[$programCount]['programs']['started_last_semester'] = $this->Student->query("SELECT count(*) AS started_last_sem FROM students WHERE dateDeleted IS NULL AND id IN (SELECT student_id FROM student_earliest_semester WHERE semester_id IN " . $includedSemesters . ") AND school_id IN " . $programs_schools);
                $myPrograms[$programCount]['programs']['interns_last_semester'] = $this->Student->query("SELECT count(*) AS interned_last_sem FROM students WHERE dateDeleted IS NULL AND internship_semester_id IN " . $includedSemesters . " AND school_id IN " . $programs_schools);
				// $myPrograms[$programCount]['programs']['interns_all_time'] = $this->Student->query("SELECT count(*) AS all_time_interns FROM students WHERE dateDeleted IS NULL AND internship_semester_id IS NOT NULL AND school_id IN " . $programs_schools);
				$myPrograms[$programCount]['programs']['new_members'] = $this->Student->query("SELECT count(*) AS new_members FROM students WHERE datedeleted IS NULL and id IN (SELECT student_id from student_earliest_semester WHERE semester_id IN " . $includedSemesters . ") AND school_id IN " . $programs_schools);
				$programCount++;
			}

			//These queries are pulled when anyone clicks on the numbers in the stats table. It shows an actual list of the students in that stat.
			if(isset($_GET['Program']) && isset($_GET['Stat'])){
				$programs_schools = $this->ProgramsSchools->getProgramsSchoolsList($_GET['Program']);
				if($_GET['Stat'] == 'AllMembers'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where dateDeleted IS NULL and id in (select student_id from student_earliest_semester where semester_id IN " . $includedSemesters . ") 
						AND school_id IN " . $programs_schools);
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}
				}elseif($_GET['Stat'] == 'AllStudents'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where dateDeleted IS NULL and school_id IN " . $programs_schools);
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}
				}elseif($_GET['Stat'] == 'TheseStudents'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where dateDeleted IS NULL and school_id  IN " . $programs_schools . "
						AND id in( SELECT student_id from student_semesters where semester_id in " . $includedSemesters . ")");
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}				
				}elseif($_GET['Stat'] == 'TheseMembers'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where dateDeleted IS NULL and id in (select student_id from student_earliest_semester where semester_id IN " . $includedSemesters . ") 
						AND school_id IN " . $programs_schools . '
						AND semester_member IN ' . $includedSemesters );
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}					
				}elseif($_GET['Stat'] == 'TheseInterns'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where dateDeleted IS NULL and internship_semester_id IN " . $includedSemesters . " 
						AND school_id IN " . $programs_schools);
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}				
				}elseif($_GET['Stat'] == 'TheseSites'){
					$valuesRaw = $this->Student->query(
						"SELECT distinct internship_location from students 
						where dateDeleted IS NULL and school_id IN " . $programs_schools . "
						AND id in( SELECT student_id from student_semesters 
									where semester_id in " . $includedSemesters . ")
						AND internship_location is not NULL
						AND internship_semester_id IN " . $includedSemesters . " 
						ORDER BY internship_location");
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = $v['students']['internship_location'];
						$i++;
					}				
				}elseif($_GET['Stat'] == 'TheseCountries'){
					$valuesRaw = $this->Student->query(
						"SELECT distinct country from students 
						where dateDeleted IS NULL and school_id IN " . $programs_schools . "
						AND id in( SELECT student_id from student_semesters 
									where semester_id in " . $includedSemesters . ")
						AND country is not NULL
						AND country <> ''
						ORDER BY country");
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = $v['students']['country'];
						$i++;
					}				
				}
			}
			
			$this->set(compact('semesters', 'myPrograms', 'totalStudentsWorkedWith','totalMembers',
								'totalCountries', 'totalInternshipLocations',
								'todayStaffBirthdays', 'todayStudentBirthdays', 
								'nextDay', 'tomorrowStaffBirthdays', 
								'tomorrowStudentBirthdays', 'nextDayStaffBirthdays', 
								'nextDayStudentBirthdays', 'mySchools',
								'totalStartedLastSemester', 'totalParticipantsLastSemester',
								'totalInternsLastSemester', 'totalInternsAllTime',
								'studentsInHS','studentsInCollege','studentsWorking',
								'studentsUnemployed','other',
								'males', 'females', 'unknownGender', 'values',
								'startSemester', 'EndSemester'));
		}
		
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
}
