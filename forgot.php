
<?php  include "includes/db.php"; ?> 
<?php  include "includes/header.php"; ?>

<!-- Navigation -->
<?php  include "includes/navigation2.php"; ?>

<?php
require './classes/config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';

// $mail = new PHPMailer(true);

// echo get_class($mail);

?>
<?php
if(!ifItisMethod('get') && !isset($_GET['forgot'])){
    redirect('index');
}

if(ifItisMethod('post')){
   if(isset($_POST['email'])){
    $email = $_POST['email'];
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));

    if(email_exist($email));
    if($stmt = mysqli_prepare($con, "UPDATE users SET token='$token' WHERE user_email=?")){
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

//configure phpmailer

 $mail = new phpmailer();
 //Server settings
 $mail->isSMTP();                                            //Send using SMTP
 $mail->Host       = config:: SMTP_HOST;                     //Set the SMTP server to send through
 $mail->Username   = config:: SMTP_USER;                     //SMTP username
 $mail->Password   = config:: SMTP_PASSWORD;                 //SMTP password
 $mail->Port       = config:: SMTP_PORT;                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
 $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
 $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
 $mail->isHTML(true);  
 $mail->CharSet = 'UTF-8'; 
 $mail->setFrom('successceejay@gmail.com', 'Enyioha Success');  
 $mail->addAddress($email);  
 $mail->Subject = 'this is test email';  
 $mail->Body = '<p> please click to reset your password
 <a href="http://localhost/cms/reset.php?email='.$email.'&token='.$token.' "> href="http://localhost/cms/reset.php?email=" '.$email. '&token=' .$token.' </a>
 </p>';

if($mail->send()){

$emailSent = true;

}else{
    echo "email not sent";  
}

    }
   }
}

?>

<br> <br> <br>
<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                        <?php if(!isset($emailSent)): ?>
                            
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <?php else: ?>

                                    <h2>please check your email</h2>

                                <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

