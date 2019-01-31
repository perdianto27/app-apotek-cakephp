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
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <h3 class="card-title"><?php echo ucwords($singularHumanName); ?></h3>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
                    <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-plus-circle\"></i> '.__('New'), array('controller' => '" . $pluralVar . "', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>\n"; ?>
                    <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-print\"></i> '.__('Print'), array('action' => 'print_all'),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>"; ?>
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
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card-body table-responsive">
                        <div class="row m-b-sm m-t-sm">
                            <div class="col-md-12">
                                <?php echo "<?php echo \$this->Form->create('{$modelClass}',array('type'=>'get','url'=>'index'));?>"; ?>
                                <div class="input-group mb-3">
                                    <input type="text" class="input-sm form-control datepicker" name="from_date" placeholder="dari tanggal" value="<?php echo $search_term['from_date']; ?>">
                                    <input type="text" class="input-sm form-control datepicker" name="to_date" placeholder="sampai tanggal" value="<?php echo $search_term['to_date']; ?>">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-light"> Go!</button>
                                    </div>                                
                                </div>
                                <?php echo '<?php echo $this->Form->end();?>'; ?>             
                            </div>                  
                        </div>
                        <?php echo "<?php if(count(\${$pluralVar})==0){?>" ?>
                        <div class="text-center">
                            <i class="fa fa-empty fa-3x"></i>
                            <div class="alert alert-error">
                                <h4>No Data</h4>
                                <p>
                                    No result for your search. Please check your keyword!
                                </p>
                            </div>
                        </div>
                        <?php echo "<?php }else{?>" ?>                    
                        <div class="table-responsive">
                            <!--datatable-->
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <?php
                                        $h = 0;
                                        foreach ($fields as $field):
                                            ?>
                                            <?php
                                            if ($h <= 8 && !in_array($field, ['description', 'salt', 'password', 'created', 'created_by', 'modified_by', 'deleted', 'deleted_date', 'modified'])) {
                                                ?>
                                                <th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            $h++;
                                        endforeach;
                                        ?>
                                        <th class="actions text-right"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
                                    </tr>
                                </thead>
                                <?php
                                echo "<tbody><?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
                                echo "\t <tr>\n";
                                $i = 0;
                                foreach ($fields as $field) {
                                    if ($i <= 8 && !in_array($field, ['description', 'salt', 'password', 'created', 'created_by', 'modified_by', 'deleted', 'deleted_date', 'modified'])) {
                                        $isKey = false;
                                        if (!empty($associations['belongsTo'])) {
                                            foreach ($associations['belongsTo'] as $alias => $details) {
                                                if ($field === $details['foreignKey']) {
                                                    $isKey = true;
                                                    echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
                                                    break;
                                                }
                                            }
                                        }
                                        if ($isKey !== true) {
                                            if (false !== strpos($field, 'amount')) {
                                                echo "\t\t\t<td><?php echo number_format(\${$singularVar}['{$modelClass}']['{$field}'],2); ?></td>\n";
                                            } elseif (false !== strpos($field, 'cost')) {
                                                echo "\t\t\t<td><?php echo number_format(\${$singularVar}['{$modelClass}']['{$field}'],2); ?></td>\n";
                                            } else {
                                                echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
                                            }
                                        }
                                    }
                                    $i++;
                                }
                                echo "\t\t<td class=\"actions text-right\">\n";
                                echo "\t\t\t<?php echo \$this->Html->link(__('<i class=\"fa fa-print\"></i>'), array('action' => 'print_single', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('escape' => false,'title'=>'print','class'=>'print-btn btn btn-default btn-sm')); ?>\n";
                                echo "\t\t\t<?php echo \$this->Html->link(__('<i class=\"fa fa-eye\"></i>'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('escape' => false,'title'=>'view details','class'=>'btn btn-default btn-sm')); ?>\n";
                                echo "\t\t\t<?php echo \$this->Html->link(__('<i class=\"fa fa-copy\"></i>'), array('action' => 'copy', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('escape' => false,'title'=>'copy','class'=>'btn btn-default btn-sm')); ?>\n";
                                echo "\t\t\t<?php echo \$this->Html->link(__('<i class=\"fa fa-edit\"></i>'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('escape' => false,'title'=>'edit this record','class'=>'btn btn-default btn-sm')); ?>\n";
                                echo "\t\t\t<?php echo \$this->Form->postLink(__('<i class=\"fa fa-trash\"></i>'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('escape' => false,'title'=>'delete this record','class'=>'btn btn-default btn-sm'), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
                                echo "\t\t</td>\n";
                                echo "\t</tr>\n";
                                echo "<?php endforeach; ?>\n</tbody>";
                                ?>
                            </table>
                        </div>
                        <?php echo "<?php }?>"; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-5 col-lg-offset-1">
                    <?php echo '<?php
            echo $this->Paginator->pagination(array(
                "ul" => "pagination"
            ));
            ?>'; ?>
                </div>
                <div class="col-md-6" style="margin-top:30px;">
                    <?php echo "<?php
	echo \$this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>"; ?></div>
            </div>
        </div>
    </div>
</div>