<?php
App::uses('PurchaseOrderItem', 'Model');

/**
 * PurchaseOrderItem Test Case
 *
 */
class PurchaseOrderItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchase_order_item',
		'app.purchase_orders',
		'app.product',
		'app.invoice_item',
		'app.invoice',
		'app.sale',
		'app.sale_item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PurchaseOrderItem = ClassRegistry::init('PurchaseOrderItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PurchaseOrderItem);

		parent::tearDown();
	}

}
