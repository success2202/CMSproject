<?php error_reporting(E_ALL);
    ini_set('display_errors', 'ON'); ?>
<?php
include("delete_modal.php");
//getting data from the array checkBoxArray 
if(isset($_POST['checkBoxArray'])){
   $checkbox = $_POST['checkBoxArray'];
   foreach($checkbox as $checkboxValue_post_id){
      $bulk_options = $_POST['bulk_options'];

      switch($bulk_options){
         case 'published':
            $sql = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkboxValue_post_id}";
            $update_to_published = mysqli_query($con, $sql);
            
            break;

            case 'drafted':
               $sql = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkboxValue_post_id}";
               $update_to_draft = mysqli_query($con, $sql);
              
               break;

               case 'reset':
                  $sql= "UPDATE posts SET post_views_count = 0 WHERE post_id = ". mysqli_real_escape_string($con, $checkboxValue_post_id) ." ";
                  $check_view_query = mysqli_query($con, $sql);
                 
                  break;

               case 'deleted':
                  $sql = "DELETE FROM posts WHERE post_id = {$checkboxValue_post_id} ";
                  $post_delete_status = mysqli_query($con, $sql);
                 
                  break;

                  case 'clone':
                     $sql = "SELECT * FROM posts WHERE post_id = {$checkboxValue_post_id} ";
                     $clone_post = mysqli_query($con, $sql);

                     while($row = mysqli_fetch_array($clone_post)){ //displaying clone post on the table
                        $post_author = $row['post_author'];
                         $post_heading = $row['post_heading'];
                        $post_title = $row['post_title'];
                        $post_cat_id = $row['post_cat_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                        $post_date = $row['post_date'];
                     }

                     $query = "INSERT INTO posts(post_cat_id, post_heaading, post_title, post_author, 
                     post_date,post_image,post_content,post_tags,post_status)
                               VALUES({$post_cat_id}, '{$post_heading}', '{$post_title}','{$post_author}',now(),
                     '{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
                   $result =  mysqli_query($con,$query);
                        checkquerry($result); //function to check the query
                  
                    
                     break;
      }
   }

}

?>
<br> <br>

<!-- post table -->
<form action="" method="post">
<table class="table table-bordered table-hover">

   <div id="bulkOptionsContainer" class="col-xs-4">

   <select class="form-control" name="bulk_options" id="">

   <option value="">Select Options</option>
   <option value="published">Publish</option>
   <option value="drafted">Draft</option>
   <option value="clone">Clone</option>
   <option value="reset">Reset Post View</option>
   <option value="deleted" onClick="javascript: return confirm('are you sure you want to delete')";>Delete</option>

   </select>
   <br>
   </div>

<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
</div>

    <thead>
    <tr>
    <th><input id="selectAllBoxes" type="checkbox"></th>
    <th>ID</th>
    <th>Users</th>
    <th>Heading</th>
    <th>Title</th>
    <th>Caategories</th>
    <th>Satus</th>
    <th>Images</th>
    <th>Tags</th>
    <th>Content</th>
    <th>Comment </th>
    <th>Date</th>
    <th>Action</th>
    <th>View Post</th>
    <th>View Count</th>
    <th>Remove</th>
    </tr>
    </thead>
    <tbody>
    </form>

      <?php 
      
    
   //   $sql = "SELECT * FROM posts ORDER BY post_id ASC"; //displaying the categories from the database to the table
   $sql = "SELECT posts.post_id, posts.post_heading, posts.post_author, posts.post_user, posts.post_title,
   posts.post_cat_id, posts.post_status, posts.post_image, posts.post_tags, 
   posts.post_content, posts.post_comment_count, posts.post_date, posts.post_views_count,
   categories.cat_id, categories.cat_title FROM posts LEFT JOIN categories ON posts.post_cat_id = categories.cat_id  
     ORDER BY posts.post_id ASC";
   $selectPost = mysqli_query($con, $sql);              
         while($row = mysqli_fetch_assoc($selectPost)){ //displaying the categories on the table
            $post_id     = $row['post_id'];
            $post_heading = $row['post_heading'];
            $post_author = $row['post_author'];
            $post_user   = $row['post_user'];
            $post_title  = $row['post_title'];
            $post_cat_id = $row['post_cat_id'];
            $post_status = $row['post_status'];
            $post_image  = $row['post_image'];
            $post_tags   = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_comment_count = $row['post_comment_count'];
            $post_date       = $row['post_date'];
            $post_view_count = $row['post_views_count'];
            $cat_id    = $row['cat_id'];
            $cat_title = $row['cat_title'];

         echo "<tr>";  //displaying the post on the table
         ?>
<!-- checkBoxArray -->
<td> <input class='checkBox' type='checkbox' name='checkBoxArray[]' value='<?=$post_id?>'> </td> 
            <?php

echo "<td>$post_id </td>";

if(!empty($post_author)){
   echo "<td>$post_author </td>";
}elseif(!empty($post_user)){
   echo "<td>$post_user </td>";
}



echo "<td>$post_heading</td>";

echo "<td>$post_title </td>";
                   
//connecting categories with the post
// $sql = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}"; //displaying categories from the database in the post
// $selectCat = mysqli_query($con, $sql);
// while($row = mysqli_fetch_assoc($selectCat)){ //displaying categories with the post
// $cat_id = $row['cat_id'];
// $cat_title = $row['cat_title'];

                   echo "<td> $cat_title </td>";


                   echo "<td>$post_status </td>";
                   echo "<td> <img width='100' src='../images/$post_image' alt='image'> </td>";//class img-responsive can also be used
                   echo "<td>$post_tags </td>";
                   echo "<td>$post_content </td>";

                   $sql_query = "SELECT * FROM comments WHERE comment_post_id = $post_id"; 
                   $comment_query= mysqli_query($con, $sql_query);

                  //  $row = mysqli_fetch_array($comment_query);
                  
                   $comment_count= mysqli_num_rows($comment_query);

                   echo "<td><a href='post_comments.php?id=$post_id'>$comment_count</a></td>";



                   echo "<td>$post_date </td>";
                   echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'> Edit </a></td>";
                   echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'> View Post </a></td>";
                  //  resetting the view counter link
                   echo "<td><a onClick=\"javascript: return confirm('are you sure you want to reset');\" href='posts.php?reset={$post_id}'>$post_view_count </a></td>";
                  ?>
                  <form method="post">

                     <input type="hidden" name="post_id" value="<?php echo $post_id  ?>">
                  <?php
                     echo '<td> <input class="btn btn-danger" type="submit" name="delete" value="delete"> </td>';
                  ?>

                  </form>
                  

                     <?php
                   //using madel to delete post
                   //echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'> Delete </a></td>";




                  //  echo "<td><a onClick=\"javascript: return confirm('are you sure you want to delete');\" href='posts.php?delete={$post_id}'> Delete </a></td>";
                 
                echo "</tr>";
               } 
            
            ?>

    

    </tbody>
    </table>


    <?php   //delete post
if(isset($_POST['delete'])){

   // if(isset($_SESSION['user_role'])){
   //    if($_SESSION['user_role'] == 'admin'){
   //       $del_post_id = mysqli_real_escape_string($con, $_GET['delete']);
$del_post_id = $_POST['post_id'];
$sql= "DELETE FROM posts WHERE post_id = {$del_post_id}";
$checkquery = mysqli_query($con, $sql);
header("location:posts.php"); 
}


//resetting the view counter code
if(isset($_GET['reset'])){
   $del_view_count_id = $_GET['reset'];
   $sql= "UPDATE posts SET post_views_count = 0 WHERE post_id = ". mysqli_real_escape_string($con, $del_view_count_id) ." ";
   $check_view_query = mysqli_query($con, $sql);
   header("location:posts.php"); 
   }

   ?>

<script>
$(document).ready(function(){

   $(".delete_link").on('click', function(){

      var id = $(this).attr("rel");
      var delete_url = "posts.php?delete="+ id +" ";
      $(".modal_delete_link").attr("href", delete_url);
      $("#myModal").modal('show');

   });


});



</script>
