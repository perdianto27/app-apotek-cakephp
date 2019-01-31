<?php
App::uses('SaleItem', 'Model');

/**
 * SaleItem Test Case
 *
 */
class SaleItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sale_item',
		'app.sale',
		'app.product',
		'app.invoice_item',
		'app.invoice',
		'app.purchase_order_item',
		'app.purchase_orders'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SaleItem = ClassRegistry::init('SaleItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SaleItem);

		parent::tearDown();
	}

}
