<?php 
if(isset($_GET['edit_user'])){
        $the_user_id = $_GET['edit_user'];

        $sql = "SELECT * FROM users WHERE user_id = $the_user_id"; //getting the users from the database 
        $select_user_query = mysqli_query($con, $sql);              
      
    while($row = mysqli_fetch_assoc($select_user_query)){ //displaying the users on the table
          $user_id = $row['user_id'];
          $username = $row['username'];
          $password = $row['user_password'];
          $firstname = $row['user_firstname']; 
          $lastname = $row['user_lastname'];
          $email = $row['user_email'];
          $image = $row['user_image'];
          $role = $row['user_role'];
 


//getting input and  creating or adding users 
if(isset($_POST['edit_user'])){
              //$user_id = $_POST['user_id'];
          $user_firstname   = $_POST['user_firstname'];
          $user_lastname    = $_POST['user_lastname'];
          $user_role        = $_POST['user_role'];
          $username         = $_POST['username'];

              //    $post_image        = $_FILES['image']['name'];
              //    $post_image_temp   = $_FILES['image']['tmp_name'];

          $user_email         = $_POST['user_email'];
          $user_password      = $_POST['user_password'];
          $post_date         = date('d-m-y');
              //$post_comment_count = 4;

}
              //getting user password
 if(!empty($user_password)){
          $sql_query = "SELECT user_password FROM users WHERE user_id =$the_user_id";
          $get_User_query = mysqli_query($con, $sql_query);
          checkquerry($get_User_query);
          $row = mysqli_fetch_array($get_User_query);
          $db_user_password = $row['user_password'];

  
 if($db_user_password != $user_password){
          $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
 }
//updating user password
          $query = "UPDATE users 
          SET  user_firstname ='{$user_firstname}',
          user_lastname ='{$user_lastname}', user_role='{$user_role}',
          username ='{$username}', user_email = '{$user_email}', user_password = '{$hashed_password}'
          WHERE user_id= {$the_user_id}"; 
          $update_result =  mysqli_query($con,$query);
          checkquerry($update_result); //checking if the querry works
          header('location:users_dashboard.php'); 
 }


}

}else{
  header('location: index.php');
}


?>

<!-- edit user form -->
<form action="" method="post" enctype="multipart/form-data">    

<div class="form-group">
<label for="firstname">Firstname</label>
<input type="text" class="form-control" name="user_firstname" value="<?=$firstname ?>">
   
</div>


<div class="form-group">
<label for="lastname">Lastname</label>
<input type="text" class="form-control" name="user_lastname" value="<?=$lastname ?>"> 
</div>

<div class="form-group">
<label for="username">Role</label>
<select name="user_role" id=""> 
    <option value="<?=$role?>"><?=$role?> </option>
    
    <?php
    if($role =='admin'){
      echo  "<option value='subscriber'>subscriber</option>";
      echo  "<option value='client'>client</option>";
    }elseif($role =='subscriber'){
        echo "<option value='admin'>admin</option>";
        echo  "<option value='client'>client</option>";
    }else{
        echo "<option value='admin'>admin</option>";
        echo  "<option value='client'>subscriber</option>";
    }

    ?>

    
    
</select>
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
<input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
</div>


</form>