<?php
App::uses('AppController', 'Controller');
/**
 * Invoices Controller
 *
 * @property Invoice $Invoice
 * @property PaginatorComponent $Paginator
 */
class InvoicesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->Invoice->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'Invoice');
    $this->set('invoices', $this->Invoice->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->Invoice->exists($id)) {
        throw new NotFoundException(__('Invalid invoice'));
    }
    $this->Invoice->recursive = 2;  
    $options = array('conditions' => array('Invoice.' . $this->Invoice->primaryKey => $id));
    $this->set('invoice', $this->Invoice->find('first', $options));    
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
        'conditions' => array('Invoice.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->Invoice->recursive = 0;
    $this->set('invoices', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/invoices/index.css'];
    $this->js = ['/js/invoices/index.js'];
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
    if (!$this->Invoice->exists($id)) {
        throw new NotFoundException(__('Invalid invoice'));
    }
    $this->Invoice->recursive = 2;  
    $options = array('conditions' => array('Invoice.' . $this->Invoice->primaryKey => $id));
    $this->set('invoice', $this->Invoice->find('first', $options));

    #css&js
    $this->css=['/css/invoices/view.css'];
    $this->js = ['/js/invoices/view.js'];
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
    $this->Invoice->create();
    if ($this->Invoice->save($this->request->data)) {
                $this->Flash->success(__('The invoice has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
}
		$sales = $this->Invoice->Sale->find('list');
		$this->set(compact('sales'));
$this->css=['/css/invoices/add.css'];
$this->js = ['/js/invoices/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->Invoice->exists($id)) {
throw new NotFoundException(__('Invalid invoice'));
}
if ($this->request->is(array('post', 'put'))) {
$this->Invoice->create();
if ($this->Invoice->save($this->request->data)) {
    $this->Flash->success(__('The invoice has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Invoice.' . $this->Invoice->primaryKey => $id));
$this->request->data = $this->Invoice->find('first', $options);
}
		$sales = $this->Invoice->Sale->find('list');
		$this->set(compact('sales'));
$this->css=['/css/invoices/copy.css'];
$this->js = ['/js/invoices/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->Invoice->exists($id)) {
throw new NotFoundException(__('Invalid invoice'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->Invoice->save($this->request->data)) {
    $this->Flash->success(__('The invoice has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Invoice.' . $this->Invoice->primaryKey => $id));
$this->request->data = $this->Invoice->find('first', $options);
}
		$sales = $this->Invoice->Sale->find('list');
		$this->set(compact('sales', 'sales'));
$this->css=['/css/invoices/edit.css'];
$this->js = ['/js/invoices/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->Invoice->id = $id;
if (!$this->Invoice->exists()) {
throw new NotFoundException(__('Invalid invoice'));
}
$this->request->allowMethod('post', 'delete');
if ($this->Invoice->delete()) {
    $this->Flash->success(__('The invoice has been deleted.'));
    } else {
    $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
