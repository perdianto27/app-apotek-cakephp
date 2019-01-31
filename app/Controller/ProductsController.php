<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->Product->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'Product');
    $this->set('products', $this->Product->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->Product->exists($id)) {
        throw new NotFoundException(__('Invalid product'));
    }
    $this->Product->recursive = 2;  
    $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
    $this->set('product', $this->Product->find('first', $options));    
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
        'conditions' => array('Product.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->Product->recursive = 0;
    $this->set('products', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/products/index.css'];
    $this->js = ['/js/products/index.js'];
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
    if (!$this->Product->exists($id)) {
        throw new NotFoundException(__('Invalid product'));
    }
    $this->Product->recursive = 2;  
    $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
    $this->set('product', $this->Product->find('first', $options));

    #css&js
    $this->css=['/css/products/view.css'];
    $this->js = ['/js/products/view.js'];
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
    $this->Product->create();
    if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
}
$this->css=['/css/products/add.css'];
$this->js = ['/js/products/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->Product->exists($id)) {
throw new NotFoundException(__('Invalid product'));
}
if ($this->request->is(array('post', 'put'))) {
$this->Product->create();
if ($this->Product->save($this->request->data)) {
    $this->Flash->success(__('The product has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The product could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
$this->request->data = $this->Product->find('first', $options);
}
$this->css=['/css/products/copy.css'];
$this->js = ['/js/products/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->Product->exists($id)) {
throw new NotFoundException(__('Invalid product'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->Product->save($this->request->data)) {
    $this->Flash->success(__('The product has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The product could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
$this->request->data = $this->Product->find('first', $options);
}
$this->css=['/css/products/edit.css'];
$this->js = ['/js/products/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->Product->id = $id;
if (!$this->Product->exists()) {
throw new NotFoundException(__('Invalid product'));
}
$this->request->allowMethod('post', 'delete');
if ($this->Product->delete()) {
    $this->Flash->success(__('The product has been deleted.'));
    } else {
    $this->Flash->error(__('The product could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
