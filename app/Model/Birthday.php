<?php
App::uses('AppModel', 'Model');
/**
 * Birthday Model
 *
 */
class Birthday extends AppModel {

	// This model is to abstract out birthday logic, DO NOT USE TABLE
	public $useTable = false;

	private $birthdayMapping = array(
		'1' => 'Sunday',
		'2' => 'Monday',
		'3' => 'Tuesday',
		'4' => 'Wednesday',
		'5' => 'Thursday',
		'6' => 'Friday',
		'7' => 'Saturday'
	);

	public function __construct() {
		// Nothing to do here
	}

	public function getDayOfWeek($nextDay) {
		$dayNumber = $nextDay[0][0]['day'];
		return $this->birthdayMapping[$dayNumber];
	}

	public function getBirthdayInfo() {
		// Queries from before are copied over
		$todayStaffBirthdays = $this->query("Select CONCAT(first_name, ' ' , last_name) as name, id from users where MONTH(birthday) = MONTH(now()) AND DAYOFMONTH(birthday) = DAYOFMONTH(now())");
		$todayStudentBirthdays = $this->query("Select CONCAT(first_name, ' ' , last_name) as name, id from students where MONTH(birthday) = MONTH(now()) AND DAYOFMONTH(birthday) = DAYOFMONTH(now())");
		$nextDay = $this->query("SELECT DAYOFWEEK(DATE_ADD(NOW(), INTERVAL 2 DAY)) as day");
		$tomorrowStaffBirthdays = $this->query("Select CONCAT(first_name, ' ' , last_name) as name, id from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
		$tomorrowStudentBirthdays = $this->query("Select CONCAT(first_name, ' ' , last_name) as name, id from students where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 1 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 1 DAY))");
		$nextDayStaffBirthdays = $this->query("Select CONCAT(first_name, ' ' , last_name) as name, id from users where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");
		$nextDayStudentBirthdays = $this->query("Select CONCAT(first_name, ' ' , last_name) as name, id from students where MONTH(birthday) = MONTH(DATE_ADD(now(), INTERVAL 2 DAY)) AND DAYOFMONTH(birthday) = DAYOFMONTH(DATE_ADD(now(), INTERVAL 2 DAY))");

		// Transform data to have clean, nested structure
		return array(
			'today' => array(
				'staff' => $todayStaffBirthdays,
				'students' => $todayStudentBirthdays
			),
			'nextDay' => $this->getDayOfWeek($nextDay),
			'tomorrow' => array(
				'staff' => $tomorrowStaffBirthdays,
				'students' => $tomorrowStudentBirthdays
			),
			'dayAfter' => array(
				'staff' => $nextDayStaffBirthdays,
				'students' => $nextDayStudentBirthdays
			)
		);
	}

}
