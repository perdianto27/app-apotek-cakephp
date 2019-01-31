<?php
App::uses('AppController', 'Controller');
/**
 * InvoiceItems Controller
 *
 * @property InvoiceItem $InvoiceItem
 * @property PaginatorComponent $Paginator
 */
class InvoiceItemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->InvoiceItem->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'InvoiceItem');
    $this->set('invoiceItems', $this->InvoiceItem->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->InvoiceItem->exists($id)) {
        throw new NotFoundException(__('Invalid invoice item'));
    }
    $this->InvoiceItem->recursive = 2;  
    $options = array('conditions' => array('InvoiceItem.' . $this->InvoiceItem->primaryKey => $id));
    $this->set('invoiceItem', $this->InvoiceItem->find('first', $options));    
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
        'conditions' => array('InvoiceItem.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->InvoiceItem->recursive = 0;
    $this->set('invoiceItems', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/invoiceitems/index.css'];
    $this->js = ['/js/invoiceitems/index.js'];
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
    if (!$this->InvoiceItem->exists($id)) {
        throw new NotFoundException(__('Invalid invoice item'));
    }
    $this->InvoiceItem->recursive = 2;  
    $options = array('conditions' => array('InvoiceItem.' . $this->InvoiceItem->primaryKey => $id));
    $this->set('invoiceItem', $this->InvoiceItem->find('first', $options));

    #css&js
    $this->css=['/css/invoiceitems/view.css'];
    $this->js = ['/js/invoiceitems/view.js'];
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
    $this->InvoiceItem->create();
    if ($this->InvoiceItem->save($this->request->data)) {
                $this->Flash->success(__('The invoice item has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
        }
}
		$invoices = $this->InvoiceItem->Invoice->find('list');
		$products = $this->InvoiceItem->Product->find('list');
		$this->set(compact('invoices', 'products'));
$this->css=['/css/invoiceitems/add.css'];
$this->js = ['/js/invoiceitems/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->InvoiceItem->exists($id)) {
throw new NotFoundException(__('Invalid invoice item'));
}
if ($this->request->is(array('post', 'put'))) {
$this->InvoiceItem->create();
if ($this->InvoiceItem->save($this->request->data)) {
    $this->Flash->success(__('The invoice item has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('InvoiceItem.' . $this->InvoiceItem->primaryKey => $id));
$this->request->data = $this->InvoiceItem->find('first', $options);
}
		$invoices = $this->InvoiceItem->Invoice->find('list');
		$products = $this->InvoiceItem->Product->find('list');
		$this->set(compact('invoices', 'products'));
$this->css=['/css/invoiceitems/copy.css'];
$this->js = ['/js/invoiceitems/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->InvoiceItem->exists($id)) {
throw new NotFoundException(__('Invalid invoice item'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->InvoiceItem->save($this->request->data)) {
    $this->Flash->success(__('The invoice item has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The invoice item could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('InvoiceItem.' . $this->InvoiceItem->primaryKey => $id));
$this->request->data = $this->InvoiceItem->find('first', $options);
}
		$invoices = $this->InvoiceItem->Invoice->find('list');
		$products = $this->InvoiceItem->Product->find('list');
		$this->set(compact('invoices', 'products', 'invoices', 'products'));
$this->css=['/css/invoiceitems/edit.css'];
$this->js = ['/js/invoiceitems/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->InvoiceItem->id = $id;
if (!$this->InvoiceItem->exists()) {
throw new NotFoundException(__('Invalid invoice item'));
}
$this->request->allowMethod('post', 'delete');
if ($this->InvoiceItem->delete()) {
    $this->Flash->success(__('The invoice item has been deleted.'));
    } else {
    $this->Flash->error(__('The invoice item could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
