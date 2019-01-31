<!--<div class="container-fluid m-t-sm" id="flash-component">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div id="flash-<?php echo h($key) ?>" class="alert alert-error bg-success text-white border-0">
                <i class="fa fa-check-square"></i> <?php echo h($message) ?>
            </div>
        </div>
    </div>
</div>-->
<script type="text/javascript">
    /**$.toast({
     heading: 'Oh snap!',
     text: '<?php echo h($message) ?>',
     position: 'top-right',
     loaderBg: '#bf441d',
     icon: 'error',
     hideAfter: 6000,
     stack: 1
     });
     */
    swal(
            {
                title: 'Oh snap!',
                text: '<?php echo h($message) ?>!',
                type: 'error',
                timer: 6000,
                confirmButtonClass: 'btn btn-confirm mt-2'
            }
    );
</script>
