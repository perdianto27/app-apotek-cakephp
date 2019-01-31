<?php
/**
 * PurchaseOrderItemFixture
 *
 */
class PurchaseOrderItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'price' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'qty' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'purchase_orders_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_purchase_order_items_purchase_orders1' => array('column' => 'purchase_orders_id', 'unique' => 0),
			'fk_purchase_order_items_products1' => array('column' => 'product_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'price' => 1,
			'qty' => 1,
			'purchase_orders_id' => 1,
			'product_id' => 1
		),
	);

}
