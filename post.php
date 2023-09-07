<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

    <!-- Navigation -->
    <?php include('includes/navigation.php'); ?>


    <?php
    //like post
if(isset($_POST['liked'])){
    //fetching the post
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM posts WHERE post_id = $post_id";
    $postResult = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($postResult);
    $likes = $row['likes'];

    //UPDATE POST WITH LIKES
    mysqli_query($con, "UPDATE posts SET likes=$likes+1 WHERE post_id = $post_id");
    //create likes for posts
    mysqli_query($con, "INSERT INTO likes(user_id, post_id) VALUE($user_id, $post_id)");
}

//unliking post
if(isset($_POST['unliked'])){
 // echo "this is unlike";
 //fetching the right post
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM posts WHERE post_id = $post_id";
    $postResult = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($postResult);
    $likes = $row['likes'];
//delete like
mysqli_query($con, "DELETE FROM  likes WHERE post_id = $post_id AND user_id = $user_id");

// //UPDATE POST AND DECREMENTING LIKES
    mysqli_query($con, "UPDATE posts SET likes=$likes-1 WHERE post_id = $post_id");

   exit();
}

    ?>

<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">
  
<?php //incrementing the post view count
   $the_post_id = $_GET['p_id'];
   
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];
//incementing post views
    $sql = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";
    $post_views = mysqli_query($con, $sql);
    if(!$post_views){                                              //checking the connection and query
        die('QUERY FAILED' . mysqli_error($con));
      } 


if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
    $sql = " SELECT * FROM posts WHERE post_id = $the_post_id";
}else{
    $sql = " SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published' ";
}

//getting the post from the database 
// $sql = " SELECT * FROM posts WHERE post_id = $the_post_id";

$selectPost = mysqli_query($con, $sql);
if(mysqli_num_rows($selectPost) < 1){
echo "<h2 class='text-center'> No Post Avaliable </h2>";
}else{
while($row = mysqli_fetch_assoc($selectPost)){
    $post_heading = $row['post_heading'];
    $post_title = $row['post_title'];
    $post_user = $row['post_user'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    
    ?>
<br> <br> <br>


<!-- First Blog Post -->
<h1 style="text-align: center; color:red">
    <?=$post_title ?>
</h1>
<p class="lead">
<small> <i> By <a href=""><?=$post_user ?></a> </i> </small>
</p>
<p><span class="glyphicon glyphicon-time">  </span><?=$post_date ?></p>
<hr>
<img class="img-responsive" src="images/<?=imagePlaceHolder($post_image) ?>" alt="">
<hr>
<div class="contentContainer">
<p> <?=$post_content ?></p>
</div>
<hr>
<!-- freeing result -->


<!-- link for like and unlike -->
<?php if(isLoggedIn()){ ?>

    <!-- adding a tooltip to like -->
<div class="row">
<button name="share" class="pull-left" style='font-size:15px'><i class="fas fa-share-alt"
data-toggle="tooltip"
data-placement="top"
title="share">
</i></button>

<button class="share-button facebook" style='font-size:15px'>
            <i class="fab fa-facebook-f"></i>
         </button>
<p class="pull-right countLike"> <a class="countLike" href="">  Likes:<?= getPostLikes($the_post_id) ?> </a>  </p> 
<p class="pull-right"> <a  class=" <?= userLikeThisPost($the_post_id)  ?  'unlike':'like' ?>" 
    href=""> <span class="glyphicon glyphicon-thumbs-up"
    data-toggle="tooltip"
    data-placement="top"
    title="<?= userLikeThisPost($the_post_id) ? 'you have like this before' : 'do you want to like this post' ?>">
</span> <?= userLikeThisPost($the_post_id)  ?  'unlike' : 'like' ?> &nbsp; </a></p>
</div>

<?php } else{ ?>
    <div class="row">
    <p class="pull-right countLike">please <a class="countLike" href="/cms/login_page"> Login </a>to like this post</p>
    
</div>

<?php }
?>

<!-- <div class="row">
    <p class="pull-right countLike"> <a class="countLike" href="">Likes: <?= getPostLikes($the_post_id) ?></a></p>
</div>
<div class="clearfix"></div> -->


<?php }


?>

<?php
//adding comment
if(isset($_POST['create_comment'])){ 


    $the_post_id =  $_GET['p_id'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    //checking if fields are empty
if(!empty($comment_author)&& !empty($comment_email)&& !empty($comment_content)){
    //inserting comments
    
    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email,  
    comment_content, comment_status, comment_date)
             VALUES({$the_post_id},'{$comment_author}', '{$comment_email}',
             '{$comment_content}', 'unapproved', now())"; 
 $result =  mysqli_query($con,$query);
      if(!$result){                                             //checking the connection and query
        die('QUERY FAILED' . mysqli_error($con));
      } 
      
      //incrementing comment on post
// $sql = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
// $update_comment_count=mysqli_query($con, $sql);

}else{
    echo "<script> alert('fields cannot be empty') </script>";
}
header('location: /cms/post.php?p_id='.$the_post_id);
}

?>

<!-- comment form -->
<div class="well">
<h3 style="text-align:center"> Leave a comment:</h3> 
    <form role="form" action="" method="POST">

        <div class="form-group">
<label for="user">User</label>
    <select name="comment_author" id="">
<?php 
$user=$_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id ='{$user}'"; //
$user_result = mysqli_query($con, $sql);
checkquerry($user_result);//coming from function.php

while($row = mysqli_fetch_assoc($user_result)){ //selecting categories and outputing it on the form
$user_id = $row['user_id'];
$username = $row['username'];
echo "<option>{$username}</option>";
}

?>
    </select>

</div>


        <div class="form-group">
        <label for="email">Email</label>
          <input type="email" class="form-control" name="comment_email">
        </div>
        <div class="form-group">
        <label for="content">Comment</label>
            <textarea name="comment_content" class="form-control"  rows="3"></textarea>
        </div>
        <button type="submit" name="create_comment" class="btn btn-primary">send</button>
    </form>

</div>
<hr>
<h3 class="media-heading">Read Comments</h3>
<!-- Posted Comments -->
        <?php
$sql = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} 
AND comment_status = 'approved' ORDER BY comment_id DESC ";
$selectComment = mysqli_query($con, $sql);
if(!$selectComment){
    die('QUERY FAILED' . mysqli_error($con));
}   
while ($row = mysqli_fetch_assoc($selectComment)){
    $comment_date = $row['comment_date'];
    $comment_content = $row['comment_content'];
    $comment_author = $row['comment_author'];
   ?>
   
<!-- displaying comments -->
<div class="media">
<a class="pull-left" href="#">
<img class="media-object" src="http://placehold.it/64x64" alt="">
</a>
<div class="media-body">
<h4 class="media-heading"> 
<li>
<?php echo $comment_author;?>
<small> <?php echo $comment_date;?> </small>
</h4>
<?php echo $comment_content;?>
</li>
</div>

</div>
 <?php }}}else{
    header("location: index.php");
} ?>



            </div>
            
            <!-- Blog Sidebar Widgets Column -->
           

            <?php include('includes/sideBar.php'); ?>



        </div>
        <!-- /.row -->

        <hr>

        <?php include('includes/footer.php'); ?>
<!-- this is the script for likes  -->
        <script>

$(document) .ready(function(){
    //adding tooltip
$("[data-toggle='tooltip']").tooltip();

//like
    var post_id = <?= $the_post_id ?>;
    var user_id = <?=loggedInUserId()?>;
//like
    $('.like').click(function(){
        $.ajax({
            url: "/cms/post.php?p_id=<?= $the_post_id?>",
            type: 'post',
            data: {
                'liked': 1,
                'post_id':  post_id,
                'user_id': user_id
            }
        });

    });

    //unlike 
    $('.unlike').click(function(){
    $.ajax({
            url: "/cms/post.php?p_id=<?= $the_post_id?>",
            type: 'post',
            data: {
                'unliked': 1,
                'post_id':  post_id,
                'user_id': user_id
            }
        });

});

});
        </script>