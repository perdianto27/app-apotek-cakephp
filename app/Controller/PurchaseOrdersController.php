<?php
App::uses('AppController', 'Controller');
/**
 * PurchaseOrders Controller
 *
 * @property PurchaseOrder $PurchaseOrder
 * @property PaginatorComponent $Paginator
 */
class PurchaseOrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->PurchaseOrder->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'PurchaseOrder');
    $this->set('purchaseOrders', $this->PurchaseOrder->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->PurchaseOrder->exists($id)) {
        throw new NotFoundException(__('Invalid purchase order'));
    }
    $this->PurchaseOrder->recursive = 2;  
    $options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
    $this->set('purchaseOrder', $this->PurchaseOrder->find('first', $options));    
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
        'conditions' => array('PurchaseOrder.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->PurchaseOrder->recursive = 0;
    $this->set('purchaseOrders', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/purchaseorders/index.css'];
    $this->js = ['/js/purchaseorders/index.js'];
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
    if (!$this->PurchaseOrder->exists($id)) {
        throw new NotFoundException(__('Invalid purchase order'));
    }
    $this->PurchaseOrder->recursive = 2;  
    $options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
    $this->set('purchaseOrder', $this->PurchaseOrder->find('first', $options));

    #css&js
    $this->css=['/css/purchaseorders/view.css'];
    $this->js = ['/js/purchaseorders/view.js'];
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
    $this->PurchaseOrder->create();
    if ($this->PurchaseOrder->save($this->request->data)) {
                $this->Flash->success(__('The purchase order has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
        }
}
		$clinics = $this->PurchaseOrder->Clinic->find('list');
		$suppliers = $this->PurchaseOrder->Supplier->find('list');
		$this->set(compact('clinics', 'suppliers'));
$this->css=['/css/purchaseorders/add.css'];
$this->js = ['/js/purchaseorders/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->PurchaseOrder->exists($id)) {
throw new NotFoundException(__('Invalid purchase order'));
}
if ($this->request->is(array('post', 'put'))) {
$this->PurchaseOrder->create();
if ($this->PurchaseOrder->save($this->request->data)) {
    $this->Flash->success(__('The purchase order has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
$this->request->data = $this->PurchaseOrder->find('first', $options);
}
		$clinics = $this->PurchaseOrder->Clinic->find('list');
		$suppliers = $this->PurchaseOrder->Supplier->find('list');
		$this->set(compact('clinics', 'suppliers'));
$this->css=['/css/purchaseorders/copy.css'];
$this->js = ['/js/purchaseorders/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->PurchaseOrder->exists($id)) {
throw new NotFoundException(__('Invalid purchase order'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->PurchaseOrder->save($this->request->data)) {
    $this->Flash->success(__('The purchase order has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The purchase order could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
$this->request->data = $this->PurchaseOrder->find('first', $options);
}
		$clinics = $this->PurchaseOrder->Clinic->find('list');
		$suppliers = $this->PurchaseOrder->Supplier->find('list');
		$this->set(compact('clinics', 'suppliers', 'clinics', 'suppliers'));
$this->css=['/css/purchaseorders/edit.css'];
$this->js = ['/js/purchaseorders/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->PurchaseOrder->id = $id;
if (!$this->PurchaseOrder->exists()) {
throw new NotFoundException(__('Invalid purchase order'));
}
$this->request->allowMethod('post', 'delete');
if ($this->PurchaseOrder->delete()) {
    $this->Flash->success(__('The purchase order has been deleted.'));
    } else {
    $this->Flash->error(__('The purchase order could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
