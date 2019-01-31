<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Detail Clinic</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('Add Clinics'), array('controller' => 'clinics', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            <?php echo $this->Html->link('<i class="fa fa-edit"></i> '.__('Edit Clinic'), array('action' => 'edit', $clinic['Clinic']['id']),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-print"></i> '.__('Print'), array('action' => 'print_single',$clinic['Clinic']['id']),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    		<?php echo $this->Html->link(__('Edit Clinic'), array('action' => 'edit', $clinic['Clinic']['id']),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Form->postLink(__('Delete Clinic'), array('action' => 'delete', $clinic['Clinic']['id']),array('class'=>'dropdown-item'), array('confirm' => __('Are you sure you want to delete # '.$clinic['Clinic']['id'].'?'))); ?>
		<?php echo $this->Html->link(__('List Clinics'), array('action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Clinic'), array('action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Sales'), array('controller' => 'sales', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
                </ul>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="clinics view animated fadeInUp col-lg-12 m-t-md">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered">
                            <tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($clinic['Clinic']['id']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Name'); ?></td>
		<td>
			<?php echo h($clinic['Clinic']['name']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Adress'); ?></td>
		<td>
			<?php echo h($clinic['Clinic']['adress']); ?>
			&nbsp;
		</td>
</tr><tr>
		<td><?php echo __('Phone'); ?></td>
		<td>
			<?php echo h($clinic['Clinic']['phone']); ?>
			&nbsp;
		</td>
</tr>                        </table>
                    </div>
                                            <div class="card-box blank-card">
                            <h4 class="header-title m-t-0 m-b-30">Related Info</h4>
                            <ul class="nav nav-tabs">
                                                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tab-PurchaseOrder" data-toggle="tab" aria-expanded="false">
                                            <?php echo __('Purchase Orders'); ?>                                        </a>
                                    </li>
                                                                        <li class="nav-item">
                                        <a class="nav-link " href="#tab-Sale" data-toggle="tab" aria-expanded="false">
                                            <?php echo __('Sales'); ?>                                        </a>
                                    </li>
                                                                </ul>
                            <div class="tab-content">
                                                                    <div class="tab-pane show active" id="tab-PurchaseOrder">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($clinic['PurchaseOrder'])): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Total Amount'); ?></th>
		<th><?php echo __('Selesai'); ?></th>
		<th><?php echo __('Clinic Id'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                                	<?php foreach ($clinic['PurchaseOrder'] as $purchaseOrder): ?>
		<tr>
			<td><?php echo $purchaseOrder['id']; ?></td>
			<td><?php echo $purchaseOrder['date']; ?></td>
			<td><?php echo number_format($purchaseOrder['total_amount'],2); ?></td>
			<td><?php echo $purchaseOrder['selesai']; ?></td>
			<td><?php echo $purchaseOrder['clinic_id']; ?></td>
			<td><?php echo $purchaseOrder['supplier_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'purchase_orders', 'action' => 'view', $purchaseOrder['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'purchase_orders', 'action' => 'edit', $purchaseOrder['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'purchase_orders', 'action' => 'delete', $purchaseOrder['id']), array(), __('Are you sure you want to delete # %s?', $purchaseOrder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                                            </table>
                                        </div>
                                        <?php else: ?>

                                        <div class="alert alert-danger">
                                            <h4>Empty</h4>
                                            <p>No data for Purchase Orders</p>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                                                        <div class="tab-pane " id="tab-Sale">
                                        <div class="m-t-sm m-b-sm clearfix">
                                            <?php echo $this->Html->link(__('New Sale'), array('controller' => 'sales', 'action' => 'add'),['class'=>'btn btn-default btn-sm pull-right']); ?> 
                                        </div>
                                        <?php if (!empty($clinic['Sale'])): ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <tr>
                                                    		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('No'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th><?php echo __('Clinic Id'); ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                                	<?php foreach ($clinic['Sale'] as $sale): ?>
		<tr>
			<td><?php echo $sale['id']; ?></td>
			<td><?php echo $sale['no']; ?></td>
			<td><?php echo $sale['date']; ?></td>
			<td><?php echo $sale['total']; ?></td>
			<td><?php echo $sale['customer_id']; ?></td>
			<td><?php echo $sale['clinic_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sales', 'action' => 'view', $sale['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sales', 'action' => 'edit', $sale['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sales', 'action' => 'delete', $sale['id']), array(), __('Are you sure you want to delete # %s?', $sale['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
                                            </table>
                                        </div>
                                        <?php else: ?>

                                        <div class="alert alert-danger">
                                            <h4>Empty</h4>
                                            <p>No data for Sales</p>
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