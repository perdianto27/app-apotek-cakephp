<?php
App::uses('AppController', 'Controller');
/**
 * PurchaseOrderItems Controller
 *
 * @property PurchaseOrderItem $PurchaseOrderItem
 * @property PaginatorComponent $Paginator
 */
class PurchaseOrderItemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->PurchaseOrderItem->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'PurchaseOrderItem');
    $this->set('purchaseOrderItems', $this->PurchaseOrderItem->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->PurchaseOrderItem->exists($id)) {
        throw new NotFoundException(__('Invalid purchase order item'));
    }
    $this->PurchaseOrderItem->recursive = 2;  
    $options = array('conditions' => array('PurchaseOrderItem.' . $this->PurchaseOrderItem->primaryKey => $id));
    $this->set('purchaseOrderItem', $this->PurchaseOrderItem->find('first', $options));    
    $this->response->type('application/pdf');
    $this->render('print_single');
}


/**
* index method
*
* @return void
*/
public function index() {

    $cond='';
    if ($this->request->query) {
        $cond = $this->request->query['search'];
        $this->Paginator->settings = array(
        'conditions' => array('PurchaseOrderItem.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->PurchaseOrderItem->recursive = 0;
    $this->set('purchaseOrderItems', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/purchaseorderitems/index.css'];
    $this->js = ['/js/purchaseorderitems/index.js'];
    $this->set('jsIncludes', $this->js);        
    $this->set('cssIncludes', $this->css); 
}

/**
* view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function view($id = null) {
    if (!$this->PurchaseOrderItem->exists($id)) {
        throw new NotFoundException(__('Invalid purchase order item'));
    }
    $this->PurchaseOrderItem->recursive = 2;  
    $options = array('conditions' => array('PurchaseOrderItem.' . $this->PurchaseOrderItem->primaryKey => $id));
    $this->set('purchaseOrderItem', $this->PurchaseOrderItem->find('first', $options));

    #css&js
    $this->css=['/css/purchaseorderitems/view.css'];
    $this->js = ['/js/purchaseorderitems/view.js'];
    $this->set('jsIncludes', $this->js);        
    $this->set('cssIncludes', $this->css);
    }

/**
* add method
*
* @return void
*/
public function add() {
if ($this->request->is('post')) {
    $this->PurchaseOrderItem->create();
    if ($this->PurchaseOrderItem->save($this->request->data)) {
                $this->Flash->success(__('The purchase order item has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The purchase order item could not be saved. Please, try again.'));
        }
}
		$purchaseOrders = $this->PurchaseOrderItem->PurchaseOrder->find('list');
		$products = $this->PurchaseOrderItem->Product->find('list');
		$this->set(compact('purchaseOrders', 'products'));
$this->css=['/css/purchaseorderitems/add.css'];
$this->js = ['/js/purchaseorderitems/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);        
}

/**
* edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function copy($id = null) {
if (!$this->PurchaseOrderItem->exists($id)) {
throw new NotFoundException(__('Invalid purchase order item'));
}
if ($this->request->is(array('post', 'put'))) {
$this->PurchaseOrderItem->create();
if ($this->PurchaseOrderItem->save($this->request->data)) {
    $this->Flash->success(__('The purchase order item has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The purchase order item could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('PurchaseOrderItem.' . $this->PurchaseOrderItem->primaryKey => $id));
$this->request->data = $this->PurchaseOrderItem->find('first', $options);
}
		$purchaseOrders = $this->PurchaseOrderItem->PurchaseOrder->find('list');
		$products = $this->PurchaseOrderItem->Product->find('list');
		$this->set(compact('purchaseOrders', 'products'));
$this->css=['/css/purchaseorderitems/copy.css'];
$this->js = ['/js/purchaseorderitems/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->PurchaseOrderItem->exists($id)) {
throw new NotFoundException(__('Invalid purchase order item'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->PurchaseOrderItem->save($this->request->data)) {
    $this->Flash->success(__('The purchase order item has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The purchase order item could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('PurchaseOrderItem.' . $this->PurchaseOrderItem->primaryKey => $id));
$this->request->data = $this->PurchaseOrderItem->find('first', $options);
}
		$purchaseOrders = $this->PurchaseOrderItem->PurchaseOrder->find('list');
		$products = $this->PurchaseOrderItem->Product->find('list');
		$this->set(compact('purchaseOrders', 'products', 'purchaseOrders', 'products'));
$this->css=['/css/purchaseorderitems/edit.css'];
$this->js = ['/js/purchaseorderitems/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);   

}

/**
* delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function delete($id = null) {
$this->PurchaseOrderItem->id = $id;
if (!$this->PurchaseOrderItem->exists()) {
throw new NotFoundException(__('Invalid purchase order item'));
}
$this->request->allowMethod('post', 'delete');
if ($this->PurchaseOrderItem->delete()) {
    $this->Flash->success(__('The purchase order item has been deleted.'));
    } else {
    $this->Flash->error(__('The purchase order item could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
