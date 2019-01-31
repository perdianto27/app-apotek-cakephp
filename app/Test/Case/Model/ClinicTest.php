<?php
App::uses('Clinic', 'Model');

/**
 * Clinic Test Case
 *
 */
class ClinicTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.clinic',
		'app.purchase_order',
		'app.sale'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Clinic = ClassRegistry::init('Clinic');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Clinic);

		parent::tearDown();
	}

}
