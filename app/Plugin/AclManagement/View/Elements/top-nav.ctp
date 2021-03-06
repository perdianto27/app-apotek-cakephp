<ul class="nav" data-dropdown="dropdown">
<li class="menu">
    <a class="menu" href="#" class="dropdown-toggle">Posts</a>
    <ul class="menu-dropdown">
        <li><a href="<?php echo $this->Html->url('/posts');?>">Manage Posts</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo $this->Html->url('/posts/add');?>">New Post</a></li>
    </ul>
</li><li class="menu">
    <a class="menu" href="#" class="dropdown-toggle">User</a>
    <ul class="menu-dropdown">
        <li><a href="<?php echo $this->Html->url('/admin/users');?>">Manage Users</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo $this->Html->url('/admin/users/add');?>">New User</a></li>
    </ul>
</li>
<li class="menu">
    <a class="menu" href="#">Group</a>
    <ul class="menu-dropdown">
        <li><a href="<?php echo $this->Html->url('/admin/groups');?>">Manage Group</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo $this->Html->url('/admin/groups/add');?>">New Group</a></li>
    </ul>
</li>
<li><a href="<?php echo $this->Html->url('/admin/user_permissions');?>">Permission</a></li>
</ul>
<?php
if($this->Session->check('Auth.User.id')){
?>
<ul class="nav secondary-nav">
  <li class="menu"><a>Hi, <?php echo $this->Session->read('Auth.User.name');?></a></li>
  <li class="menu"><?php echo $this->Html->link('Logout', '/users/logout');?></li>
</ul>
<?php
}
?>
