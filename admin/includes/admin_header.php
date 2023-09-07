<?php ob_start(); ?>
<?php session_start(); ?>
<?php include ('../includes/db.php'); ?>
<?php include('function.php'); ?>

<?php //logging in through the session if the user role is admin
if(!isset($_SESSION['user_role'])){
    header("location: ../index.php");   
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BestLoveWords</title>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
     WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]> -->
        <!-- <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> -->
    <!-- <![endif]--> 
    <!-- custome css/ -->
   
    <link href="css/styles.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="http://tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    
    <!-- include summernote css/ -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->

    <link href="css/summernote-lite.css" rel="stylesheet">



    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    
    <script src="js/jquery.js"></script>
     
</head>

<body>