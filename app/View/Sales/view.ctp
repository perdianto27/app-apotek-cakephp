<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Detail Sale</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Add Sales'), array('controller' => 'sales', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            <?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Edit Sale'), array('action' => 'edit', $sale['Sale']['id']),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-print"></i> '.__('Print'), array('action' => 'print_single',$sale['Sale']['id']),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    		<?php echo $this->Html->link(__('Edit Sale'), array('action' => 'edit', $sale['Sale']['id']),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Form->postLink(__('Delete Sale'), array('action' => 'delete', $sale['Sale']['id']),array('class'=>'dropdown-item'), array('confirm' => __('Are you sure you want to delete # '.$sale['Sale']['id'].'?'))); ?>
		<?php echo $this->Html->link(__('List Sales'), array('action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Sale'), array('action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Customers'), array('controller' => 'customers', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Customer'), array('controller' => 'customers', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Clinics'), array('controller' => 'clinics', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Clinic'), array('controller' => 'clinics', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Invoices'), array('controller' => 'invoices', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Sale Items'), array('controller' => 'sale_items', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Sale Item'), array('controller' => 'sale_items', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
                </ul>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="sales view animated fadeInUp col-lg-12 m-t-md">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered">
                            <tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($sale['Sale']['id']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('No'); ?></td>
		<td>
			<?php echo h($sale['Sale']['no']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Date'); ?></td>
		<td>
			<?php echo h($sale['Sale']['date']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Total'); ?></td>
		<td>
			<?php echo h($sale['Sale']['total']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td width="200"><?php echo __('Customer'); ?></td>
		<td>
			<?php echo $this->Html->link($sale['Customer']['name'], array('controller' => 'customers', 'action' => 'view', $sale['Customer']['id'])); ?>
			&nbsp;
		</td>
</tr><tr>
		<td width="200"><?php echo __('Clinic'); ?></td>
		<td>
			<?php echo $this->Html->link($sale['Clinic']['name'], array('controller' => 'clinics', 'action' => 'view', $sale['Clinic']['id'])); ?>
			&nbsp;
		</td>
</tr>                        </table>
                    </div>
                                            <div class="card-box blank-card">
                            <h4 class="header-title m-t-0 m-b-30">Related Info</h4>
                            <ul class="nav nav-tabs">
                                                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-Invoice" data-toggle="tab" aria-expanded="false">
                                            <?php echo __('Invoices'); ?>                                        </a>
                                    </li>
                                                                        <li class="nav-item">
                                        <a class="nav-link " href="#tab-SaleItem" data-toggle="tab" aria-expanded="false">
                                            <?php echo __('Sale Items'); ?>                                        </a>
                                    </li>
                                                                </ul>
                            <div class="tab-content">
                                                                    <div class="tab-pane show active" id="tab-Invoice">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Invoice'), array('controller' => 'invoices', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($sale['Invoice'])): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Sale Id'); ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                                	<?php foreach ($sale['Invoice'] as $invoice): ?>
		<tr>
			<td><?php echo $invoice['id']; ?></td>
			<td><?php echo $invoice['date']; ?></td>
			<td><?php echo number_format($invoice['amount'],2); ?></td>
			<td><?php echo $invoice['sale_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'invoices', 'action' => 'view', $invoice['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'invoices', 'action' => 'edit', $invoice['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'invoices', 'action' => 'delete', $invoice['id']), array(), __('Are you sure you want to delete # %s?', $invoice['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                                            </table>
                                        </div>
                                        <?php else: ?>

                                        <div class="alert alert-danger">
                                            <h4>Empty</h4>
                                            <p>No data for Invoices</p>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                                                        <div class="tab-pane " id="tab-SaleItem">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Sale Item'), array('controller' => 'sale_items', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($sale['SaleItem'])): ?>
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
                                                	<?php foreach ($sale['SaleItem'] as $saleItem): ?>
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