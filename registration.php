
<?php error_reporting(E_ALL);
ini_set('display_errors', 0);?>
<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<!-- setting language variables -->
<?php
if(isset($_GET['lang'])  && !empty($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];

    if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
        echo "<script type='text/javascript'> location.reload();</script>";
    }

}
    if(isset($_SESSION['lang'])){
        include "includes/languages/".$_SESSION['lang'].".php";

    }else{
        include "includes/languages/en.php";

    }


?>

<?php
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $error = [
        'username'=> '',
        'email'=> '',
        'password'=> ''
    ];

    if(strlen($username) < 4 ){
        $error['username'] = "username needs to be longer";
    }
   
    if($username==""){
        $error['username'] = "username cannot be empty";
    }

    if($email==""){
        $error['email'] = "email cannot be empty";
    }

    if($password==""){
        $error['password'] = "password cannot be empty";
    }
    if(!empty($username) && !empty($email) && !empty($password)){

        if(username_exist($username) || email_exist($email)){
            $message = "username or email already used";
        }else{    
        $username = mysqli_real_escape_string($con,  $username);
        $email    =    mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>10));

    // $password = crypt($password, 'thissthkskadkfjnpoe43ekda');
   
    $query = "INSERT INTO users(username, user_email, user_password, user_role)
             VALUES('{$username}','{$email}', '{$password}', 'client') "; 
 $register_user =  mysqli_query($con,$query); 
 if(!$register_user ){
    die("query failed" . mysqli_error($con));
 }

 header("location: index.php");
//  header("location: index.php");
} 
// }else{ 
//  $message = "Empty field";
 
 
// }

}
     }
    
?>

<!-- Page Content -->
<div class="container">
    <!-- setting language form -->
<br><br><br><br>
<form method="get" action="" class="navbar-form navbar-right" id="language-form">
<div class="form-group">
    <select name="lang" class="form-control" onchange="changeLanguage()" >
        <option value="en"<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en'){echo "selected";}?>>English</option>
        <option value="es"<?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'es'){echo "selected";}?>>Spanish</option>
    </select>
</div>
</form>
<section id="login">
<div class="container">
<div class="row">
<div class="col-xs-6 col-xs-offset-3">
<div class="form-wrap">
<h1 style="text-align:center"><?=_REGISTER?></h1>
<form role="form" action="registration.php" method="post" id="login-form">
   <h4 class="text-center"> <?= $error['username']?> </h4>
   <h4 class="text-center"> <?= $error['password']?> </h4>
  
<div class="form-group">
    <label for="username" class="sr-only">username</label>
    <input type="text" name="username" id="username"  class="form-control"  placeholder="<?=_USERNAME ?>">

    <p><?php echo isset($error['$username']) ? $error['$username']: '' ?> </p>

</div>
    <div class="form-group">
    <label for="email" class="sr-only">Email</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="<?=_EMAIL ?>">

    <p><?php echo isset($error['$email']) ? $error['$email']: '' ?> </p>

</div>
    <div class="form-group">
    <label for="password" class="sr-only">Password</label>
    <input type="password" name="password" id="key" class="form-control" placeholder="<?=_PASSWORD ?>">
</div>

<input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="<?=_REGISTER ?>">
</form>

</div>
</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->
</div> <!-- /.container -->
</section>
    <hr>
<?php include "includes/footer.php";?>

<!-- language change -->
<script>
    function changeLanguage(){
        // console.log("it is working");
        document.getElementById('language-form').submit();
    }
</script>