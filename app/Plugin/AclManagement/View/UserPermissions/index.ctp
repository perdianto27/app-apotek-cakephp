<?php echo $this->Html->css(array('/acl_management/css/treeview'));?>
<?php echo $this->Html->script(array(
    '/acl_management/js/jquery.cookie',
    '/acl_management/js/treeview',
    '/acl_management/js/acos',
    '/acl_management/js/twitter/bootstrap-buttons',
));

?>
<div class="span7">
    <div class="">
        <button class="btn danger" data-loading-text="loading..." >Generate</button>
    </div>
    <div id="acos">
        <?php echo $this->Tree->generate($results, array('alias' => 'alias', 'plugin' => 'acl_management', 'model' => 'Aco', 'id' => 'acos-ul', 'element' => '/permission-node')); ?>
    </div>
</div>
<div class="span7">
    <div id="aco-edit"></div>
</div>
<script type="text/javascript">
$(document).ready(function() { 
    $("#acos").treeview({collapsed: true});
});
$(function() {
    var btn = $('.btn').click(function () {
        btn.button('loading');
        $.get('<?php echo $this->Html->url('/acl_management/user_permissions/sync');?>', {},
            function(data){
                btn.button('reset');
                $("#acos").html(data);
            }
        );        
    })
});
</script>
