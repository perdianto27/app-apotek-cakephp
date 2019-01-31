<?php
App::uses('AppController', 'Controller');
/**
 * SaleItems Controller
 *
 * @property SaleItem $SaleItem
 * @property PaginatorComponent $Paginator
 */
class SaleItemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->SaleItem->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'SaleItem');
    $this->set('saleItems', $this->SaleItem->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->SaleItem->exists($id)) {
        throw new NotFoundException(__('Invalid sale item'));
    }
    $this->SaleItem->recursive = 2;  
    $options = array('conditions' => array('SaleItem.' . $this->SaleItem->primaryKey => $id));
    $this->set('saleItem', $this->SaleItem->find('first', $options));    
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
        'conditions' => array('SaleItem.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->SaleItem->recursive = 0;
    $this->set('saleItems', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/saleitems/index.css'];
    $this->js = ['/js/saleitems/index.js'];
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
    if (!$this->SaleItem->exists($id)) {
        throw new NotFoundException(__('Invalid sale item'));
    }
    $this->SaleItem->recursive = 2;  
    $options = array('conditions' => array('SaleItem.' . $this->SaleItem->primaryKey => $id));
    $this->set('saleItem', $this->SaleItem->find('first', $options));

    #css&js
    $this->css=['/css/saleitems/view.css'];
    $this->js = ['/js/saleitems/view.js'];
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
    $this->SaleItem->create();
    if ($this->SaleItem->save($this->request->data)) {
                $this->Flash->success(__('The sale item has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The sale item could not be saved. Please, try again.'));
        }
}
		$sales = $this->SaleItem->Sale->find('list');
		$products = $this->SaleItem->Product->find('list');
		$this->set(compact('sales', 'products'));
$this->css=['/css/saleitems/add.css'];
$this->js = ['/js/saleitems/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->SaleItem->exists($id)) {
throw new NotFoundException(__('Invalid sale item'));
}
if ($this->request->is(array('post', 'put'))) {
$this->SaleItem->create();
if ($this->SaleItem->save($this->request->data)) {
    $this->Flash->success(__('The sale item has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The sale item could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('SaleItem.' . $this->SaleItem->primaryKey => $id));
$this->request->data = $this->SaleItem->find('first', $options);
}
		$sales = $this->SaleItem->Sale->find('list');
		$products = $this->SaleItem->Product->find('list');
		$this->set(compact('sales', 'products'));
$this->css=['/css/saleitems/copy.css'];
$this->js = ['/js/saleitems/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->SaleItem->exists($id)) {
throw new NotFoundException(__('Invalid sale item'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->SaleItem->save($this->request->data)) {
    $this->Flash->success(__('The sale item has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The sale item could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('SaleItem.' . $this->SaleItem->primaryKey => $id));
$this->request->data = $this->SaleItem->find('first', $options);
}
		$sales = $this->SaleItem->Sale->find('list');
		$products = $this->SaleItem->Product->find('list');
		$this->set(compact('sales', 'products', 'sales', 'products'));
$this->css=['/css/saleitems/edit.css'];
$this->js = ['/js/saleitems/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->SaleItem->id = $id;
if (!$this->SaleItem->exists()) {
throw new NotFoundException(__('Invalid sale item'));
}
$this->request->allowMethod('post', 'delete');
if ($this->SaleItem->delete()) {
    $this->Flash->success(__('The sale item has been deleted.'));
    } else {
    $this->Flash->error(__('The sale item could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
