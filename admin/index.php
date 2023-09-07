
<?php include('includes/admin_header.php') ?>

<?php if($con){
echo " connection valid";
}
?>

    <div id="wrapper">

        <!-- Navigation -->

        <?php include('includes/admin_navigation.php') ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header" style="color:blue text-align:center">
                              My Admin
                          
                            <small><?php echo strtoupper(get_user_name()); ?></small>
                        </h1>
                    </div>
                </div> 
                
                <!-- /.row -->
                <div class="row">
    <div class="col-lg-5 col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

    <!-- this fetch posts and  count the number of post                 -->

<!-- // $sql = "SELECT * FROM posts";
// $select_all_post = mysqli_query($con, $sql);
// $post_count = mysqli_num_rows($select_all_post);
 $post_count = recordCount('posts'); -->
 <!-- display number of pages -->

 <div class='huge'><?php echo $post_count = recordCount('posts', 'post_user', $_SESSION['username']); ?></div> 
 

                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    
    <div class="col-lg-5 col-md-8">
        <div class="panel panel-red">
        
            <div class="panel-heading">
            
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                   
                    <div class="col-xs-9 text-right">
<!-- display and count number of categories -->
<div class='huge'><?php echo $category_count = recordCount('categories','cat_user', $_SESSION['username']); ?></div> 
                        
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

 <!-- /.row -->
 
<?php 
// $sql = "SELECT * FROM posts WHERE post_status = 'published'";
// $select_published_post = mysqli_query($con, $sql);
// $published_post_count = mysqli_num_rows($select_published_post);

$published_post_count = Check_Status(); // this is a function that check status 

// // $sql = "SELECT * FROM posts WHERE post_status = 'drafted'";
// // $select_draft_post = mysqli_query($con, $sql);
// // $draft_post_count = mysqli_num_rows($select_draft_post);

$draft_post_count = Check_Status2();

// // $sql = "SELECT * FROM comments WHERE comment_status = 'approved'";
// // $select_approved_comment = mysqli_query($con, $sql);
// // $approved_comment_count = mysqli_num_rows($select_approved_comment);

// $approved_comment_count = Check_comment();

// // $sql = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
// // $select_unapproved_comment = mysqli_query($con, $sql);
// // $unapproved_comment_count = mysqli_num_rows($select_unapproved_comment);

// $unapproved_comment_count = Check_comment2();

// $sql = "SELECT * FROM users WHERE user_role = 'subscriber'";
// $select_subscribe_user = mysqli_query($con, $sql);
// $subscribe_user_count = mysqli_num_rows($select_subscribe_user);

// $subscribe_user_count = checkRole('users', 'user_role', 'subscriber');

// $sql = "SELECT * FROM users WHERE user_role = 'admin'";
// $select_admin_user = mysqli_query($con, $sql);
// $admin_user_count = mysqli_num_rows($select_admin_user);

// $admin_user_count = checkRole('users', 'user_role', 'admin');

// $sql = "SELECT * FROM categories WHERE user_role = 'subscriber'";
// $select_subscribe_user = mysqli_query($con, $sql);
// $subscribe_user_count = mysqli_num_rows($select_subscribe_user);

?>

<!-- displaying the chat  -->
<div class="row">
 <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Data', 'Count'],

    <?php 
        $element_text = ['Active Posts',  'Categories', 'Published Post', 'Draft Post'];
        $element_count = [$post_count, $category_count, $published_post_count, $draft_post_count];
        // looping the element text and count
        for($i =0;$i <4;  $i++) {
        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
        }

    ?>
        // ['Posts', 1000],

        ]);

        var options = {
        chart: {
        title: '',
        subtitle: '',
        }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
        }
 </script>
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>

            
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include('includes/admin_footer.php') ?> v