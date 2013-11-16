<?php
App::uses('Meeting', 'Model');

/**
 * Meeting Test Case
 *
 */
class MeetingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.meeting',
		'app.student',
		'app.meetings_student',
		'app.user',
		'app.users_meeting'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Meeting = ClassRegistry::init('Meeting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Meeting);

		parent::tearDown();
	}

}
