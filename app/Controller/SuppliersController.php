<?php
App::uses('AppController', 'Controller');
/**
 * Suppliers Controller
 *
 * @property Supplier $Supplier
 * @property PaginatorComponent $Paginator
 */
class SuppliersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->Supplier->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'Supplier');
    $this->set('suppliers', $this->Supplier->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->Supplier->exists($id)) {
        throw new NotFoundException(__('Invalid supplier'));
    }
    $this->Supplier->recursive = 2;  
    $options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
    $this->set('supplier', $this->Supplier->find('first', $options));    
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
        'conditions' => array('Supplier.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->Supplier->recursive = 0;
    $this->set('suppliers', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/suppliers/index.css'];
    $this->js = ['/js/suppliers/index.js'];
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
    if (!$this->Supplier->exists($id)) {
        throw new NotFoundException(__('Invalid supplier'));
    }
    $this->Supplier->recursive = 2;  
    $options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
    $this->set('supplier', $this->Supplier->find('first', $options));

    #css&js
    $this->css=['/css/suppliers/view.css'];
    $this->js = ['/js/suppliers/view.js'];
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
    $this->Supplier->create();
    if ($this->Supplier->save($this->request->data)) {
                $this->Flash->success(__('The supplier has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The supplier could not be saved. Please, try again.'));
        }
}
$this->css=['/css/suppliers/add.css'];
$this->js = ['/js/suppliers/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->Supplier->exists($id)) {
throw new NotFoundException(__('Invalid supplier'));
}
if ($this->request->is(array('post', 'put'))) {
$this->Supplier->create();
if ($this->Supplier->save($this->request->data)) {
    $this->Flash->success(__('The supplier has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The supplier could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
$this->request->data = $this->Supplier->find('first', $options);
}
$this->css=['/css/suppliers/copy.css'];
$this->js = ['/js/suppliers/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->Supplier->exists($id)) {
throw new NotFoundException(__('Invalid supplier'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->Supplier->save($this->request->data)) {
    $this->Flash->success(__('The supplier has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The supplier could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Supplier.' . $this->Supplier->primaryKey => $id));
$this->request->data = $this->Supplier->find('first', $options);
}
$this->css=['/css/suppliers/edit.css'];
$this->js = ['/js/suppliers/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->Supplier->id = $id;
if (!$this->Supplier->exists()) {
throw new NotFoundException(__('Invalid supplier'));
}
$this->request->allowMethod('post', 'delete');
if ($this->Supplier->delete()) {
    $this->Flash->success(__('The supplier has been deleted.'));
    } else {
    $this->Flash->error(__('The supplier could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
