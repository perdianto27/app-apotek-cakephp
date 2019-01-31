<?php
App::uses('AppModel', 'Model');
/**
 * Supplier Model
 *
 * @property PurchaseOrder $PurchaseOrder
 */
class Supplier extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PurchaseOrder' => array(
			'className' => 'PurchaseOrder',
			'foreignKey' => 'supplier_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
