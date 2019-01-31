<?php
App::uses('PurchaseOrder', 'Model');

/**
 * PurchaseOrder Test Case
 *
 */
class PurchaseOrderTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchase_order',
		'app.clinic',
		'app.sale',
		'app.supplier'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PurchaseOrder = ClassRegistry::init('PurchaseOrder');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PurchaseOrder);

		parent::tearDown();
	}

}
