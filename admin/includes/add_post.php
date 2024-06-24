<?php 
//creating or adding post
if(isset($_POST['create_post'])){
    $post_category_id  = $_POST['post_category'];
    $post_heading        = $_POST['post_heading'];
   $post_title        = $_POST['title'];
   $post_author       = $_POST['post_author'];
   $post_user       = $_POST['post_user'];
   
   $post_status       = $_POST['post_status'];

   $post_image        = $_FILES['image']['name'];
   $post_image_temp   = $_FILES['image']['tmp_name'];


   $post_tags         = $_POST['post_tags'];
   $post_content      = $_POST['post_content'];
   $post_date         = date('d-m-y');
   //$post_comment_count = 4;

   move_uploaded_file( $post_image_temp, "../images/$post_image");

//inserting the post to the database
   $query = "INSERT INTO posts(post_cat_id, post_heading, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status)
             VALUES('{$post_category_id}', '{$post_heading}', '{$post_title}', '{$post_author}', '{$post_user }', now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}')"; 
 $result =  mysqli_query($con,$query);
      checkquerry($result); //function to check the query

      $the_post_id = mysqli_insert_id($con);

      echo "<h3><p class='bg-success'> Your Post as been added. <a href='../post.php?p_id={$the_post_id}'> View Post</a> or
      <a href='./posts.php'>Edit Post </a> </p></h3>";

    //   header('location:posts.php');
}


?>

<!-- post form -->
<form action="" method="post" enctype="multipart/form-data">    

<div class="form-group">
<label for="heading">Heading</label>
<input type="text" class="form-control" name="post_heading">
</div>


<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title">
</div>


<div class="form-group">
<label for="category">Categories</label> 
    <select name="post_category" id="">
<?php 
$sql = "SELECT * FROM categories"; //
$result = mysqli_query($con, $sql);
checkquerry($result);//coming from function.php

while($row = mysqli_fetch_assoc($result)){ //selecting categories and outputing it on the table
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];
echo "<option value='$cat_id'>{$cat_title}</option>";
}

?>
    </select>

</div>



<div class="form-group">
<label for="post_author">Post Author</label>
<input type="text" class="form-control" name="post_author">
   
</div>


<div class="form-group">
<label for="users">Users</label>
    <select name="post_user" id="">
<?php 
$sql = "SELECT * FROM users"; //
$user_result = mysqli_query($con, $sql);
checkquerry($user_result);//coming from function.php

while($row = mysqli_fetch_assoc($user_result)){ //selecting categories and outputing it on the form
$user_id = $row['user_id'];
$username = $row['username'];
echo "<option value={$username}>{$username}</option>";
}

?>
    </select>

</div>


<div class="form-group"> 
<label for="post_status">Post Status</label> <br>
   <select  name="post_status" id="">
   <option value="">Select Status</option>
   <option value="published">Publish</option>
   <option value="drafted">Draft</option>
   </select>
   </div>


<!-- <div class="form-group">
<label for="post_status">Post Status</label>
<input type="text" class="form-control" name="post_status">
   
</div> -->


<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file"  name="image">
</div>

<div class="form-group">
<label for="post_tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
<label for="summernote">Post Content</label>
<textarea class="form-control "name="post_content" id="summernote" cols="30" rows="30">
</textarea>
</div>



<div class="form-group">
<input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>


</form>

