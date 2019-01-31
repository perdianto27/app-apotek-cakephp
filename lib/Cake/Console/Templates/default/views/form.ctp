<?php
/**
 *
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
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3><?php echo ucwords($action)?> <?php echo ucwords($singularHumanName); ?></h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-chevron-left\"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>"; ?>
            <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-plus-circle\"></i> '.__('New " . ucwords($pluralVar) . "'), array('controller' => '" . $pluralVar . "', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>\n"; ?>
            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo "<?php echo __('Navigate');?>"; ?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    $done = array();
                    foreach ($associations as $type => $data) {
                        foreach ($data as $alias => $details) {
                            if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
                                echo "\t\t<?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'),['class'=>'dropdown-item']); ?> \n";
                                echo "\t\t<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'),['class'=>'dropdown-item']); ?> \n";
                                $done[] = $details['controller'];
                            }
                        }
                    }
                    ?>
                </ul>
            </div>            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box table-responsive <?php echo $pluralVar; ?> form">
                <?php echo "<?php
                    echo \$this->Form->create('{$modelClass}', array(
                        'inputDefaults' => array(
                            'div' => 'form-group col-lg-6 col-xs-12',
                            'wrapInput' => false,
                            'class' => 'form-control'
                        ),
                        'class' => 'row'
                    ));
                    ?>\n"; ?>
                <?php
                echo "\t<?php\n";
                foreach ($fields as $field) {
                    if (strpos($action, 'add') !== false && $field === $primaryKey) {
                        continue;
                    } elseif (!in_array($field, array('created', 'created_by', 'modified_by', 'modified', 'updated', 'deleted', 'deleted_date', 'deleted_by'))) {

                        if (in_array($field, array('description', 'ket', 'keterangan', 'alamat', 'address'))) {
                            echo "\t\techo \$this->Form->input('{$field}',['class'=>'form-control summernote-{$field}','data-options'=>'{height: 250}','type'=>'textarea']);\n";
                        } elseif (in_array($field, ['date'])) {
                            echo "\t\techo \$this->Form->input('{$field}',['class'=>'datepicker form-control','type'=>'date']);\n";
                        } elseif (false !== strpos($field, 'date')) {
                            echo "\t\techo \$this->Form->input('{$field}',['class'=>'datepicker form-control','type'=>'date']);\n";
                        } elseif (false !== strpos($field, 'amount')) {
                            echo "\t\techo \$this->Form->input('{$field}',['class'=>'numeric form-control','type'=>'text']);\n";
                        } elseif (false !== strpos($field, 'cost')) {
                            echo "\t\techo \$this->Form->input('{$field}',['class'=>'numeric form-control','type'=>'text']);\n";
                        } elseif (false !== strpos($field, 'value')) {
                            echo "\t\techo \$this->Form->input('{$field}',['class'=>'numeric form-control','type'=>'text']);\n";
                        } elseif (in_array ($field, ['status','active'])!==false) {
                            echo "\t\techo \$this->Form->input('{$field}',['class'=>'','type'=>'checkbox']);\n";
                        } else {
                            if (substr($field, -3) == '_id')
                                echo "\t\techo \$this->Form->input('{$field}',['class'=>'select2 form-control']);\n";
                            else
                                echo "\t\techo \$this->Form->input('{$field}');\n";
                        }
                        #echo "\t\techo \$this->Form->input('{$field}');\n";
                    }
                }
                if (!empty($associations['hasAndBelongsToMany'])) {
                    foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
                        echo "\t\techo \$this->Form->input('{$assocName}');\n";
                    }
                }
                echo "\t?>\n";
                echo "<?php echo \$this->Form->submit(__('Submit'), array('class' => 'btn btn-light btn-lg', 'div' => 'form-group col-lg-12 m-t-md text-right')); ?>";
                echo "<?php echo \$this->Form->end(); ?>\n";
                ?>
            </div>
        </div>
    </div>
</div>