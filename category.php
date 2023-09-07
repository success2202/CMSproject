<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

    <!-- Navigation -->
    <?php include('includes/navigation.php'); ?>
<br> <br>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 
                if(isset($_GET['category'])){
                    $post_category_id = $_GET['category'];

                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                        $sql = " SELECT * FROM posts WHERE post_cat_id = $post_category_id ";
                    }else{
                        $sql = " SELECT * FROM posts WHERE post_cat_id = $post_category_id AND post_status = 'published'";
                    }
   
                $selectPost = mysqli_query($con, $sql);

                    if(mysqli_num_rows($selectPost) < 1){
                        
                        echo "<h2 class='text-center'>No Categories Available </h2>";

                    }else{

                while($row = mysqli_fetch_assoc($selectPost)){
                    $post_id = $row['post_id'];
                    $post_heading = $row['post_heading'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0,500);
                   
                    ?>
<br>
                <div  class="form-group">
                <center>
                <h2 style="color:white; background-color:#a51a1a; padding:2px" class="page-header contentContainer">
                    <?= $post_heading ?>
                </h2>
                </center>
                </div>

                <!-- First Blog Post -->
                
                <h2 style="text-align:center;">
                    <a href="post.php?p_id=<?php echo $post_id ?>">
                    <?= $post_title ?></a>
                </h2>
               
                
                <p class="lead">
                    <i> by <a href=""><?=$post_author ?></a> </i>
                </p>
                <p><small><span class="glyphicon glyphicon-time"></span><?=$post_date ?></small></p>
                <hr>
                <a href="post.php?p_id=<?=$post_id?> ">
                <img  class="img-responsive" src="images/<?=imagePlaceHolder($post_image) ?>" alt="">
                </a>
                <hr>
                <div class="contentContainer">
                <p> <?=$post_content ?> </p>
                <a class="btn btn-primary" href="/cms/post.php?p_id=<?php echo $post_id ?> "> Read More <span class="glyphicon glyphicon-chevron-right"> </span> </a>
            </div>
                <hr>

               <?php }} }else{

                    header('location:index.php');

               }
                    ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           

            <?php include('includes/sideBar.php'); ?>



        </div>
        <!-- /.row -->

        <hr>

        <?php include('includes/footer.php'); ?>