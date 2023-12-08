/*
    This php code check inputed id and password.
    If there is id and password in database, it creates session for user.
    Else, alert to user and return to login.php

*/

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>check_login</title>
</head>
<body>
   <?php
    session_start(); // using session.
    $con = mysqli_connect("localhost","root","12345","database-twitter");
    
    //Inputed id, password from login.php
    $usernickname = $_POST['nickname'];
    $userpass = $_POST['pw'];
      
    // check if nickname and password exists.
    $q = "SELECT * FROM user_info WHERE password = '$userpass' AND nickname = '$usernickname'";
    $result = mysqli_query($con,$q);
    $row = mysqli_fetch_array($result);
    
    //If there is account, create session
    if ($row != null) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['nickname'] = $row['nickname'];
        $_SESSION['profile_image'] = $row['profile_image'];
        echo "<script>location.replace('index.php');</script>";
        exit;
    }
      
    //Else, fail to login.
    if($row == null){
        echo "<script>alert('Invalid username or password')</script>";
        echo "<script>location.replace('login.php');</script>";
        exit;
    }
    ?>
</body>