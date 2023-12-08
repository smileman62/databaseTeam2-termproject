/*
    This php code edit user's information.
*/

<?php
    session_start();

    $con = mysqli_connect("localhost","root","12345","database-twitter");

    $session_id = $_SESSION["user_id"];
    $changed_name = $_POST['nickname'];
    $changed_password = $_POST['password'];
    $changed_image = $_POST['profile_image'];
    $changed_introduction = $_POST['introduction'];

    $query = "SELECT * FROM user_info WHERE nickname = '$changed_name'";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);
    
    //결과가 존재하면 세션 생성 거부
    if ($row != null) {
        echo "<script>alert('Inputed nickname already exists.')</script>";
        echo "<script>location.replace('profile-edit.php');</script>";
        exit;
    }

    else{
        if($changed_name != ""){
            $query = "UPDATE user_info SET password = '$changed_password' WHERE user_id = session_id ";
            $result = mysqli_query($con,$query);
        }

        if($changed_password != ""){
            $query = "UPDATE user_info SET nickname = '$changed_name' WHERE user_id = session_id";
            $result = mysqli_query($con,$query);
        }

        if($changed_image != ""){
            $query = "UPDATE user_info SET profile_image = '$changed_image' WHERE user_id = session_id ";
            $result = mysqli_query($con,$query);
        }

        if($changed_introduction != ""){
            $query = "UPDATE user_info SET introduction = '$changed_introduction' WHERE user_id = session_id ";
            $result = mysqli_query($con,$query);
        }

        echo "<script>alert('Update complete!')</script>";
        echo "<script>location.replace('profile-index.php');</script>";
        exit;
    }
?>