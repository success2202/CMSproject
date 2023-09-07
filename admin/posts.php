    <?php error_reporting(E_ALL);
    ini_set('display_errors', 'ON');?>

    <?php include('includes/admin_header.php') ?>

    <div id="wrapper">

    <!-- Navigation -->

     <?php include('includes/admin_navigation.php') ?>

    <div id="page-wrapper">

    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">

    <h1 class="page-header" class='bg-success'>
    All Post
    <small><?php echo $_SESSION['username'];?></small> 
    </h1> 
<?php
if(isset($_GET['source'])){
    $source = $_GET['source'];
}else{
    $source ='';
}

switch($source){
    case 'add_post';
    include('includes/add_post.php');
    break;

    case 'edit_post';
    include('includes/edit_post.php');
    break;
    
    case 'view_dashboard_post';
    include('includes/view_all_post_dashboard.php');
    break;

    default;
    include('includes/view_all_post.php');
    break;
}




    
?>

    </div>
    </div>
    <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include('includes/admin_footer.php') ?>