<?php
if(isset($_POST['check_BoxArray'])){
   $checkBox = $_POST['check_BoxArray'];
   foreach($checkBox as $checkBoxValue_post_id){
      $bulk_options = $_POST['bulk_options'];

      switch($bulk_options){
               case 'deleted':
                  $sql = "DELETE FROM users WHERE user_id = {$checkBoxValue_post_id} ";
                  $user_delete = mysqli_query($con, $sql);
                 
                  break;

               }
            }
        }
?>




<form action="" method="post">
<table class="table table-bordered table-hover" class="table table-striped" class="table table-dark">

   <div id="bulkOptionsContainer" class="col-xs-4">

   <select class="form-control" name="bulk_options" id="">
        <option value="">Select Actions</option>
        <option value="deleted" onClick="javascript: return confirm('are you sure you want to delete')";>Delete</option>

   </select>
   </div>

 <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="users_dashboard.php?source=add_user">Add New User</a>
</div>


<table class="table table-bordered table-hover">
    <thead>
    <tr>
    <th><input id="selectAllBoxes" type="checkbox"></th>
    <th>ID</th>
    <th>USERNAME</th>
    <th>FIRSTNAME</th>
    <th>LASTNAME</th>
    <th>EMAIL</th>
    <th>ROLE</th>
    <th colspan="4"> <center>ACTIONS</center> </th>
    <!-- <th>DATE</th>
    <th>DELETE</th> -->
    
   
    
    </tr>
    </thead>
    <tbody>

            <?php 
           $sql = "SELECT * FROM users ORDER BY user_id ASC"; //displaying the users from the database to the table
           $select_users = mysqli_query($con, $sql);              
               while($row = mysqli_fetch_assoc($select_users)){ //displaying the users on the table
                   $user_id = $row['user_id'];
                   $username = $row['username'];
                   $password = $row['user_password'];
                   $firstname = $row['user_firstname'];
                   $lastname = $row['user_lastname'];
                   $email = $row['user_email'];
                   $image = $row['user_image'];
                   $role = $row['user_role'];
                //    $date = $row['user_date'];

                echo "<tr>";  //displaying the users on the table
                ?>
                <td> <input class='checkBox' type='checkbox' name='check_BoxArray[]' value='<?=$user_id?>'> </td> 
                <?php
                   echo "<td>$user_id</td>";
                   echo "<td>$username </td>";
                   echo "<td>$firstname </td>";
                   
//connecting categories with the post
// $sql = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}"; //displaying categories from the database in the post
// $selectCat = mysqli_query($con, $sql);
// while($row = mysqli_fetch_assoc($selectCat)){ //displaying categories with the post
// $cat_id = $row['cat_id'];
// $cat_title = $row['cat_title'];

//                    echo "<td> $comment_post_id</td>";

// }
    echo "<td>$lastname </td>";
    echo "<td>$email</td>";
    echo "<td>$role</td>";
    // echo "<td>$date</td>";


    // $sql = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
    // $check= mysqli_query($con, $sql);
    // while($row =  mysqli_fetch_assoc($check) ){
    // $post_id = $row['post_id'];
    // $post_title = $row['post_title'];
    // echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
    // }


    
    // echo "<td>$comment_date </td>";
    
    echo "<td><a href='users_dashboard.php?change_to_admin=$user_id'> Admin </a></td>";
    echo "<td><a href='users_dashboard.php?change_to_sub=$user_id'> Subscriber </a></td>";
    echo "<td><a href='users_dashboard.php?change_to_visit=$user_id'> Client </a></td>";
    echo "<td><a class='btn btn-info' href='users_dashboard.php?source=edit_user&edit_user=$user_id'> Edit </a></td>";
    echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('are you sure you want to delete');\" href='users_dashboard.php?delete=$user_id'> Delete </a></td>";
    
echo "</tr>";
} 

?>
    </tbody>
    </table>


    <?php   //delete comment, approve, and unapprove comment

if(isset($_GET['change_to_admin'])){
    $admin_user_id = $_GET['change_to_admin'];
    $sql= "UPDATE users SET user_role = 'admin' WHERE user_id ={$admin_user_id}";
    $change_admin_query = mysqli_query($con, $sql);
    header('location: users_dashboard.php');
}


if(isset($_GET['change_to_sub'])){
    $sub_user_id = $_GET['change_to_sub'];
    $sql= "UPDATE users SET user_role ='subscriber' WHERE user_id ={$sub_user_id}";
    $change_sub_query = mysqli_query($con, $sql);
    header('location: users_dashboard.php');
}


if(isset($_GET['change_to_visit'])){
    $visit_user_id = $_GET['change_to_visit'];
    $sql= "UPDATE users SET user_role ='client' WHERE user_id ={$visit_user_id}";
    $visit_client_query = mysqli_query($con, $sql);
    header('location: users_dashboard.php');
    
}


if(isset($_GET['delete'])){
$del_user_id = $_GET['delete'];
$sql= "DELETE FROM users WHERE user_id = {$del_user_id}";
$del_query = mysqli_query($con, $sql);
header('location: users_dashboard.php');
}
   ?>