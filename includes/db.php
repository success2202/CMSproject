<?php ob_start(); ?>
<?php
//coonecting to the database
$con = mysqli_connect('localhost', 'root', '', 'cmss');
$query = "SET NAMES utf8";
mysqli_query($con, $query);
if($con){
    //echo " connection successfully";
}
?>