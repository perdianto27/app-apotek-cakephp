<div class="container-fluid m-t-sm">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <h3>Edit Sale</h3>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 text-right">
            <?php echo $this->Html->link('<i class="fa fa-chevron-left"></i> '.__('Back'), array('action' => 'index'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>            <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> '.__('New Sales'), array('controller' => 'sales', 'action' => 'add'),['escape'=>false,'class'=>'btn btn-sm btn-light m-r-sm']); ?>
            
            <div class="dropdown" style="display:inline;">
                <button id="dropdownMenuButton" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-send"></i> <?php echo __('Navigate');?>  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box table-responsive sales form">
                <?php
                    echo $this->Form->create('Sale', array(
                        'inputDefaults' => array(
                            'div' => 'form-group col-lg-6 col-xs-12',
                            'wrapInput' => false,
                            'class' => 'form-control'
                        ),
                        'class' => 'row'
                    ));
                    ?>
                	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('no');
		echo $this->Form->input('date',['class'=>'datepicker form-control','type'=>'date']);
		echo $this->Form->input('total');
		echo $this->Form->input('customer_id',['class'=>'select2 form-control']);
		echo $this->Form->input('clinic_id',['class'=>'select2 form-control']);
	?>
<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-light btn-lg', 'div' => 'form-group col-lg-12 m-t-md text-right')); ?><?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>