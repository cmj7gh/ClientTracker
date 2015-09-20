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
	public $uses = array('Student', 'Semester');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
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
			$todayStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from students where MONTH(birthday) = MONTH(now()) AND DAYOFMONTH(birthday) = DAYOFMONTH(now())");
			$nextDay = $this->Student->query("SELECT DAYOFWEEK(DATE_ADD(NOW(), INTERVAL 2 DAY)) as day");
			$tomorrowStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
			$tomorrowStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from students where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
			$nextDayStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");
			$nextDayStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name from students where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");

			//all LP Students
			$totalStudentsWorkedWith = $this->Student->query("SELECT count(*) from students");
			$totalMembers = $this->Student->query("SELECT count(*) from students where civics_status = 'member'");
			$totalCountries = $this->Student->query("select count(distinct country) from (select country from students union select country2 as country from students) as countries where country is not null and country != '' order by country");
			$totalInternshipLocations = $this->Student->query("Select count(distinct internship_location) from students");
			$totalInternsAllTime = $this->Student->query("SELECT count(*) from students where internship_semester_id is not null");
			$lastSemester = $this->Student->query("Select status from settings where setting='LastSemester'");
			$lastSemesterId = $lastSemester[0]['settings']['status'];
			$totalStartedLastSemester = $this->Student->query("Select count(*) from students where semester_member = " . $lastSemesterId);
			$totalParticipantsLastSemester = $this->Student->query("Select count(distinct student_id) from meetings join meetings_students on meetings.id = meetings_students.meeting_id where meetings.semester_id = " . $lastSemesterId); 
			$totalInternsLastSemester = $this->Student->query("SELECT count(*) from students where internship_semester_id = " . $lastSemesterId);
			
			//data for Pie Charts
			$studentsInHS = $this->Student->query("Select count(*) from students where graduated = 0 AND graduation_year >= " . date('Y'));
			$studentsInCollege = $this->Student->query("Select count(*) from students where graduated = 1 AND college = 1 AND graduated_college = 0");
			$studentsWorking = $this->Student->query("Select count(*) from students where (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed != 'no' ");
			$studentsUnemployed = $this->Student->query("Select count(*) from students where (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed = 'no' ");
			$other = $totalStudentsWorkedWith[0][0]['count(*)'] - ($studentsInHS[0][0]['count(*)'] + $studentsInCollege[0][0]['count(*)'] + $studentsWorking[0][0]['count(*)'] + $studentsUnemployed[0][0]['count(*)']);
			$males = $this->Student->query("Select count(*) from students where gender = 'Male'");
			$females = $this->Student->query("Select count(*) from students where gender = 'Female'");
			$unknownGender = $totalStudentsWorkedWith[0][0]['count(*)'] - ($males[0][0]['count(*)'] + $females[0][0]['count(*)'] );
			
			
			//Find my schools
			$mySchools = $this->Student->query("SELECT schools.id, schools.name from schools JOIN users_centers on schools.center_id = users_centers.center_id WHERE users_centers.user_id = " . $this->currentUser['id']);
			
			$schoolCount = 0;
			foreach($mySchools as $school){
				$mySchools[$schoolCount]['schools']['studentsWorkedWith'] = $this->Student->query("SELECT count(*) from students where school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['members'] = $this->Student->query("SELECT count(*) from students where civics_status = 'member' AND school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['countries'] = $this->Student->query("SELECT count(distinct country) from students where school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['internship_locations'] = $this->Student->query("SELECT count(distinct internship_location) from students where school_id = " . $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['started_last_semester'] = $this->Student->query("Select count(*) from students where semester_member = " . $lastSemesterId . " AND school_id = ". $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['participated_last_semester'] = $this->Student->query("Select count(distinct student_id) from meetings join meetings_students on meetings.id = meetings_students.meeting_id join students on students.id = meetings_students.student_id where meetings.semester_id = " . $lastSemesterId . " AND students.school_id = " . $school['schools']['id']); 
				$mySchools[$schoolCount]['schools']['interns_last_semester'] = $this->Student->query("SELECT count(*) from students where internship_semester_id = " . $lastSemesterId . " AND school_id = ". $school['schools']['id']);
				$mySchools[$schoolCount]['schools']['interns_all_time'] = $this->Student->query("SELECT count(*) from students where internship_semester_id is not null AND school_id = ". $school['schools']['id']);
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
			}ELSE IF($argument == 'alexandria'){
				$whereClause = "WHERE school_id IN (SELECT id from schools WHERE county IN ('Alexandria'))";
				$textForChartHeader = ' (Alexandria, VA Alumni)';
			}
			
			//DEPRECATING the "where are they now" chart - we didn't have the data to support it!
			//data for "Where are they now" Pie Chart
			$totalStudentsWorkedWith = $this->Student->query("SELECT count(*) from students");
			$studentsInHS = $this->Student->query("Select count(*) from students where graduated = 0 AND graduation_year >= " . date('Y'));
			$studentsInCollege = $this->Student->query("Select count(*) from students where college = 1 AND graduated_college = 0 and college_graduation_year >= " . date('Y'));
			$studentsWorking = $this->Student->query("Select count(*) from students where (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed IN ('part','full') ");
			$studentsUnemployed = $this->Student->query("Select count(*) from students where (graduated = 1 OR graduation_year < " . date('Y') . ") AND (college = 0 OR (college = 1 AND graduated_college = 1)) AND employed = 'no' ");
			$other = $totalStudentsWorkedWith[0][0]['count(*)'] - ($studentsInHS[0][0]['count(*)'] + $studentsInCollege[0][0]['count(*)'] + $studentsWorking[0][0]['count(*)'] + $studentsUnemployed[0][0]['count(*)']);

			
			//data for "Gender" pie chart (not currently displayed)
			$males = $this->Student->query("Select count(*) from students where gender = 'Male'");
			$females = $this->Student->query("Select count(*) from students where gender = 'Female'");
			$unknownGender = $totalStudentsWorkedWith[0][0]['count(*)'] - ($males[0][0]['count(*)'] + $females[0][0]['count(*)'] );
			
			//data for "Highest Level of Education Attained" pie chart (re-use studentsInHS and studentsInCollege)
			$totalMemberInterns = $this->Student->query("Select count(*) FROM vw_students_members_and_interns " . $whereClause);
			$membersInHS = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND graduated = 0 AND graduation_year >= " . date('Y'));
			$studentsDroppedOutOfHS = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND graduated = 0 AND graduation_year < " . date('Y') . " and college = 0");
			$studentsGraduatedHS = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND graduated = 1 and college = 0");
			$studentsGraduatedCollege = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND graduated_college = 1 and grad_school = 0");
			$studentsWithSomeCollege = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND college = 1 AND graduated_college = 0 and grad_school = 0");
			//$studentsDidNotCompleteCollege = $this->Student->query("Select count(*) from vw_students_members_and_interns where college = 1 AND graduated_college = 0 and college_graduation_year < " . date('Y'));
			$studentsInGradSchool = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND grad_school = 1 AND graduated_grad_school = 0");
			$studentsGraduatedGradSchool = $this->Student->query("Select count(*) from vw_students_members_and_interns ". $whereClause . " AND grad_school = 1 AND graduated_grad_school = 1");
			$UnknownEducation = $totalMemberInterns[0][0]['count(*)'] - ($membersInHS[0][0]['count(*)']
																				+ $studentsDroppedOutOfHS[0][0]['count(*)']
																				+ $studentsGraduatedHS[0][0]['count(*)']
																				+ $studentsWithSomeCollege[0][0]['count(*)']
																				+ $studentsGraduatedCollege[0][0]['count(*)']
																				+ $studentsInGradSchool[0][0]['count(*)']
																				+ $studentsGraduatedGradSchool[0][0]['count(*)']);															
			
			$this->set(compact('studentsInHS','studentsInCollege','totalMemberInterns','membersInHS','studentsWorking','studentsUnemployed','other','males','females','unknownGender'
								,'studentsDroppedOutOfHS','studentsGraduatedHS','studentsGraduatedCollege','studentsInGradSchool','studentsGraduatedGradSchool'
								,'studentsWithSomeCollege','UnknownEducation','argument','textForChartHeader'));
		}
		if($page == 'stats'){
		
			//birthdays
			$todayStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name, id from users where MONTH(birthday) = MONTH(now()) AND DAYOFMONTH(birthday) = DAYOFMONTH(now())");
			$todayStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name, id from students where MONTH(birthday) = MONTH(now()) AND DAYOFMONTH(birthday) = DAYOFMONTH(now())");
			$nextDay = $this->Student->query("SELECT DAYOFWEEK(DATE_ADD(NOW(), INTERVAL 2 DAY)) as day");
			$tomorrowStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name, id from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
			$tomorrowStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name, id from students where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
			$nextDayStaffBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name, id from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");
			$nextDayStudentBirthdays = $this->Student->query("Select CONCAT(first_name, ' ' , last_name) as name, id from students where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");

			$this->set(compact('todayStaffBirthdays', 'todayStudentBirthdays', 
								'nextDay', 'tomorrowStaffBirthdays', 
								'tomorrowStudentBirthdays', 'nextDayStaffBirthdays', 
								'nextDayStudentBirthdays'));
		
		
			$startSemester = $this->currentSemester;
			if(isset($_GET['StartSemester'])){
				$startSemester = $_GET['StartSemester'];
			}
			$EndSemester = $this->currentSemester;
			if(isset($_GET['EndSemester'])){
				$EndSemester = $_GET['EndSemester'];
			}			
			$includedSemestersRaw = $this->Student->query("Select * From semesters where startingDate >= (select startingDate from semesters where id = " . $startSemester . ") AND startingDate <= (select startingDate from semesters where id = " . $EndSemester . ")");

			
			$includedSemesters = '(';
				foreach($includedSemestersRaw as $I_S){
				$includedSemesters = $includedSemesters . $I_S['semesters']['id'] . ',';
			}
			$includedSemesters = substr($includedSemesters,0,-1) . ')';
			//die(var_dump($includedSemesters));
			$semesters = $this->Student->query("SELECT * From semesters order by year, semester");
			$StatsType = 'Total';
			if(isset($_GET['StatsType'])){
				$StatsType = $_GET['StatsType'];
			}				
			$which = 'Total';
			if(isset($_GET['which'])){
				$which = $_GET['which'];
			}			
			

			$mySchools = $this->Student->query("SELECT centers.id, centers.title from centers");
			//die(var_dump($mySchools));
			//Find Schools
			//$mySchools = $this->Student->query("SELECT schools.id, schools.name from schools JOIN users_centers on schools.center_id = users_centers.center_id WHERE users_centers.user_id = " . $this->currentUser['id']);
			
			$schoolCount = 0;
			foreach($mySchools as $school){
				$mySchools[$schoolCount]['centers']['studentsWorkedWith'] = $this->Student->query("SELECT count(*) from students where school_id IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ")");
				$mySchools[$schoolCount]['centers']['participated_last_semester'] = $this->Student->query("SELECT count(*) from students where school_id  IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ") AND id in( SELECT student_id from students_semesters where semester_id in " . $includedSemesters . ")");
				$mySchools[$schoolCount]['centers']['members'] = $this->Student->query("SELECT count(*) from students where civics_status = 'member' AND school_id IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ")");
				$mySchools[$schoolCount]['centers']['countries'] = $this->Student->query("SELECT count(distinct country) from students where school_id  IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ") AND id in( SELECT student_id from students_semesters where semester_id in " . $includedSemesters . ")");
				$mySchools[$schoolCount]['centers']['internship_locations'] = $this->Student->query("SELECT count(distinct internship_location) from students where school_id IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ") AND internship_semester_id IN " . $includedSemesters . " AND id in( SELECT student_id from students_semesters where semester_id in " . $includedSemesters . ")");
				$mySchools[$schoolCount]['centers']['started_last_semester'] = $this->Student->query("Select count(*) from students where semester_member IN " . $includedSemesters . " AND school_id  IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ")");
				$mySchools[$schoolCount]['centers']['interns_last_semester'] = $this->Student->query("SELECT count(*) from students where internship_semester_id IN " . $includedSemesters . " AND school_id  IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ")");
				$mySchools[$schoolCount]['centers']['interns_all_time'] = $this->Student->query("SELECT count(*) from students where internship_semester_id is not null AND school_id  IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ")");
				$mySchools[$schoolCount]['centers']['newMembers'] = $this->Student->query("SELECT count(*) from students where civics_status = 'member' AND school_id IN (SELECT id from schools where center_id = " . $school['centers']['id'] . ') AND semester_member IN ' . $includedSemesters );
				$schoolCount++;
			}
			
			if(isset($_GET['Center']) && isset($_GET['Stat'])){
				if($_GET['Stat'] == 'AllMembers'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where civics_status = 'member' 
						AND school_id IN (SELECT id from schools where center_id = " . $_GET['Center'] . ")");
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}
				}elseif($_GET['Stat'] == 'AllStudents'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where school_id IN (
							SELECT id from schools where center_id = " . $_GET['Center'] . ")");
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}
				}elseif($_GET['Stat'] == 'TheseStudents'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where school_id  IN (SELECT id from schools where center_id = " . $_GET['Center'] . ") 
						AND id in( SELECT student_id from students_semesters where semester_id in " . $includedSemesters . ")");
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}				
				}elseif($_GET['Stat'] == 'TheseMembers'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where civics_status = 'member' 
						AND school_id IN (SELECT id from schools where center_id = " . $_GET['Center'] . ') 
						AND semester_member IN ' . $includedSemesters );
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}					
				}elseif($_GET['Stat'] == 'TheseInterns'){
					$valuesRaw = $this->Student->query(
						"SELECT id, CONCAT(first_name, ' ', last_name) from students 
						where internship_semester_id IN " . $includedSemesters . " 
						AND school_id  IN (SELECT id from schools where center_id = " . $_GET['Center'] . ")");
				
					$i = 0;
					foreach($valuesRaw as $v){
						$values[$i] = '<a href=\'../students/view/' . $v['students']['id'] . '\'> ' . $v[0]['CONCAT(first_name, \' \', last_name)'] . '</a>';
						$i++;
					}				
				}elseif($_GET['Stat'] == 'TheseSites'){
					$valuesRaw = $this->Student->query(
						"SELECT distinct internship_location from students 
						where school_id IN (SELECT id from schools where center_id = " . $_GET['Center'] . ") 
						AND id in( SELECT student_id from students_semesters 
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
						where school_id IN (SELECT id from schools where center_id = " . $_GET['Center'] . ") 
						AND id in( SELECT student_id from students_semesters 
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
			
			$this->set(compact('semesters', 'totalStudentsWorkedWith', 'totalMembers', 
								'totalCountries', 'totalInternshipLocations',
								'todayStaffBirthdays', 'todayStudentBirthdays', 
								'nextDay', 'tomorrowStaffBirthdays', 
								'tomorrowStudentBirthdays', 'nextDayStaffBirthdays', 
								'nextDayStudentBirthdays', 'mySchools',
								'totalStartedLastSemester', 'totalParticipantsLastSemester',
								'totalInternsLastSemester', 'totalInternsAllTime',
								'studentsInHS','studentsInCollege','studentsWorking',
								'studentsUnemployed','other', 'includedSemestersRaw',
								'males', 'females', 'unknownGender', 'values',
								'startSemester', 'EndSemester'));
		}
		
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
}
