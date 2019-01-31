<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Detail Invoice Item</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Add InvoiceItems'), array('controller' => 'invoiceItems', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            <?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Edit Invoice Item'), array('action' => 'edit', $invoiceItem['InvoiceItem']['id']),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-print"></i> '.__('Print'), array('action' => 'print_single',$invoiceItem['InvoiceItem']['id']),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    		<?php echo $this->Html->link(__('Edit Invoice Item'), array('action' => 'edit', $invoiceItem['InvoiceItem']['id']),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Form->postLink(__('Delete Invoice Item'), array('action' => 'delete', $invoiceItem['InvoiceItem']['id']),array('class'=>'dropdown-item'), array('confirm' => __('Are you sure you want to delete # '.$invoiceItem['InvoiceItem']['id'].'?'))); ?>
		<?php echo $this->Html->link(__('List Invoice Items'), array('action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Invoice Item'), array('action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Invoices'), array('controller' => 'invoices', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
                </ul>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="invoiceItems view animated fadeInUp col-lg-12 m-t-md">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered">
                            <tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($invoiceItem['InvoiceItem']['id']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Price'); ?></td>
		<td>
			<?php echo h($invoiceItem['InvoiceItem']['price']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Qty'); ?></td>
		<td>
			<?php echo h($invoiceItem['InvoiceItem']['qty']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td width="200"><?php echo __('Invoice'); ?></td>
		<td>
			<?php echo $this->Html->link($invoiceItem['Invoice']['id'], array('controller' => 'invoices', 'action' => 'view', $invoiceItem['Invoice']['id'])); ?>
			&nbsp;
		</td>
</tr><tr>
		<td width="200"><?php echo __('Product'); ?></td>
		<td>
			<?php echo $this->Html->link($invoiceItem['Product']['name'], array('controller' => 'products', 'action' => 'view', $invoiceItem['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>                        </table>
                    </div>
                                </div>
        </div>
            </div>    
</div>