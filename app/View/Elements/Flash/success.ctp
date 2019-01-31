<!--<div class="container-fluid m-t-sm" id="flash-component">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="flash-<?php echo h($key) ?>" class="alert alert-success bg-success text-white border-0">
                <i class="fa fa-check-square"></i> <?php echo h($message) ?>
            </div>
        </div>
    </div>
</div>-->
<script type="text/javascript">
    /**
     $.toast({
     heading: 'Well done!',
     text: '<?php echo h($message) ?>',
     position: 'top-right',
     loaderBg: '#5ba035',
     icon: 'success',
     hideAfter: 6000,
     stack: 1
     });
     */
    swal(
            {
                title: 'Well done!',
                text: '<?php echo h($message) ?>!',
                type: 'success',
                timer: 6000,
                confirmButtonClass: 'btn btn-confirm mt-2'
            }
    );

</script>
