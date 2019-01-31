<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 * @property Sale $Sale
 * @property PaginatorComponent $Paginator
 */
class SalesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->Sale->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'Sale');
    $this->set('sales', $this->Sale->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->Sale->exists($id)) {
        throw new NotFoundException(__('Invalid sale'));
    }
    $this->Sale->recursive = 2;  
    $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
    $this->set('sale', $this->Sale->find('first', $options));    
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
        'conditions' => array('Sale.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->Sale->recursive = 0;
    $this->set('sales', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/sales/index.css'];
    $this->js = ['/js/sales/index.js'];
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
    if (!$this->Sale->exists($id)) {
        throw new NotFoundException(__('Invalid sale'));
    }
    $this->Sale->recursive = 2;  
    $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
    $this->set('sale', $this->Sale->find('first', $options));

    #css&js
    $this->css=['/css/sales/view.css'];
    $this->js = ['/js/sales/view.js'];
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
    $this->Sale->create();
    if ($this->Sale->save($this->request->data)) {
                $this->Flash->success(__('The sale has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The sale could not be saved. Please, try again.'));
        }
}
		$customers = $this->Sale->Customer->find('list');
		$clinics = $this->Sale->Clinic->find('list');
		$this->set(compact('customers', 'clinics'));
$this->css=['/css/sales/add.css'];
$this->js = ['/js/sales/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->Sale->exists($id)) {
throw new NotFoundException(__('Invalid sale'));
}
if ($this->request->is(array('post', 'put'))) {
$this->Sale->create();
if ($this->Sale->save($this->request->data)) {
    $this->Flash->success(__('The sale has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The sale could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
$this->request->data = $this->Sale->find('first', $options);
}
		$customers = $this->Sale->Customer->find('list');
		$clinics = $this->Sale->Clinic->find('list');
		$this->set(compact('customers', 'clinics'));
$this->css=['/css/sales/copy.css'];
$this->js = ['/js/sales/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->Sale->exists($id)) {
throw new NotFoundException(__('Invalid sale'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->Sale->save($this->request->data)) {
    $this->Flash->success(__('The sale has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The sale could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
$this->request->data = $this->Sale->find('first', $options);
}
		$customers = $this->Sale->Customer->find('list');
		$clinics = $this->Sale->Clinic->find('list');
		$this->set(compact('customers', 'clinics', 'customers', 'clinics'));
$this->css=['/css/sales/edit.css'];
$this->js = ['/js/sales/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->Sale->id = $id;
if (!$this->Sale->exists()) {
throw new NotFoundException(__('Invalid sale'));
}
$this->request->allowMethod('post', 'delete');
if ($this->Sale->delete()) {
    $this->Flash->success(__('The sale has been deleted.'));
    } else {
    $this->Flash->error(__('The sale could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
