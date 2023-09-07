<?php include('includes/header.php'); ?>
<?php include('includes/db.php'); ?>

    <!-- Navigation -->
    <?php include('includes/navigation.php'); ?>
<br> <br> <br> 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 
//getting the page request ['page'] count for pagination
$per_page = 5;

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page="";
}
if($page == "" ||$page ==1){
    $page_1 =0;
}else{
    $page_1 =($page * $per_page) - $per_page;
}


if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
    $sql = " SELECT * FROM posts";
}else{
    $sql = " SELECT * FROM posts WHERE post_status = 'published'";
}

//getting the page count and round it up and divide by a number 
//depending on how many pages you want to displayfor pagination
        $find_count = mysqli_query($con, $sql);
        $count = mysqli_num_rows($find_count);
        if($count < 1){
           
            echo "<h2 class='text-center'>No Post Available </h2>";

        }else{

        $count =ceil($count/$per_page);
        //$count =ceil($count/5);


                $sql = " SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, $per_page";
                $selectPost = mysqli_query($con, $sql);
                while($row = mysqli_fetch_assoc($selectPost)){
                    $post_id = $row['post_id'];
                    $post_heading = $row['post_heading'];
                    $post_title = $row['post_title'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0,500);
                    $post_status = $row['post_status'];
                                     
                    ?>
                     
                     <div  class="form-group">
                <center>
                <h2 style="color:white; background-color:#a51a1a; padding:2px" class="page-header contentContainer">
                    <?= $post_heading ?>
                </h2>
                </center>
                </div>
                <!-- First Blog Post -->
                <h2 style="text-align:center; color:red">
                    <a href="post.php?p_id=<?php echo $post_id ?>">
                    <?= $post_title ?></a>
                </h2>
                
                <p class="lead">
                <i> by  <a href="autho_post.php?user=<?=$post_user ?>&p_id=<?=$post_id ?>"><?=$post_user ?></a> </i>
                </p>
                <p><small <span class="glyphicon glyphicon-time"> </span> <?=$post_date ?>  </small> </p>
                <hr>
                <a href="post.php?p_id=<?=$post_id?>">
                <img class="img-responsive" src="images/<?=imagePlaceHolder($post_image)  ?>" alt="">
                </a>
                <hr>
                <div class="contentContainer"> 
                <p> <?=$post_content ?> </p> 
                <a class="btn btn-primary" href="post.php?p_id=<?= $post_id ?> "> Read More <span class="glyphicon glyphicon-chevron-right"> </span> </a> 
            </div>
                <hr>
               <?php }}
                    ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('includes/sideBar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>
        <!-- pagination section -->
        <ul class="pager">
            <?php
            for($i=1; $i<= $count; $i++){
                if($i ==$page){
                    echo "<li '><a class='active_link' href='index.php?page={$i}'>{$i}</a>";
                }else{
                    echo "<li '><a href='index.php?page={$i}'>{$i}</a>";
                }
                
            }
            ?>
        </ul> 

        <?php include('includes/footer.php'); ?>