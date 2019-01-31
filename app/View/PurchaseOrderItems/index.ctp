<div class="container-fluid m-t-sm">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <h3 class="card-title">Purchase Order Item</h3>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
                    <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('New'), array('controller' => 'purchaseOrderItems', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
                    <?php echo $this->Html->link('<i class="fa fa-print"></i> '.__('Print'), array('action' => 'print_all'),['escape'=>false,'class'=>'print-btn btn btn-sm btn-light m-r-sm']); ?>                    <div class="dropdown" style="display:inline;">
                        <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            		<?php echo $this->Html->link(__('List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index'),['class'=>'dropdown-item']); ?> 
		<?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add'),['class'=>'dropdown-item']); ?> 
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
                                <?php echo $this->Form->create('PurchaseOrderItem',array('type'=>'get','url'=>'index'));?>                                <div class="input-group mb-3">
                                    <input type="text" class="input-sm form-control datepicker" name="from_date" placeholder="dari tanggal" value="">
                                    <input type="text" class="input-sm form-control datepicker" name="to_date" placeholder="sampai tanggal" value="">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-light"> Go!</button>
                                    </div>                                
                                </div>
                                <?php echo $this->Form->end();?>             
                            </div>                  
                        </div>
                        <?php if(count($purchaseOrderItems)==0){?>                        <div class="text-center">
                            <i class="fa fa-empty fa-3x"></i>
                            <div class="alert alert-error">
                                <h4>No Data</h4>
                                <p>
                                    No result for your search. Please check your keyword!
                                </p>
                            </div>
                        </div>
                        <?php }else{?>                    
                        <div class="table-responsive">
                            <!--datatable-->
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                                                                                                                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                                                                                                                                                                                        <th><?php echo $this->Paginator->sort('price'); ?></th>
                                                                                                                                                                                        <th><?php echo $this->Paginator->sort('qty'); ?></th>
                                                                                                                                                                                        <th><?php echo $this->Paginator->sort('purchase_orders_id'); ?></th>
                                                                                                                                                                                        <th><?php echo $this->Paginator->sort('product_id'); ?></th>
                                                                                                                                    <th class="actions text-right"><?php echo __('Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody><?php foreach ($purchaseOrderItems as $purchaseOrderItem): ?>
	 <tr>
		<td><?php echo h($purchaseOrderItem['PurchaseOrderItem']['id']); ?>&nbsp;</td>
		<td><?php echo h($purchaseOrderItem['PurchaseOrderItem']['price']); ?>&nbsp;</td>
		<td><?php echo h($purchaseOrderItem['PurchaseOrderItem']['qty']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($purchaseOrderItem['PurchaseOrders']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $purchaseOrderItem['PurchaseOrders']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($purchaseOrderItem['Product']['name'], array('controller' => 'products', 'action' => 'view', $purchaseOrderItem['Product']['id'])); ?>
		</td>
		<td class="actions text-right">
			<?php echo $this->Html->link(__('<i class="fa fa-print"></i>'), array('action' => 'print_single', $purchaseOrderItem['PurchaseOrderItem']['id']),array('escape' => false,'title'=>'print','class'=>'print-btn btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), array('action' => 'view', $purchaseOrderItem['PurchaseOrderItem']['id']),array('escape' => false,'title'=>'view details','class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link(__('<i class="fa fa-copy"></i>'), array('action' => 'copy', $purchaseOrderItem['PurchaseOrderItem']['id']),array('escape' => false,'title'=>'copy','class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link(__('<i class="fa fa-edit"></i>'), array('action' => 'edit', $purchaseOrderItem['PurchaseOrderItem']['id']),array('escape' => false,'title'=>'edit this record','class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), array('action' => 'delete', $purchaseOrderItem['PurchaseOrderItem']['id']),array('escape' => false,'title'=>'delete this record','class'=>'btn btn-default btn-sm'), __('Are you sure you want to delete # %s?', $purchaseOrderItem['PurchaseOrderItem']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>                            </table>
                        </div>
                        <?php }?>                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-5 col-lg-offset-1">
                    <?php
            echo $this->Paginator->pagination(array(
                "ul" => "pagination"
            ));
            ?>                </div>
                <div class="col-md-6" style="margin-top:30px;">
                    <?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?></div>
            </div>
        </div>
    </div>
</div>