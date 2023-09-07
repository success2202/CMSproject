<?php error_reporting(E_ALL);
ini_set('display_errors', 0);?>
<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<?php
if(isset($_POST['submit'])){

// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("successceejay@gmail.com","My subject",$msg);

    $to = "successceejay@gmail.com";
    $subjec = $_POST['subject'];
    $body = $_POST['body'];

   
}
   
?>



<!-- Page Content -->
<div class="container">

<section id="login">
<div class="container">
<div class="row">
<div class="col-xs-6 col-xs-offset-3">
<div class="form-wrap">
    <br><br><br>
<h1>Contact</h1>
<form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

    <div class="form-group">
    <label for="email" class="sr-only">Email</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="enter your email">
</div>

<div class="form-group">
    <label for="subject" class="sr-only">Subject</label>
    <input type="text" name="subject" id="subject" class="form-control" placeholder="enter your subject">
</div>

    <div class="form-group">
    <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
</div>

<input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Send">
</form>

</div>
</div> <!-- /.col-xs-12 -->
</div> <!-- /.row -->
</div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
