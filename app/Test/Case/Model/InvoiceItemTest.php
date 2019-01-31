<?php
App::uses('InvoiceItem', 'Model');

/**
 * InvoiceItem Test Case
 *
 */
class InvoiceItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.invoice_item',
		'app.invoice',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InvoiceItem = ClassRegistry::init('InvoiceItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvoiceItem);

		parent::tearDown();
	}

}
