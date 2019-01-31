<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 * @property PaginatorComponent $Paginator
 */
class CustomersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->Customer->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'Customer');
    $this->set('customers', $this->Customer->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->Customer->exists($id)) {
        throw new NotFoundException(__('Invalid customer'));
    }
    $this->Customer->recursive = 2;  
    $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
    $this->set('customer', $this->Customer->find('first', $options));    
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
        'conditions' => array('Customer.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->Customer->recursive = 0;
    $this->set('customers', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/customers/index.css'];
    $this->js = ['/js/customers/index.js'];
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
    if (!$this->Customer->exists($id)) {
        throw new NotFoundException(__('Invalid customer'));
    }
    $this->Customer->recursive = 2;  
    $options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
    $this->set('customer', $this->Customer->find('first', $options));

    #css&js
    $this->css=['/css/customers/view.css'];
    $this->js = ['/js/customers/view.js'];
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
    $this->Customer->create();
    if ($this->Customer->save($this->request->data)) {
                $this->Flash->success(__('The customer has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
}
$this->css=['/css/customers/add.css'];
$this->js = ['/js/customers/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->Customer->exists($id)) {
throw new NotFoundException(__('Invalid customer'));
}
if ($this->request->is(array('post', 'put'))) {
$this->Customer->create();
if ($this->Customer->save($this->request->data)) {
    $this->Flash->success(__('The customer has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The customer could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
$this->request->data = $this->Customer->find('first', $options);
}
$this->css=['/css/customers/copy.css'];
$this->js = ['/js/customers/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->Customer->exists($id)) {
throw new NotFoundException(__('Invalid customer'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->Customer->save($this->request->data)) {
    $this->Flash->success(__('The customer has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The customer could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Customer.' . $this->Customer->primaryKey => $id));
$this->request->data = $this->Customer->find('first', $options);
}
$this->css=['/css/customers/edit.css'];
$this->js = ['/js/customers/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->Customer->id = $id;
if (!$this->Customer->exists()) {
throw new NotFoundException(__('Invalid customer'));
}
$this->request->allowMethod('post', 'delete');
if ($this->Customer->delete()) {
    $this->Flash->success(__('The customer has been deleted.'));
    } else {
    $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
