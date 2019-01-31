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
            <h3>Detail <?php echo ucwords($singularHumanName); ?></h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-chevron-left\"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>"; ?>
            <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-plus-circle\"></i> '.__('Add " . ucwords($pluralVar) . "'), array('controller' => '" . $pluralVar . "', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>\n"; ?>
            <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-edit\"></i> '.__('Edit " . $singularHumanName . "'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>"; ?>
            <?php echo "<?php echo \$this->Html->link('<i class=\"fa fa-print\"></i> '.__('Print'), array('action' => 'print_single',\${$singularVar}['{$modelClass}']['{$primaryKey}']),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>"; ?>
            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo "<?php echo __('Navigate');?>"; ?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    echo "\t\t<?php echo \$this->Html->link(__('Edit " . $singularHumanName . "'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']),['class'=>'dropdown-item']); ?> \n";
                    echo "\t\t<?php echo \$this->Form->postLink(__('Delete " . $singularHumanName . "'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']),array('class'=>'dropdown-item'), array('confirm' => __('Are you sure you want to delete # '.\${$singularVar}['{$modelClass}']['{$primaryKey}'].'?'))); ?>\n";
                    echo "\t\t<?php echo \$this->Html->link(__('List " . $pluralHumanName . "'), array('action' => 'index'),['class'=>'dropdown-item']); ?> \n";
                    echo "\t\t<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'),['class'=>'dropdown-item']); ?> \n";

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
    <?php
    if (empty($associations['hasMany'])) {
        $associations['hasMany'] = array();
    }
    if (empty($associations['hasAndBelongsToMany'])) {
        $associations['hasAndBelongsToMany'] = array();
    }
    $relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
    ?>
    <div class="row">
        <div class="<?php echo $pluralVar; ?> view animated fadeInUp col-lg-12 m-t-md">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered">
                            <?php
                            foreach ($fields as $field) {
                                $isKey = false;
                                if (!empty($associations['belongsTo'])) {
                                    foreach ($associations['belongsTo'] as $alias => $details) {
                                        if ($field === $details['foreignKey']) {
                                            $isKey = true;
                                            echo "<tr>\n";
                                            echo "\t\t<td width=\"200\"><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></td>\n";
                                            echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t&nbsp;\n\t\t</td>\n";
                                            echo "</tr>";
                                            break;
                                        }
                                    }
                                }
                                if ($isKey !== true) {
                                    if (!in_array($field, ['updated', 'deleted', 'deleted_date', 'deleted_by'])) {
                                        echo "<tr>\n";
                                        echo "\t\t<td><?php echo __('" . Inflector::humanize($field) . "'); ?></td>\n";
                                        echo "\t\t<td>\n\t\t\t<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t\t&nbsp;\n\t\t</td>\n";
                                        echo "</tr>";
                                    }
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <?php if (count($relations) > 0) { ?>
                        <div class="card-box blank-card">
                            <h4 class="header-title m-t-0 m-b-30">Related Info</h4>
                            <ul class="nav nav-tabs">
                                <?php
                                $t1 = 0;
                                foreach ($relations as $alias => $details) {
                                    $otherSingularVar = Inflector::variable($alias);
                                    $otherPluralHumanName = Inflector::humanize($details['controller']);
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php echo $t1 == 0 ? 'active' : '' ?>" href="#tab-<?php echo $alias ?>" data-toggle="tab" aria-expanded="false">
                                            <?php echo "<?php echo __('" . $otherPluralHumanName . "'); ?>"; ?>
                                        </a>
                                    </li>
                                    <?php
                                    $t1++;
                                }
                                ?>
                            </ul>
                            <div class="tab-content">
                                <?php
                                $t2 = 0;
                                foreach ($relations as $alias => $details) {
                                    $otherSingularVar = Inflector::variable($alias);
                                    $otherPluralHumanName = Inflector::humanize($details['controller']);
                                    ?>
                                    <div class="tab-pane <?php echo $t2 == 0 ? 'show active' : '' ?>" id="tab-<?php echo $alias ?>">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo "<?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?>"; ?> 
                                        </div>
                                        <?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    <?php
                                                    $h = 0;
                                                    foreach ($details['fields'] as $field) {
                                                        if ($h <= 8 && !in_array($field, ['description', 'salt', 'password', 'created', 'created_by', 'modified_by', 'deleted', 'deleted_date', 'modified'])) {
                                                            echo "\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>\n";
                                                        }
                                                        $h++;
                                                    }
                                                    ?>
                                                    <th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
                                                </tr>
                                                <?php
                                                echo "\t<?php foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>\n";
                                                echo "\t\t<tr>\n";
                                                $i = 0;
                                                foreach ($details['fields'] as $field) {
                                                    if ($i <= 8 && !in_array($field, ['description', 'salt', 'password', 'created', 'created_by', 'modified_by', 'deleted', 'deleted_date', 'modified'])) {

                                                        if (false !== strpos($field, 'amount')) {
                                                            echo "\t\t\t<td><?php echo number_format(\${$otherSingularVar}['{$field}'],2); ?></td>\n";
                                                        } else {
                                                            echo "\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>\n";
                                                        }
                                                    }
                                                    $i++;
                                                }

                                                echo "\t\t\t<td class=\"actions\">\n";
                                                echo "\t\t\t\t<?php echo \$this->Html->link(__('View'), array('controller' => '{$details['controller']}', 'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
                                                echo "\t\t\t\t<?php echo \$this->Html->link(__('Edit'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
                                                echo "\t\t\t\t<?php echo \$this->Form->postLink(__('Delete'), array('controller' => '{$details['controller']}', 'action' => 'delete', \${$otherSingularVar}['{$details['primaryKey']}']), array(), __('Are you sure you want to delete # %s?', \${$otherSingularVar}['{$details['primaryKey']}'])); ?>\n";
                                                echo "\t\t\t</td>\n";
                                                echo "\t\t</tr>\n";

                                                echo "\t<?php endforeach; ?>\n";
                                                ?>
                                            </table>
                                        </div>
                                        <?php echo "<?php else: ?>\n\n"; ?>
                                        <div class="alert alert-danger">
                                            <h4>Empty</h4>
                                            <p>No data for <?php echo $otherPluralHumanName ?></p>
                                        </div>
                                        <?php echo "<?php endif; ?>\n\n"; ?>
                                    </div>
                                    <?php
                                    $t2++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        if (!empty($associations['hasOne'])) :
            foreach ($associations['hasOne'] as $alias => $details):
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h5><i class="fa fa-star"></i><?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "'); ?>"; ?></h5>
                        </div> <!-- /card-header -->

                        <?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>\n"; ?>
                        <dl>
                            <?php
                            foreach ($details['fields'] as $field) {
                                echo "\t\t<dt><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>\n";
                                echo "\t\t<dd>\n\t<?php echo \${$singularVar}['{$alias}']['{$field}']; ?>\n&nbsp;</dd>\n";
                            }
                            ?>
                        </dl>
                        <?php echo "<?php endif; ?>\n"; ?>
                        <div class="actions">
                            <ul>
                                <li><?php echo "<?php echo \$this->Html->link(__('Edit " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></li>\n"; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
        endif;
        ?>
    </div>    
</div>