/*
    This php code create new account.
    If same nickname is already exists in database, it fail to create new account.
    Else, create new account

*/

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>check_signup</title>
</head>
<body>
   <?php
    session_start(); // using session.
    $con = mysqli_connect("localhost","root","12345","database-twitter");
    
    // Inputed id, password from login.php
    $usernickname = $_POST['nickname'];
    $userpass = $_POST['pw'];
    
    // Search 
    $q = "SELECT * FROM user_info WHERE nickname = '$usernickname'";
    $result = mysqli_query($con,$q);
    $row = mysqli_fetch_array($result);
    
    //결과가 존재하면 세션 생성 거부
    if ($row != null) {
        echo "<script>alert('Inputed nickname already exists.')</script>";
        echo "<script>location.replace('login.php');</script>";
        exit;
    }
      
    //결과가 존재하지 않으면 계정 생성 후 로그인
    if($row == null){
        $q = "INSERT INTO user_info (password, nickname) VALUES ('$userpass', '$usernickname')";
        $result = mysqli_query($con,$q);
        
        $q = "SELECT * FROM user_info WHERE password = '$userpass' AND nickname = '$usernickname'";
        $result = mysqli_query($con,$q);
        $row = mysqli_fetch_array($result);

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['nickname'] = $row['nickname'];
        $_SESSION['profile_image'] = $row['profile_image'];
        
        $new_id = $_SESSION['user_id'];

        $q = "INSERT INTO user_identification (user_id) VALUES ($_new_id)";
        $result = mysqli_query($con,$q);

        echo "<script>location.replace('index.php');</script>";
        exit;
    }
    ?>
</body>