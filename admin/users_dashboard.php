<?php error_reporting(E_ALL);
    ini_set('display_errors', 'ON');?>

    <?php include('includes/admin_header.php') ?>

    <div id="wrapper">

    <!-- Navigation -->

     <?php include('includes/admin_navigation.php') ?>
<?php
// if(!is_Admin($_SESSION['username'])){
//     header("location: index.php");
// }




?>

    <div id="page-wrapper">

    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">

    <h1 class="page-header">
    All Users
    <small><?php echo $_SESSION['username'];?></small>
    </h1> 
<?php
if(isset($_GET['source'])){
    $source = $_GET['source'];
}else{
    $source ='';
}

switch($source){
    case 'add_user';
    include('includes/add_user.php');
    break;

    case 'edit_user';
    include('includes/edit_user.php');
    break;

    case 'all_users_dashboard';
    include('includes/all_users_dashboard.php');
    break;


    default;
    include('includes/all_users_dashboard.php');
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