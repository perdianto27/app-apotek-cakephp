<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Add Product</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('New Products'), array('controller' => 'products', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    		<?php echo $this->Html->link(__('List Invoice Items'), array('controller' => 'invoice_items', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Invoice Item'), array('controller' => 'invoice_items', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Purchase Order Items'), array('controller' => 'purchase_order_items', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Purchase Order Item'), array('controller' => 'purchase_order_items', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Sale Items'), array('controller' => 'sale_items', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Sale Item'), array('controller' => 'sale_items', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
                </ul>
            </div>            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box table-responsive products form">
                <?php
                    echo $this->Form->create('Product', array(
                        'inputDefaults' => array(
                            'div' => 'form-group col-lg-6 col-xs-12',
                            'wrapInput' => false,
                            'class' => 'form-control'
                        ),
                        'class' => 'row'
                    ));
                    ?>
                	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('unit');
		echo $this->Form->input('stock');
	?>
<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-light btn-lg', 'div' => 'form-group col-lg-12 m-t-md text-right')); ?><?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>