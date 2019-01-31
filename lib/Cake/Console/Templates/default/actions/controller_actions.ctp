<?php
/**
 * Bake Template for Controller action generation.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
public function <?php echo $admin ?>print_all() {
    $this->layout = 'pdf';
    $this-><?php echo $currentModelName ?>->recursive = 2;  
    $options = array('limit' => 100,'cache'=>'<?php echo $currentModelName ?>');
    $this->set('<?php echo $pluralName ?>', $this-><?php echo $currentModelName; ?>->find('all', $options));
    $this->response->type('application/pdf');
    $this->render('print_all');
}

public function <?php echo $admin ?>print_single($id) {
    $this->layout = 'pdf'; 
    if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
    }
    $this-><?php echo $currentModelName ?>->recursive = 2;  
    $options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
    $this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->find('first', $options));    
    $this->response->type('application/pdf');
    $this->render('print_single');
}


/**
* <?php echo $admin ?>index method
*
* @return void
*/
public function <?php echo $admin ?>index() {

    $cond='';
    if ($this->request->query) {
        $cond = $this->request->query['search'];
        $this->Paginator->settings = array(
        'conditions' => array('<?php echo $currentModelName; ?>.name LIKE ' => "%$cond%"),
        'limit' => 10
        );
    } else {
        $this->Paginator->settings = array(
        'limit' => 10
        );
    }
    $this->set('search_term',$cond);
    $this-><?php echo $currentModelName ?>->recursive = 0;
    $this->set('<?php echo $pluralName ?>', $this->Paginator->paginate());
    
    #css&js
    $this->css=['/css/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>index.css'];
    $this->js = ['/js/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>index.js'];
    $this->set('jsIncludes', $this->js);        
    $this->set('cssIncludes', $this->css); 
}

/**
* <?php echo $admin ?>view method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function <?php echo $admin ?>view($id = null) {
    if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
        throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
    }
    $this-><?php echo $currentModelName ?>->recursive = 2;  
    $options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
    $this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->find('first', $options));

    #css&js
    $this->css=['/css/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>view.css'];
    $this->js = ['/js/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>view.js'];
    $this->set('jsIncludes', $this->js);        
    $this->set('cssIncludes', $this->css);
    }

<?php $compact = array(); ?>
/**
* <?php echo $admin ?>add method
*
* @return void
*/
public function <?php echo $admin ?>add() {
if ($this->request->is('post')) {
    $this-><?php echo $currentModelName; ?>->create();
    if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
    <?php if ($wannaUseSession): ?>
            $this->Flash->success(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'));
    <?php else: ?>
        return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
    <?php endif; ?>
    }
}
<?php
foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
    foreach ($modelObj->{$assoc} as $associationName => $relation):
        if (!empty($associationName)):
            $otherModelName = $this->_modelName($associationName);
            $otherPluralName = $this->_pluralName($associationName);
            echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
            $compact[] = "'{$otherPluralName}'";
        endif;
    endforeach;
endforeach;
if (!empty($compact)):
    echo "\t\t\$this->set(compact(" . join(', ', $compact) . "));\n";
endif;
?>
$this->css=['/css/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>add.css'];
$this->js = ['/js/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>add.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);        
}

<?php $compact = array(); ?>
/**
* <?php echo $admin ?>edit method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function <?php echo $admin; ?>copy($id = null) {
if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
}
if ($this->request->is(array('post', 'put'))) {
$this-><?php echo $currentModelName; ?>->create();
if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
    $this->Flash->success(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'));
    return $this->redirect(array('action' => 'index'));
    } else {
    $this->Flash->error(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'));
<?php else: ?>
    return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
<?php endif; ?>
}
} else {
$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
}
<?php
foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
    foreach ($modelObj->{$assoc} as $associationName => $relation):
        if (!empty($associationName)):
            $otherModelName = $this->_modelName($associationName);
            $otherPluralName = $this->_pluralName($associationName);
            echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
            $compact[] = "'{$otherPluralName}'";
        endif;
    endforeach;
endforeach;
if (!empty($compact)):
    echo "\t\t\$this->set(compact(" . join(', ', $compact) . "));\n";
endif;
?>
$this->css=['/css/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>copy.css'];
$this->js = ['/js/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>copy.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);  
}

public function <?php echo $admin; ?>edit($id = null) {
if (!$this-><?php echo $currentModelName; ?>->exists($id)) {
throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
}
if ($this->request->is(array('post', 'put'))) {
if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
<?php if ($wannaUseSession): ?>
    $this->Flash->success(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'));
    return $this->redirect(array('action' => 'view',$id));
    } else {
    $this->Flash->error(__('The <?php echo strtolower($singularHumanName); ?> could not be saved. Please, try again.'));
<?php else: ?>
    return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been saved.'), array('action' => 'index'));
<?php endif; ?>
}
} else {
$options = array('conditions' => array('<?php echo $currentModelName; ?>.' . $this-><?php echo $currentModelName; ?>->primaryKey => $id));
$this->request->data = $this-><?php echo $currentModelName; ?>->find('first', $options);
}
<?php
foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
    foreach ($modelObj->{$assoc} as $associationName => $relation):
        if (!empty($associationName)):
            $otherModelName = $this->_modelName($associationName);
            $otherPluralName = $this->_pluralName($associationName);
            echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
            $compact[] = "'{$otherPluralName}'";
        endif;
    endforeach;
endforeach;
if (!empty($compact)):
    echo "\t\t\$this->set(compact(" . join(', ', $compact) . "));\n";
endif;
?>
$this->css=['/css/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>edit.css'];
$this->js = ['/js/<?php echo strtolower($pluralName) ?>/<?php echo $admin ?>edit.js','/js/ckeditor/ckeditor.js','/js/summernote.js'];
$this->set('jsIncludes', $this->js);        
$this->set('cssIncludes', $this->css);   

}

/**
* <?php echo $admin ?>delete method
*
* @throws NotFoundException
* @param string $id
* @return void
*/
public function <?php echo $admin; ?>delete($id = null) {
$this-><?php echo $currentModelName; ?>->id = $id;
if (!$this-><?php echo $currentModelName; ?>->exists()) {
throw new NotFoundException(__('Invalid <?php echo strtolower($singularHumanName); ?>'));
}
$this->request->allowMethod('post', 'delete');
if ($this-><?php echo $currentModelName; ?>->delete()) {
<?php if ($wannaUseSession): ?>
    $this->Flash->success(__('The <?php echo strtolower($singularHumanName); ?> has been deleted.'));
    } else {
    $this->Flash->error(__('The <?php echo strtolower($singularHumanName); ?> could not be deleted. Please, try again.'));
    }
    return $this->redirect(array('action' => 'index'));
<?php else: ?>
    return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> has been deleted.'), array('action' => 'index'));
    } else {
    return $this->flash(__('The <?php echo strtolower($singularHumanName); ?> could not be deleted. Please, try again.'), array('action' => 'index'));
    }
<?php endif; ?>
}

