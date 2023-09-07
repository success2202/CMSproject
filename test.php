<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>
<?php include('admin/function.php'); ?>
<?php
// echo password_hash('secret', PASSWORD_BCRYPT, array('cost'=>10));
echo loggedInUserId();
if(userLikeThisPost(128)){
    echo "this user like this post";
}else{
    echo "this user didnt";
}
?>