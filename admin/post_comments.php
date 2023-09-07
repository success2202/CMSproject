<?php include('includes/admin_header.php') ?>

<div id="wrapper">

<!-- Navigation -->

 <?php include('includes/admin_navigation.php') ?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">

<h1 class="page-header">
 SINGLE POST COMMENT
<small><?php echo $_SESSION['username'];?></small> 
</h1> 

<table class="table table-bordered table-hover">
    <thead>
    <tr>
    <th>ID</th>
    <th>AUTHOR</th>
    <th>COMMENT</th>
    <th>EMAIL</th>
    <th>STATUS</th>
    <th>RESPONSE TO</th>
    <th>DATE</th>
    <th>APPROVED</th>
    <th>UNAPPROVED</th>
    <th>Delete</th>
    
   
    
    </tr>
    </thead>
    <tbody>

            <?php 
            
           $sql = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($con, $_GET['id']). " "; //displaying the categories from the database to the table
           $select_comment = mysqli_query($con, $sql);              
               while($row = mysqli_fetch_assoc($select_comment)){ //displaying the categories on the table
                   $comment_id = $row['comment_id'];
                   $comment_post_id = $row['comment_post_id'];
                   $comment_author = $row['comment_author'];
                   $comment_content = $row['comment_content'];
                   $comment_email = $row['comment_email'];
                   $comment_status = $row['comment_status'];
                   $comment_date = $row['comment_date'];

                echo "<tr>";  //displaying the post on the table
                   echo "<td>$comment_id</td>";
                   echo "<td>$comment_author </td>";
                   echo "<td> $comment_content </td>";
                   
//connecting categories with the post
// $sql = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}"; //displaying categories from the database in the post
// $selectCat = mysqli_query($con, $sql);
// while($row = mysqli_fetch_assoc($selectCat)){ //displaying categories with the post
// $cat_id = $row['cat_id'];
// $cat_title = $row['cat_title'];

//                    echo "<td> $comment_post_id</td>";

// }
    echo "<td>$comment_email </td>";
    echo "<td>$comment_status</td>";

$sql = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
$check= mysqli_query($con, $sql);
while($row =  mysqli_fetch_assoc($check) ){
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
}
    

    
    echo "<td>$comment_date </td>";
    
    echo "<td><a href='post_comments.php?approve=$comment_id&id=" . $_GET['id']. "'> Approve </a></td>";
    echo "<td><a href='post_comments.php?unapprove=$comment_id&id=" . $_GET['id']. "'> Unapprove </a></td>";
    echo "<td><a onClick=\"javascript: return confirm('are you sure you want to delete');\" href='post_comments.php?delete=$comment_id&id=" . $_GET['id']. "'> Delete </a></td>";
    
echo "</tr>";
} 

?>

    

    </tbody>
    </table>


    <?php   //delete comment, approve, and unapprove comment

if(isset($_GET['approve'])){
    $approve_comment_id = $_GET['approve'];
    $sql= "UPDATE comments SET comment_status = 'approved' WHERE comment_id ={$approve_comment_id}";
    $approve_query = mysqli_query($con, $sql);
    header('location: post_comments.php?id=' . $_GET['id']. '');
}


if(isset($_GET['unapprove'])){
    $unapprove_comment_id = $_GET['unapprove'];
    $sql= "UPDATE comments SET comment_status ='unapproved' WHERE comment_id ={$unapprove_comment_id}";
    $unapprove_query = mysqli_query($con, $sql);
    header('location: post_comments.php?id=' . $_GET['id']. '');
}


if(isset($_GET['delete'])){
$del_comment_id = $_GET['delete'];
$sql= "DELETE FROM comments WHERE comment_id = {$del_comment_id}";
$checkquery = mysqli_query($con, $sql);
header("location: post_comments.php?id=" . $_GET['id']. "");
}
   ?>

</div>
    </div>
    <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include('includes/admin_footer.php') ?>