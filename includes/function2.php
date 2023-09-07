<?php
function checkquerry($result){
    global $con;
   if(!$result){
      die('QUERY FAILED' . mysqli_error($con));
   }
}


function username_exist($username){
    global $con;
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql); 
    checkquerry($result);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}


function email_exist($email){
    global $con;
    $sql = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($con, $sql); 
    checkquerry($result);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

?>