<form action="" method="POST"> <!-- edit category form -->
<div class="form-group">
<label for="cat_title">Edit Category</label>

<?php

if(isset($_GET['edit'])){ //get edit id 
$cat_id =$_GET['edit'];

$sql = "SELECT * FROM categories WHERE cat_id = $cat_id"; //displaying edit categories from the database
$selectCat_Edit = mysqli_query($con, $sql);
while($row = mysqli_fetch_assoc($selectCat_Edit)){ //displaying edit categories on the form
$cat_id = $row['cat_id'];
$cat_user = $row['cat_user'];
$cat_title = $row['cat_title'];

?>

<input type="text" value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" name="cat_title">
<div class="form-group">
<label for="username">User</label>
<input type="text" class="form-control" name="cat_user" value="<?=$cat_user ?>">
</div>

<?php }}  ?> 
                                    

<?php
//update category function 
if(isset($_POST['update_cat'])){
$update_cat_title = $_POST['cat_title'];
$update_cat_user = $_POST['cat_user'];
$sql = "UPDATE categories 
        SET cat_title = '{$update_cat_title}', cat_user = '{$update_cat_user}'  WHERE cat_id = {$cat_id} ";
$chekupdate = mysqli_query($con,$sql);
if(!$chekupdate){
    die("QUERY FAILED" . mysqli_error($con));
}
              }
?>

</div>
                    
<div class="form-group">
<input class="btn btn-primary" type="submit" name="update_cat" value="Update Category">
</div>
                  
</form>
