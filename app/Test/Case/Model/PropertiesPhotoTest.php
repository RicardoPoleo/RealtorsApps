<?php
App::uses('PropertiesPhoto', 'Model');

/**
 * PropertiesPhoto Test Case
 */
class PropertiesPhotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.properties_photo',
		'app.properties'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PropertiesPhoto = ClassRegistry::init('PropertiesPhoto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PropertiesPhoto);

		parent::tearDown();
	}

}
