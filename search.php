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


if(isset($_POST['submit'])){
    $search = $_POST['search'];

   $sql = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
   $checkSearch = mysqli_query($con, $sql);
   if(!$checkSearch){
    die("QUERY FAILED" . mysqli_error($con));
   }
   $count = mysqli_num_rows($checkSearch);

   if($count == 0){
    echo "<h1> No Result Found </h1>";
   }else{
    
                while($row = mysqli_fetch_assoc($checkSearch)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_heading = $row['post_heading'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                   
                    ?>
<br><br><br>

<div  class="form-group">
                <center>
                <h2 style="color:white; background-color:#a51a1a; padding:2px" class="page-header contentContainer">
                    <?= $post_heading ?>
                </h2>
                </center>
                </div>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?=$post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href=""><?=$post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?=$post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?=$post_image ?>" alt="">
                <hr>
                <p> <?=$post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               <?php }
                   
   }

}

?>      

            </div>

            <!-- Blog Sidebar Widgets Column -->
           

            <?php include('includes/sideBar.php'); ?>



        </div>
        <!-- /.row -->

        <hr>

        <?php include('includes/footer.php'); ?>