
<?php include('admin/function.php'); ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/index">HOME</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

        <?php 
        $sql = "SELECT * FROM categories";
        $selectAllCat = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($selectAllCat)){
            $catid = $row['cat_id'];
            $cat_title = $row['cat_title'];

            $category_class = '';
            $registration_class = '';
            
            $pageName = basename($_SERVER['PHP_SELF']);
            $registration = 'reistration.php';
            if(isset($_GET['category']) && $_GET['category'] == $catid){
                $category_class = 'active';
            }elseif($pageName == $registration){
                $registration_class = 'active';
            }
            
            echo "<li class='$category_class' ><a href='/cms/category.php?category={$catid}'> {$cat_title} </a></li>";
        }
        ?>
        
        <?php if(isLoggedIn()):  ?>

            <li>
                <a href="/cms/admin">ADMIN</a>
            </li>
            <li>
                <a href="/cms/admin/includes/logout.php">LOGOUT</a>
            </li>
        <?php else:  ?>

            <li>
                <a href='/cms/registration.php'>REGISTER</a>
            </li>

        <?php endif;  ?>
                    

                  <?php
                  //using the session to edit post
        if(isset($_SESSION['username'])){
            if(isset($_GET['p_id'])){
            $the_post_id = $_GET['p_id'];

            echo "<li><a href='/cms/admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
           
                   
            }
            
        }
                ?>
                  <li>
                        <a href="/cms/registration.php">REGISTER</a>
                    </li>

                    <li >
                        <a href="/cms/contact">CONTACT</a>
                    </li>
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>