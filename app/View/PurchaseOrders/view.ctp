<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Detail Purchase Order</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Add PurchaseOrders'), array('controller' => 'purchaseOrders', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            <?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Edit Purchase Order'), array('action' => 'edit', $purchaseOrder['PurchaseOrder']['id']),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-print"></i> '.__('Print'), array('action' => 'print_single',$purchaseOrder['PurchaseOrder']['id']),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    		<?php echo $this->Html->link(__('Edit Purchase Order'), array('action' => 'edit', $purchaseOrder['PurchaseOrder']['id']),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Form->postLink(__('Delete Purchase Order'), array('action' => 'delete', $purchaseOrder['PurchaseOrder']['id']),array('class'=>'dropdown-item'), array('confirm' => __('Are you sure you want to delete # '.$purchaseOrder['PurchaseOrder']['id'].'?'))); ?>
		<?php echo $this->Html->link(__('List Purchase Orders'), array('action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Purchase Order'), array('action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Clinics'), array('controller' => 'clinics', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Clinic'), array('controller' => 'clinics', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
                </ul>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="purchaseOrders view animated fadeInUp col-lg-12 m-t-md">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered">
                            <tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['id']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Date'); ?></td>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['date']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Total Amount'); ?></td>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['total_amount']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Selesai'); ?></td>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['selesai']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td width="200"><?php echo __('Clinic'); ?></td>
		<td>
			<?php echo $this->Html->link($purchaseOrder['Clinic']['name'], array('controller' => 'clinics', 'action' => 'view', $purchaseOrder['Clinic']['id'])); ?>
			&nbsp;
		</td>
</tr><tr>
		<td width="200"><?php echo __('Supplier'); ?></td>
		<td>
			<?php echo $this->Html->link($purchaseOrder['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchaseOrder['Supplier']['id'])); ?>
			&nbsp;
		</td>
</tr>                        </table>
                    </div>
                                </div>
        </div>
            </div>    
</div>