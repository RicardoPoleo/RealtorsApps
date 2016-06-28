<?php
App::uses('PropertiesOwner', 'Model');

/**
 * PropertiesOwner Test Case
 */
class PropertiesOwnerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.properties_owner'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PropertiesOwner = ClassRegistry::init('PropertiesOwner');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PropertiesOwner);

		parent::tearDown();
	}

}
