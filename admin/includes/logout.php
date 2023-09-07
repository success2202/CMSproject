<?php ob_start() ?>
<?php session_start(); ?>
<?php

    $_SESSION['password'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['user_role'] = null;
    header("location: /cms/index.php")
    ?>
