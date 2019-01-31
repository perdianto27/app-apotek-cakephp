<?php
/**
 * PurchaseOrderFixture
 *
 */
class PurchaseOrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'total_amount' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'selesai' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'clinic_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'supplier_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_purchase_orders_clinics1' => array('column' => 'clinic_id', 'unique' => 0),
			'fk_purchase_orders_suppliers1' => array('column' => 'supplier_id', 'unique' => 0)
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
			'date' => '2018-07-15 09:32:07',
			'total_amount' => 1,
			'selesai' => 'Lorem ipsum dolor sit ame',
			'clinic_id' => 1,
			'supplier_id' => 1
		),
	);

}
