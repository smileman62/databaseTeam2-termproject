/*
    let user follow another user.
*/

<?php
    session_start();

    $user_id_profile = $_GET['profile_id'];
    $user_id = $_SESSION['user_id'];

    $con = mysqli_connect("localhost","root","12345","database-twitter");
    $query = "INSERT INTO follow (following_id, follower_id) VALUES($user_id_profile,$user_id )";
    $result = mysqli_query($con,$query);

    echo "<script>history.go(-1)</script>";
?>