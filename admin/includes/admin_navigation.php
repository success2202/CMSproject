<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

<!-- Brand and toggle get grouped for better mobile display -->

<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<?php if(!is_Admin()): ?>
<a class="navbar-brand" href="index.php">BLW Admin</a>
<?php elseif(is_Admin()): ?>
<a class="navbar-brand" href="dashboard.php">BLW Master Admin</a>
<?php endif;?>
</div>

<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">
       <!-- this function user_online check if user is online and display the users online -->
       <li><a href="">Oline Users: <span class="usersonline"> <?php echo users_online(); ?> </span></a></li>
<li><a href="../index.php" class="fa fa-home"> Home </a></li>

<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user">

</i>
<?php
if(isset($_SESSION['username'])){
    $user_name= $_SESSION['username'];
    echo $user_name;
}

?>

<b class="caret"></b></a>

<ul class="dropdown-menu">
<li>
<a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
</li>

<li>
<a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
</li>
</ul>
</li>
</ul>



<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="nav navbar-nav side-nav">
<?php if(!is_Admin()): ?>
<li>
<a href="index.php"><i class="fa fa-fw fa-dashboard"></i> My data</a>
</li>
<?php elseif(is_Admin()): ?>
<li>
<a href="dashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
</li>
<?php endif;?>
<li>
<a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-file-text fa-1x"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
<ul id="posts_dropdown" class="collapse">
<?php if(!is_Admin()): ?>
<li>
    <a href="./posts.php">View My Posts </a>
</li>
<?php elseif(is_Admin()): ?>
<li>
    <a href="posts.php?source=view_dashboard_post">View All Posts </a>
</li>
<?php endif;?>
<li>
    <a href="posts.php?source=add_post">Add Posts</a>
</li>
</ul>

<?php if(!is_Admin()): ?>
<li>
<a href="categories.php"><i class="fa fa-list fa-1x"></i> Categories Page</a>
</li>
<?php else: ?>

<li>
<a href="dashboard_categories.php"><i class="fa fa-list fa-1x"></i> Categories Page</a>
</li>
<?php endif;?>

<?php if(is_Admin()): ?>
<!-- <li>
<a href="./comment.php"><i class="fa fa-comments fa-1x"></i> Comments</a>
</li> -->

<li>
<a href="comment.php?source=dashboard_comment"><i class="fa fa-comments fa-1x"></i> Comments</a>
</li>

<li>
<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-user fa-1x"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
<ul id="demo" class="collapse">


<!-- <li>
    <a href="users.php">View All Users</a>
</li> -->

<li>
    <a href="users.php?source=all_users_dashboard">All Users</a>
</li>

<li>
    <a href="users_dashboard.php?source=add_user">Add User</a>
</li>
</ul>

<?php endif;?> 


 
<li>
<a href="profile.php"><i class="fa fa-user fa-1x"> </i> Profile</a>
</li>
</ul>
</div>
<!-- /.navbar-collapse -->
</nav>