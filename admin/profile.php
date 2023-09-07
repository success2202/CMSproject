<?php error_reporting(E_ALL);
    ini_set('display_errors', 'ON');?>

    <?php include('includes/admin_header.php') ?>
    <!-- <?php session_start();?> -->


<?php
if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $username_profile_query = mysqli_query($con, $sql);
    while($row =mysqli_fetch_array($username_profile_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['user_password'];
        $firstname = $row['user_firstname'];
        $lastname = $row['user_lastname'];
        $email = $row['user_email'];
        $image = $row['user_image'];
        

    }
}

?>


<?php 

if(isset($_POST['edit_user'])){
                //$user_id = $_POST['user_id'];
   $user_firstname   = $_POST['user_firstname'];
   $user_lastname    = $_POST['user_lastname'];
   $username         = $_POST['username'];

                //    $post_image        = $_FILES['image']['name'];
                //    $post_image_temp   = $_FILES['image']['tmp_name'];

   $user_email         = $_POST['user_email'];
   $user_password      = $_POST['user_password'];
                //    $post_date         = date('d-m-y');
                //$post_comment_count = 4;
                //move_uploaded_file( $post_image_temp, "../images/$post_image");
                //updating the user by using the edit user id gotten from the get edit_user

    $query = "UPDATE users  SET  user_firstname ='{$user_firstname}',
    user_lastname ='{$user_lastname}', username ='{$username}', user_email = '{$user_email}', user_password = '{$user_password}'
    WHERE username= '{$username}'"; 
    $update_result =  mysqli_query($con,$query);
    checkquerry($update_result); //checking if the querry works
    header('location:users.php'); 

}




?>


    <div id="wrapper">

    <!-- Navigation -->

     <?php include('includes/admin_navigation.php') ?>

    <div id="page-wrapper">

    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
    <div class="col-lg-12">

    <h1 class="page-header">
    Profile
    <small>
        <?php
if(isset($_SESSION['username'])){
    $user_name= $_SESSION['username'];
    echo $user_name;
}

        ?>
</small> 
    </h1> 



<!--  user profile form -->
<form action="" method="post" enctype="multipart/form-data">    

<div class="form-group">
<label for="firstname">Firstname</label>
<input type="text" class="form-control" name="user_firstname" value="<?=$firstname ?>">
   
</div>


<div class="form-group">
<label for="lastname">Lastname</label>
<input type="text" class="form-control" name="user_lastname" value="<?=$lastname ?>"> 
</div>


<!-- <div class="form-group">
<label for="post_image">Post Image</label>
<input type="file"  name="image">
</div> -->

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username" value="<?=$username ?>">
</div>

<div class="form-group">
<label for="email">Email</label>
<input type="email" class="form-control" name="user_email" value="<?=$email ?>">
</div>

<div class="form-group">
<label for="password">Password</label>
<input autocomplete="off" type="password" class="form-control" name="user_password">
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="edit_user" value="Update profile">
</div>


</form>


    </div>
    </div>
    <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include('includes/admin_footer.php') ?>