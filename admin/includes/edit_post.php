<?php 

if(isset($_GET['p_id'])){
$edit_post_id = ($_GET['p_id']);

}

$sql = "SELECT * FROM posts WHERE post_id = {$edit_post_id}"; 
$select_edit_Post = mysqli_query($con, $sql);              
while($row = mysqli_fetch_assoc($select_edit_Post)){ 
$post_heading = $row['post_heading'];
$post_author = $row['post_author'];
$post_user = $row['post_user'];
$post_title = $row['post_title'];
$post_cat_id = $row['post_cat_id'];
$post_status = $row['post_status'];
$post_image = $row['post_image'];
$post_tags = $row['post_tags'];
$post_content = $row['post_content'];


}

if(isset($_POST['post_update'])){
    $post_heading     = $_POST['post_heading'];
    $post_author      = $_POST['post_author'];
    $post_user      = $_POST['post_user'];
    $post_title       = $_POST['post_title'];
   $post_category_id  = $_POST['post_category'];
   $post_status       = $_POST['post_status'];

   $post_image        = $_FILES['image']['name'];
   $post_image_temp   = $_FILES['image']['tmp_name'];

   $post_tags         = $_POST['post_tags'];
   $post_content      = $_POST['post_content'];

   move_uploaded_file($post_image_temp, "../images/$post_image");//uploading the image
   //making sure the image is not empty and if its empty fetch the image using the id
   if(empty($post_image)){
    $sql = "SELECT * FROM posts WHERE post_id = $edit_post_id";
    $select_image = mysqli_query($con, $sql);
    while($row=mysqli_fetch_assoc($select_image)){
        $post_image = $row['post_image'];
    }
   }

    //updating the edit post
   $query = "UPDATE posts 
   SET post_cat_id={$post_category_id}, post_heading='{$post_heading}', post_title='{$post_title}', post_author='{$post_author}',
    post_user='{$post_user}', post_date=now(), post_image='{$post_image}',
    post_content='{$post_content}', post_tags='{$post_tags}', post_status='{$post_status}'
    WHERE post_id={$edit_post_id}"; 
 $result =  mysqli_query($con,$query);
 checkquerry($result); //checking if the querry works
//  header('location:../dashboard.phpp_id={$edit_post_id}'); 
 echo "<h3><p class='bg-success'> Your Post as been updated. <a href='../post.php?p_id={$edit_post_id}'> View Post</a> or
 <a href='./posts.php'>Edit More Post </a> </p></h3>";
 //header('location:./posts.php');
 //if(!result){
   // die("QUERY FAILED" . mysqli_error($con));
 //}
}

?> 
 
<!-- edit post form -->
<form action="" method="post" enctype="multipart/form-data">    


<div class="form-group">
<label for="post_heading">Heading</label>
<input type="text" class="form-control" name="post_heading" value="<?=$post_heading ?> ">
</div>

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="post_title" value="<?=$post_title ?> ">
</div>
 

<div class="form-group">
<label for="category">Categories</label>
    <select name="post_category" id="">
<?php 
$sql = "SELECT * FROM categories"; //
$result = mysqli_query($con, $sql);
checkquerry($result);//coming from function.php

while($row = mysqli_fetch_assoc($result)){ //selecting categories and outputing it on the form
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];
if($cat_id == $post_category_id){
    echo "<option selected value='$cat_id'>{$cat_title}</option>";
}else{
echo "<option value='$cat_id'>{$cat_title}</option>";
}
}

?>
    </select>

</div>


<div class="form-group">
<label for="post_author">Post Author</label>
<input type="text" class="form-control" name="post_author" value="<?=$post_author?>">
   
</div>

<div class="form-group">
<label for="users">Users</label>
    <select name="post_user" id="">
   <?php echo "<option value={$post_user}>{$post_user}</option>"; ?>
<?php 
$user = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE user_id ='{$user}'"; //
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
<label for="post_status">Post Status</label>
<select name="post_status" id="">
<option value="<?=$post_status?>"><?=$post_status?></option>
<?php
if($post_status == 'published'){
   echo  "<option value='drafted'>Draft</option>";
}else{
    echo  "<option value='published'>Publish</option>";
}
?>

</select>
</div>



<!-- <div class="form-group">
<label for="post_status">Post Status</label>
<input type="text" class="form-control" name="post_status" value="<?=$post_status?>">
   
</div> -->


<div class="form-group">
<label for="post_image">Add Photo</label>
<input type="file"  name="image"> <br>
<img width='100' src="../images/<?=$post_image?>" atl="">

</div>

<div class="form-group">
<label for="post_t ags">Post Tags</label>
<input type="text" class="form-control" name="post_tags" value="<?=$post_tags?>">
</div>

<div class="form-group">
<label for="post_content">Post Content</label>
<textarea  class="form-control" name="post_content" id="summernote" cols="40" rows="30" >
<?php echo str_replace('\r\n', '</br>', $post_content); ?> 
</textarea><!-- the content value is in the textarea tag -->

</div>



<div class="form-group">
<input class="btn btn-primary" type="submit" name="post_update" value="Publish Post">
</div>


</form> 