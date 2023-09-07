<?php
//DATABASE HELPER FUNCTTIONS
//REDIRECT
function redirect($location){
    return header("location: . $location");
    exit;
    }
//query
function query($query){
    global $con;
    $result= mysqli_query($con, $query);
    checkquerry($result);
    return $result;
}
function fetchRecords($result){
    return mysqli_fetch_array($result);
}
//END DATABASE HELPER

//GENERAL HELPER
function get_user_name(){
    return isset($_SESSION['username'])? $_SESSION['username']: null;
}


//AUTHENTICATION HELPER

function is_Admin(){
    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id=".$_SESSION['user_id']."");
        $row = fetchRecords($result);
        if($row['user_role'] == 'admin'){
            return true;
        }else{
            return false;
        }
    }
    return false; 
   
}

function is_Client(){
    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id=".$_SESSION['user_id']."");
        $row = fetchRecords($result);
        if($row['user_role'] == 'client'){
            return true;
        }else{
            return false;
        }
    }
    return false; 
   
}
//END OF AUTHENTIFICATION

//USER SPECIFIC HELPER
function get_All_User_post(){ 
    return query("SELECT * FROM posts WHERE user_id = ".loggedInUserId()."");
}
//END OF USER SPECIFIC HELPER

//checking if user is online
function users_online(){  
if(isset($_GET['onlineusers'])){
    global $con;
    if(!$con){
         session_start();
        include('../includes/db.php');

$session = session_id();
$time = time();
$time_out_in_seconds = 10;
$time_out = $time - $time_out_in_seconds;

$sql = "SELECT * FROM users_online WHERE sessionn = '$session'";
$online_user_query = mysqli_query($con, $sql);
$count = mysqli_num_rows($online_user_query);

        if($count == NULL){
            mysqli_query($con, "INSERT INTO users_online(sessionn, timee) VALUES('$session','$time')");

        }else{
            mysqli_query($con, "UPDATE users_online SET timee = '$time' WHERE sessionn = '$session'");
        }

        $user_online_query= mysqli_query($con, "SELECT * FROM users_online WHERE timee > '$time_out'");
        echo $count_user = mysqli_num_rows($user_online_query);

    }

}//get request onlineusers

}
users_online();

//confirm query
function checkquerry($result){
    global $con;
   if(!$result){
      die('QUERY FAILED' . mysqli_error($con));
   }
}

//add catrgory
function insert_category(){
    global $con;
if(isset($_POST['submit2'])){ //checking the input category
    //echo "welcome";
    $cat_user = $_POST['cat_user'];
      $cat_title = $_POST['cat_title'];
      
      if($cat_title== "" || empty($cat_title)){
        echo "please input a valid data";
      }else{

    $sql2 = "INSERT INTO categories(cat_user, cat_title ) "; //adding categories to table and databse
    $sql2 .= "VALUE('{$cat_user}', '{$cat_title}') ";
              
    $add_cat = mysqli_query($con, $sql2);
    
    if(!$add_cat){
       die('QUERY FAILED' . mysqli_error($con));

    }
   
}
 }
}

function findAllcat(){
    $user=$_SESSION['username'];
global $con;
$sql = "SELECT * FROM categories WHERE cat_user ='{$user}'"; //displaying the categories from the database to the table
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
        echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit </a></td>";
        echo "</tr>";
    }
}


//delete category
function deleteCAt(){
    global $con;
    if(isset($_GET['delete'])){
        $del_cat = $_GET['delete'];
        $sql = "DELETE FROM categories WHERE cat_id = {$del_cat}";
        $chek = mysqli_query($con,$sql);
        if($chek){
        header('location: categories.php');
        }
            }
}



// function getUser($username){
//     global $con;
    
    
//         $sql = "SELECT * FROM users WHERE username = '{$usernmame}' LIMIT 1";
//         $check = mysqli_query($con, $sql);
//         $Ucheck = mysqli_num_rows($check);
//         if($Ucheck){
//             $_SESSION ['username'] = "this username has been taken";
//         }
//         return $Ucheck;
// }

//main dashboard count all records
function count_User_Records($table){
    global $con;
    $sql = "SELECT * FROM .$table";
$select_all_post = mysqli_query($con, $sql);
$result=mysqli_num_rows($select_all_post);
checkquerry($result);
return $result;

}

// user data count user record
function recordCount($table, $column, $user){
    global $con;
    $sql = "SELECT * FROM $table WHERE $column = '$user'";
$select_all_post = mysqli_query($con, $sql);
$result=mysqli_num_rows($select_all_post);

if($result >0){
    return $result;
}else{
        return false;
    }
checkquerry($result);

}

//check all status main dashboard
function checkStatus($table, $column, $status){
    global $con;
    
    $sql = "SELECT * FROM $table WHERE $column = '$status'";
$result = mysqli_query($con, $sql);
checkquerry($result);
return mysqli_num_rows($result);

}


//check user status=published
function Check_Status(){
    global $con;
    $user=$_SESSION['username'];
    $sql = "SELECT * FROM posts WHERE post_status = 'published' AND post_user = '$user'";
$result = mysqli_query($con, $sql);
checkquerry($result);
return mysqli_num_rows($result);

}

//check user status=draftes 
function Check_Status2(){
    global $con;
    $user=$_SESSION['username'];
    $sql = "SELECT * FROM posts WHERE post_status = 'drafted' AND post_user = '$user'";
$result = mysqli_query($con, $sql);
checkquerry($result);
return mysqli_num_rows($result);

}

//check user approved comment 
function Check_comment(){
    global $con;
    $user=$_SESSION['username'];
    $sql = "SELECT * FROM comments WHERE comment_status = 'approved' AND comment_author = '$user'";
$result = mysqli_query($con, $sql);
checkquerry($result);
return mysqli_num_rows($result);

}

//check unapproved comment user data
function Check_comment2(){
    global $con;
    $user=$_SESSION['username'];
    $sql = "SELECT * FROM comments WHERE comment_status = 'unapproved' AND comment_author = '$user'";
$result = mysqli_query($con, $sql);
checkquerry($result);
return mysqli_num_rows($result);

}

//check all role main dashboard
function checkRole($table, $column, $role){
    global $con;
    $sql = "SELECT * FROM $table WHERE $column = '$role'";
    $result = mysqli_query($con, $sql);
    checkquerry($result);
    return mysqli_num_rows($result);
}


//check all comment main dashboard
function checkComment($table, $column, $comment){
    global $con;
    $sql = "SELECT * FROM $table WHERE $column = '$comment'";
    $result = mysqli_query($con, $sql);
    checkquerry($result);
    return mysqli_num_rows($result);
}


//checking if username exist
function username_exist($username){
    global $con;
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql); 
    checkquerry($result);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}


function ifItisMethod($method=NULL){
if($_SERVER['REQUEST_METHOD']== strtoupper($method)){
    return true;
}
return false;
}

function isLoggedIn(){
if(isset($_SESSION['user_role'])){
    return true;
}
    return false;
}


//getting the logged in user_id
function loggedInUserId(){
if(isLoggedIn()){
    $result=query("SELECT * FROM users WHERE username='" .$_SESSION['username'] ."'");
    checkquerry($result);
    $user = mysqli_fetch_array($result);
    return mysqli_num_rows($result)>=1 ? $user['user_id'] : false;  
}
    return false;
}

//checking the user that like the post 
function userLikeThisPost($post_id){
   $result =  query("SELECT * FROM likes WHERE user_id =" .loggedInUserId() . " AND post_id={$post_id}");
   checkquerry($result);
   return mysqli_num_rows($result) >= 1 ? true : false;
}


//count post likes
function getPostLikes($post_id){
$result = query("SELECT * FROM likes where post_id={$post_id}");
checkquerry($result);
echo mysqli_num_rows($result);
}

//checking if user is logged in and redirect 
function checkIfUserIsLoggedInAndRedriect($redirectLocation=NULL){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }

}

//login user
function login_user($username, $password){
    global $con;
    $username = $_POST['username'];
    $password = $_POST['password'];

     $username = trim($username);  
     $password = trim($password);

     $username = mysqli_real_escape_string($con, $username);
     $password = mysqli_real_escape_string($con, $password);


     $query = "SELECT * FROM users WHERE username = '{$username}' ";
     $select_user_query = mysqli_query($con, $query);
     if (!$select_user_query) {

         die("QUERY FAILED" . mysqli_error($con));
     }
     while ($row = mysqli_fetch_array($select_user_query)) {

         $db_user_id = $row['user_id'];
         $db_username = $row['username'];
         $db_user_password = $row['user_password'];
         $db_user_firstname = $row['user_firstname'];
         $db_user_lastname = $row['user_lastname'];
         $db_user_role = $row['user_role'];


         if (password_verify($password,$db_user_password)) {
            $_SESSION['user_id'] = $db_user_id;
             $_SESSION['username'] = $db_username;
             $_SESSION['firstname'] = $db_user_firstname;
             $_SESSION['lastname'] = $db_user_lastname;
             $_SESSION['user_role'] = $db_user_role;

          return true;

         } else {

            return false;

         }

     }

     

 }

//checking if email already exist 
function email_exist($email){
    global $con;
    $sql = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($con, $sql); 
    checkquerry($result);
    if(mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

//image place holder
function imagePlaceHolder($image=''){
if(!$image){
    return 'image_1.jpg';
}else{
    return $image;
}
}



?>