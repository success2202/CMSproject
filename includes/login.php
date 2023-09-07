<?php include('db.php'); ?>
<?php session_start(); ?>
<?php include('../admin/function.php'); ?>
<?php
if(isset($_POST['login'])){
    // $log_id = $_POST['login'];
   $username = $_POST['username'];
    $password = $_POST['password'];

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($con,  $username);
    $password = mysqli_real_escape_string($con,  $password);

    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $select_username = mysqli_query($con, $sql);
    if(!$select_username){
        die('QUERY FAILED' . mysqli_error($con));
    }
}

while($row=mysqli_fetch_array($select_username)){
     $db_user_id = $row['user_id'];
     $db_username = $row['username'];
     $db_password = $row['user_password'];
     $db_firstname = $row['user_firstname'];
     $db_lastname = $row['user_lastname'];
     $db_role = $row['user_role'];

}
//checking if the username in the input and the one fetched from the database are the same also check the password
//if($username === $db_username && $password === $db_password){
    if(password_verify($password,$db_password)){
    $_SESSION['user_id'] = $db_user_id;
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_firstname;
    $_SESSION['lastname'] = $db_lastname;
    $_SESSION['user_role'] = $db_role;
 if(is_Admin()){
    header("location: ../admin/dashboard.php");
   
}elseif(is_Client()){
    header("location: ../index.php");

}else{
    header("location: ../admin");
}
}else{
    header("location: ../index.php");
}

?>