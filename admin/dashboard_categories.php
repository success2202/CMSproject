<?php error_reporting(E_ALL);
ini_set('display_errors', 'ON');?>

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
All Categories
<small><?php echo $_SESSION['username'];?></small>
</h1>
<div class="col-xs-6">

<?php insert_category();?>  <!-- this is the function that insert category -->   

<form action="" method="POST"> <!-- add category form -->
<div class="form-group">
<label for="cat_title">Add Category</label>
<input type="text" class="form-control" name="cat_title">
</div>


<div class="form-group">
<label for="user">User</label>
    <select name="cat_user" id="">
<?php 
$user = $_SESSION['user_id'];
$sql = "SELECT username FROM users where user_id = $user"; //
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
<input class="btn btn-primary" type="submit" name="submit2" value="Add Category">
</div>

</form>

<?php            
if(isset($_GET['edit'])){
$cat_id = $_GET['edit'];
include('includes/update_cat.php');  //the includes contains the edit form 
}
?>


</div> <!-- holding form -->

<div class="col-xs-6">
<table class="table table-hover table-bordered">
<thead>
<tr>
<th> ID </th>  <!-- table heading -->
<th>User </th>
<th> Categories </th>    
<th> Actions </th> 
<th> Update </th>
</tr>
</thead>
<tbody>

<?php 
$sql = "SELECT * FROM categories ORDER BY cat_id ASC"; //displaying the categories from the database to the table
$selectCat = mysqli_query($con, $sql);          
    while($row = mysqli_fetch_assoc($selectCat)){ //displaying the categories on the table
        $cat_id = $row['cat_id'];
        $cat_user = $row['cat_user'];
        $cat_title = $row['cat_title'];
        
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_user}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('are you sure you want to delete');\" href='categories.php?delete={$cat_id}'>Delete </a></td>";
        echo "<td><a class='btn btn-info' href='dashboard_categories.php?edit={$cat_id}'>Edit </a></td>";
        echo "</tr>";
    }

?>    

<?php deleteCAt();  ?>  <!-- function delete categories -->                               
</tbody>
</table>
</div>

</div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include('includes/admin_footer.php') ?>