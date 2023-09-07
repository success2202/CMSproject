<br> <br> <br>
<div class="col-md-4">



<!-- login -->
<div class="well">

<?php if(isset($_SESSION['user_role'])): ?>
   <a style="text-decoration:none; text-align:center" href="#"> <i class="fa fa-fw fa-user"> <?php echo $_SESSION['username'] ?> </i> </a>&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;<a href="admin/includes/logout.php"  class="btn btn-primary">logout</a>
    <?php else: ?>
        <!-- login form   -->
        <h5 style="text-align:center">login</h5>
            <form action="includes/login.php" method="POST">

            <div class="form-group">
            <input type="text" name="username" class="form-control" autocomplete="on" placeholder = "enter your username">
            </div>

            <div class="input-group">
            <input type="password" name="password" class="form-control" placeholder = "enter your password">

            <span class="input-group-btn">
            <button class="btn btn-primary" name="login" type="submit">Login</button>
            </span>
            </div>
<br>
            <div class="form-group">
                 <a href="/cms/forgot.php?forgot=<?= uniqid(true); ?>">Forgot Password</a>  &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                 <a href="/cms/registration."> Register</a>
            </div>
            
            </form><!-- login form   -->
            <!-- /.input-group -->
     <?php endif; ?>

    
</div>



<!-- Blog Search Well -->
<div class="well">
    <!-- <center><h4>Search</h4></center> -->
<form action="search.php" method="POST">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="serach for love messsages...">
        <span class="input-group-btn">
            <button name= "submit" class="btn btn-primary" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form><!-- search form   -->
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">

        <?php 
        $sql = "SELECT * FROM categories";
        $selectACatSidebar = mysqli_query($con, $sql);
        ?>
    
    <center><h2 class="contentContainer" style="color:white; background-color:#a51a1a; padding:2px" class="page-header">Message Categories</h2></center>
   
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <div class="contentContainer">
            <?php 
            while($row = mysqli_fetch_assoc($selectACatSidebar)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<div class='contentContainer'> <li> <a href='/cms/category.php?category=$cat_id'>{$cat_title} </a> </li> </div>";
                
            }
            ?>
            </div>

            </ul>
        </div>
        
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php include('wiget.php'); ?>

</div>