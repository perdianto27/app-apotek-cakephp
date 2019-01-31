<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Detail Product</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Add Products'), array('controller' => 'products', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            <?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Edit Product'), array('action' => 'edit', $product['Product']['id']),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-print"></i> '.__('Print'), array('action' => 'print_single',$product['Product']['id']),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    		<?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id']),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']),array('class'=>'dropdown-item'), array('confirm' => __('Are you sure you want to delete # '.$product['Product']['id'].'?'))); ?>
		<?php echo $this->Html->link(__('List Products'), array('action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Product'), array('action' => 'add'),['class'=>'dropdown-item']); ?> 
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
        <div class="products view animated fadeInUp col-lg-12 m-t-md">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered">
                            <tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Name'); ?></td>
		<td>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Unit'); ?></td>
		<td>
			<?php echo h($product['Product']['unit']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Stock'); ?></td>
		<td>
			<?php echo h($product['Product']['stock']); ?>
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
                                                                        <li class="nav-item">
                                        <a class="nav-link " href="#tab-PurchaseOrderItem" data-toggle="tab" aria-expanded="false">
                                            <?php echo __('Purchase Order Items'); ?>                                        </a>
                                    </li>
                                                                        <li class="nav-item">
                                        <a class="nav-link " href="#tab-SaleItem" data-toggle="tab" aria-expanded="false">
                                            <?php echo __('Sale Items'); ?>                                        </a>
                                    </li>
                                                                </ul>
                            <div class="tab-content">
                                                                    <div class="tab-pane show active" id="tab-InvoiceItem">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Invoice Item'), array('controller' => 'invoice_items', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($product['InvoiceItem'])): ?>
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
                                                	<?php foreach ($product['InvoiceItem'] as $invoiceItem): ?>
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
                                                                        <div class="tab-pane " id="tab-PurchaseOrderItem">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Purchase Order Item'), array('controller' => 'purchase_order_items', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($product['PurchaseOrderItem'])): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Purchase Orders Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                                	<?php foreach ($product['PurchaseOrderItem'] as $purchaseOrderItem): ?>
		<tr>
			<td><?php echo $purchaseOrderItem['id']; ?></td>
			<td><?php echo $purchaseOrderItem['price']; ?></td>
			<td><?php echo $purchaseOrderItem['qty']; ?></td>
			<td><?php echo $purchaseOrderItem['purchase_orders_id']; ?></td>
			<td><?php echo $purchaseOrderItem['product_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'purchase_order_items', 'action' => 'view', $purchaseOrderItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'purchase_order_items', 'action' => 'edit', $purchaseOrderItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'purchase_order_items', 'action' => 'delete', $purchaseOrderItem['id']), array(), __('Are you sure you want to delete # %s?', $purchaseOrderItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                                            </table>
                                        </div>
                                        <?php else: ?>

                                        <div class="alert alert-danger">
                                            <h4>Empty</h4>
                                            <p>No data for Purchase Order Items</p>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                                                        <div class="tab-pane " id="tab-SaleItem">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Sale Item'), array('controller' => 'sale_items', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($product['SaleItem'])): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Sale Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                                	<?php foreach ($product['SaleItem'] as $saleItem): ?>
		<tr>
			<td><?php echo $saleItem['id']; ?></td>
			<td><?php echo $saleItem['price']; ?></td>
			<td><?php echo $saleItem['qty']; ?></td>
			<td><?php echo $saleItem['sale_id']; ?></td>
			<td><?php echo $saleItem['product_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sale_items', 'action' => 'view', $saleItem['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sale_items', 'action' => 'edit', $saleItem['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sale_items', 'action' => 'delete', $saleItem['id']), array(), __('Are you sure you want to delete # %s?', $saleItem['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                                            </table>
                                        </div>
                                        <?php else: ?>

                                        <div class="alert alert-danger">
                                            <h4>Empty</h4>
                                            <p>No data for Sale Items</p>
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