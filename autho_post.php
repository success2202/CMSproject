<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

    <!-- Navigation -->
    <?php include('includes/navigation.php'); ?>

<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">

<?php 
if(isset($_GET['p_id'])){
    $the_post_id = $_GET['p_id'];
    $the_post_user = $_GET['user'];


$sql = " SELECT * FROM posts WHERE post_user = '{$the_post_user}'";
$selectPost = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($selectPost)){
    $post_title = $row['post_title'];
    $post_user = $row['post_user'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    
    ?>

<h1 class="page-header">
    My Bloging Content
    <small>Secondary Text</small>
</h1>

<!-- First Blog Post -->
<h2>
    <a href="#"><?=$post_title ?></a>
</h2>
<p class="lead">
  All Post by <?=$post_user ?>
</p>
<p><span class="glyphicon glyphicon-time"></span><?=$post_date ?></p>
<hr>
<img class="img-responsive" src="images/<?=$post_image ?>" alt="">
<hr>
<p> <?=$post_content ?></p>


<hr>

               <?php }  }
                    ?>

<?php
if(isset($_POST['create_comment'])){ 


    $the_post_id =  $_GET['p_id'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    //checking if fields are empty
if(!empty($comment_author)&& !empty($comment_email)&& !empty($comment_content)){
    //inserting comments
    $query = "INSERT INTO comments(comment_post_id,  comment_author, comment_email,  
    comment_content, comment_status, comment_date)
             VALUES({$the_post_id},'{$comment_author}', '{$comment_email}',
             '{$comment_content}', 'unapproved', now())"; 
 $result =  mysqli_query($con,$query);
      if(!$result){                                             //checking the connection and query
        die('QUERY FAILED' . mysqli_error($con));
      } 
      
$sql = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
$update_comment_count=mysqli_query($con, $sql);



}else{
    echo "<script> alert('fields cannot be empty') </script>";
}

}



?>


<div class="well">
    <h4>Leave a comment:</h4>
    <form role="form" action="" method="POST">

    <div class="form-group">
        <label for="author">Author</label>
          <input type="text" class="form-control" name="comment_author">
        </div>
        <div class="form-group">
        <label for="email">Email</label>
          <input type="email" class="form-control" name="comment_email">
        </div>
        <div class="form-group">
        <label for="content">Comment</label>
            <textarea name="comment_content" class="form-control"  rows="3"></textarea>
        </div>
        <button type="submit" name="create_comment" class="btn btn-primary">submit</button>
    </form>

</div>
<hr>

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

<div class="media">
<a class="pull-left" href="#">
<img class="media-object" src="http://placehold.it/64x64" alt="">
</a>
<div class="media-body">
<h4 class="media-heading"> 
<?php echo $comment_author;?>
<small> <?php echo $comment_date;?> </small>
</h4>
<?php echo $comment_content;?>
</div>

</div>
 <?php } ?>



            </div>
            
            <!-- Blog Sidebar Widgets Column -->
           

            <?php include('includes/sideBar.php'); ?>



        </div>
        <!-- /.row -->

        <hr>

        <?php include('includes/footer.php'); ?>