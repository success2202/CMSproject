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
                $sql = " SELECT * FROM posts";
                $selectPost = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($selectPost)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0,100);
                    $post_status = $row['post_status'];
                   
                    if($post_status == 'published'){
                        
                    

                    ?>

                <h1 class="page-header">
                    My Bloging Content
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                   
                    <a href="post.php?p_id=<?php echo $post_id ?>">
                    <?= $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="autho_post.php?author=<?=$post_author ?>&p_id=<?=$post_id ?>"><?=$post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?=$post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?=$post_id?>">
                <img class="img-responsive" src="images/<?=$post_image ?>" alt="">
                </a>
                <hr>
                <p> <?=$post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?=$post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

               <?php }   }
                    ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
           

            <?php include('includes/sideBar.php'); ?>



        </div>
        <!-- /.row -->

        <hr>

        <?php include('includes/footer.php'); ?>