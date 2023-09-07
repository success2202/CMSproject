<table class="table table-bordered table-hover">
    <thead>
    <tr>
    <th><input id="selectAllBoxes" type="checkbox"></th>
    <th>ID</th>
    <th>USER</th>
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
           
           $sql = "SELECT * FROM comments ORDER BY comment_id ASC"; //displaying the categories from the database to the table
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
                ?>
                <td> <input class='checkBox' type='checkbox' name='checkBoxArray[]' value='<?=$post_id?>'> </td> 
            <?php
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
    
    echo "<td><a class='btn btn-primary'href='comment_dashboard.php?approve=$comment_id'> Approve </a></td>";
    echo "<td><a class='btn btn-info' href='comment_dashboard.php?unapprove=$comment_id'> Unapprove </a></td>";
    echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('are you sure you want to delete');\" href='comment_dashboard.php?delete=$comment_id'> Delete </a></td>";
    
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
    header('location: comment_dashboard.php');
}


if(isset($_GET['unapprove'])){
    $unapprove_comment_id = $_GET['unapprove'];
    $sql= "UPDATE comments SET comment_status ='unapproved' WHERE comment_id ={$unapprove_comment_id}";
    $unapprove_query = mysqli_query($con, $sql);
    header('location: comment_dashboard.php');
}


if(isset($_GET['delete'])){
$del_comment_id = $_GET['delete'];
$sql= "DELETE FROM comments WHERE comment_id = {$del_comment_id}";
$checkquery = mysqli_query($con, $sql);
header('location: comment_dashboard.php');
}
   ?>