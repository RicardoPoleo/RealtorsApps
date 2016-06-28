<?php
App::uses('FutureTenant', 'Model');

/**
 * FutureTenant Test Case
 */
class FutureTenantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.future_tenant'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FutureTenant = ClassRegistry::init('FutureTenant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FutureTenant);

		parent::tearDown();
	}

}
