<?php
App::uses('AppController', 'Controller');
/**
 * Clinics Controller
 *
 * @property Clinic $Clinic
 * @property PaginatorComponent $Paginator
 */
class ClinicsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

public function print_all() {
    $this->layout = 'pdf';
    $this->Clinic->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'Clinic');
    $this->set('clinics', $this->Clinic->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this->Clinic->exists($id)) {
        throw new NotFoundException(__('Invalid clinic'));
    }
    $this->Clinic->recursive = 2;  
    $options = array('conditions' => array('Clinic.' . $this->Clinic->primaryKey => $id));
    $this->set('clinic', $this->Clinic->find('first', $options));    
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
        'conditions' => array('Clinic.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this->Clinic->recursive = 0;
    $this->set('clinics', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/clinics/index.css'];
    $this->js = ['/js/clinics/index.js'];
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
    if (!$this->Clinic->exists($id)) {
        throw new NotFoundException(__('Invalid clinic'));
    }
    $this->Clinic->recursive = 2;  
    $options = array('conditions' => array('Clinic.' . $this->Clinic->primaryKey => $id));
    $this->set('clinic', $this->Clinic->find('first', $options));

    #css&js
    $this->css=['/css/clinics/view.css'];
    $this->js = ['/js/clinics/view.js'];
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
    $this->Clinic->create();
    if ($this->Clinic->save($this->request->data)) {
                $this->Flash->success(__('The clinic has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The clinic could not be saved. Please, try again.'));
        }
}
$this->css=['/css/clinics/add.css'];
$this->js = ['/js/clinics/add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
if (!$this->Clinic->exists($id)) {
throw new NotFoundException(__('Invalid clinic'));
}
if ($this->request->is(array('post', 'put'))) {
$this->Clinic->create();
if ($this->Clinic->save($this->request->data)) {
    $this->Flash->success(__('The clinic has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The clinic could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Clinic.' . $this->Clinic->primaryKey => $id));
$this->request->data = $this->Clinic->find('first', $options);
}
$this->css=['/css/clinics/copy.css'];
$this->js = ['/js/clinics/copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function edit($id = null) {
if (!$this->Clinic->exists($id)) {
throw new NotFoundException(__('Invalid clinic'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this->Clinic->save($this->request->data)) {
    $this->Flash->success(__('The clinic has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The clinic could not be saved. Please, try again.'));
}
} else {
$options = array('conditions' => array('Clinic.' . $this->Clinic->primaryKey => $id));
$this->request->data = $this->Clinic->find('first', $options);
}
$this->css=['/css/clinics/edit.css'];
$this->js = ['/js/clinics/edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
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
$this->Clinic->id = $id;
if (!$this->Clinic->exists()) {
throw new NotFoundException(__('Invalid clinic'));
}
$this->request->allowMethod('post', 'delete');
if ($this->Clinic->delete()) {
    $this->Flash->success(__('The clinic has been deleted.'));
    } else {
    $this->Flash->error(__('The clinic could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
}
}
