<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Detail Invoice</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Add Invoices'), array('controller' => 'invoices', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            <?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Edit Invoice'), array('action' => 'edit', $invoice['Invoice']['id']),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-print"></i> '.__('Print'), array('action' => 'print_single',$invoice['Invoice']['id']),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    		<?php echo $this->Html->link(__('Edit Invoice'), array('action' => 'edit', $invoice['Invoice']['id']),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Form->postLink(__('Delete Invoice'), array('action' => 'delete', $invoice['Invoice']['id']),array('class'=>'dropdown-item'), array('confirm' => __('Are you sure you want to delete # '.$invoice['Invoice']['id'].'?'))); ?>
		<?php echo $this->Html->link(__('List Invoices'), array('action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Invoice'), array('action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Sales'), array('controller' => 'sales', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Invoice Items'), array('controller' => 'invoice_items', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Invoice Item'), array('controller' => 'invoice_items', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
                </ul>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="invoices view animated fadeInUp col-lg-12 m-t-md">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered">
                            <tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($invoice['Invoice']['id']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Date'); ?></td>
		<td>
			<?php echo h($invoice['Invoice']['date']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Amount'); ?></td>
		<td>
			<?php echo h($invoice['Invoice']['amount']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Description'); ?></td>
		<td>
			<?php echo h($invoice['Invoice']['description']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td width="200"><?php echo __('Sale'); ?></td>
		<td>
			<?php echo $this->Html->link($invoice['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $invoice['Sale']['id'])); ?>
			&nbsp;
		</td>
</tr>                        </table>
                    </div>
                                            <div class="card-box blank-card">
                            <h4 class="header-title m-t-0 m-b-30">Related Info</h4>
                            <ul class="nav nav-tabs">
                                                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-InvoiceItem" data-toggle="tab" aria-expanded="false">
                                            <?php echo __('Invoice Items'); ?>                                        </a>
                                    </li>
                                                                </ul>
                            <div class="tab-content">
                                                                    <div class="tab-pane show active" id="tab-InvoiceItem">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Invoice Item'), array('controller' => 'invoice_items', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($invoice['InvoiceItem'])): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Invoice Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                                	<?php foreach ($invoice['InvoiceItem'] as $invoiceItem): ?>
		<tr>
			<td><?php echo $invoiceItem['id']; ?></td>
			<td><?php echo $invoiceItem['price']; ?></td>
			<td><?php echo $invoiceItem['qty']; ?></td>
			<td><?php echo $invoiceItem['invoice_id']; ?></td>
			<td><?php echo $invoiceItem['product_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invoice_items', 'action' => 'view', $invoiceItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invoice_items', 'action' => 'edit', $invoiceItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invoice_items', 'action' => 'delete', $invoiceItem['id']), array(), __('Are you sure you want to delete # %s?', $invoiceItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                                            </table>
                                        </div>
                                        <?php else: ?>

                                        <div class="alert alert-danger">
                                            <h4>Empty</h4>
                                            <p>No data for Invoice Items</p>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                                                </div>
                        </div>
                    </div>
                            </div>
        </div>
            </div>    
</div>