/*
    This php code delete follow record.
*/

<?php
    session_start();

    $user_id_profile = $_GET['profile_id'];
    $user_id = $_SESSION['user_id'];

    $con = mysqli_connect("localhost","root","12345","database-twitter");
    $query = "DELETE FROM follow WHERE following_id = $user_id_profile AND follower_id = $user_id";
    $result = mysqli_query($con,$query);

    echo "<script>history.go(-1)</script>";
?>