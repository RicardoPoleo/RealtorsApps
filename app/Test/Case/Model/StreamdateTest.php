<?php
App::uses('Streamdate', 'Model');

/**
 * Streamdate Test Case
 */
class StreamdateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.streamdate',
		'app.properties'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Streamdate = ClassRegistry::init('Streamdate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Streamdate);

		parent::tearDown();
	}

}
