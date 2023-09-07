
<?php 
//creating or adding users
if(isset($_POST['create_user'])){
    // $user_id = $_POST['user_id'];
   $user_firstname   = $_POST['user_firstname'];
   $user_lastname    = $_POST['user_lastname'];
   $user_role        = $_POST['user_role'];
   $username         = $_POST['username'];
   $user_email         = $_POST['user_email'];
   $user_password      = $_POST['user_password'];

   $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10)); //encrypting user password 

//adding the user to the database
   $query = "INSERT INTO users(user_firstname, user_lastname, user_role, 
   username, user_email, user_password) VALUES('{$user_firstname}','{$user_lastname}','{$user_role}',
   '{$username}','{$user_email}','{$user_password}')"; 
 $addUser_query =  mysqli_query($con, $query);

      checkquerry($addUser_query); //function to check the query
      header('location:users_dashboard.php');
}


?>

<!-- post form -->
<form action="" method="post" enctype="multipart/form-data">    

<div class="form-group">
<label for="firstname">Firstname</label>
<input type="text" class="form-control" name="user_firstname">
   
</div>


<div class="form-group">
<label for="lastname">Lastname</label>
<input type="text" class="form-control" name="user_lastname"> 
</div>

<div class="form-group">
<label for="username">Role</label>
<select name="user_role" id="">
    <option value="subscriber">Select Options</option>
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>
    <option value="client">Client</option>
</select>
</div>

<!-- <div class="form-group">
<label for="post_image">Post Image</label>
<input type="file"  name="image">
</div> -->

<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username">
</div>

<div class="form-group">
<label for="user_email">Email</label>
<div class="input-group">
<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
<input id="email" name="user_email" placeholder="email address" class="form-control"  type="email">
</div>
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="user_password">
</div>

<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
</div>


</form>