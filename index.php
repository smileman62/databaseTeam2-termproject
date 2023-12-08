/*
    This php code is main twitter index.
    If you are not logged in, go to the login page, and if you are logged in, get tweet info.
*/

<?php require_once "header.php"; ?>

<?php
session_start();

if(!isset($_SESSION['user_id'])) {
    echo "<script>location.replace('login.php');</script>";            
}
    
else {
    $user_id = $_SESSION['user_id'];
    $usernickname = $_SESSION['nickname'];
    $user_profile = $_SESSION['profile_image'];
}
?>

<?php
if(isset($_POST['btn_add_post']))
{
    $Post_Text = $_POST['post_text'];

    if($Post_Text != ""){
        $sql = "INSERT INTO article (user_id, post_date, post_content) VALUES($user_id, now(),'$Post_Text')";
        $result = mysqli_query($con,$sql);
    }
}
?>

<?php
    if(isset($_GET['del']))
    {
        $Del_ID = $_GET['del'];
        $sql = "DELETE FROM article where post_id = '$Del_ID'";
        $post_query = mysqli_query($con,$sql);

        if($sql)
        {
            header("location: index.php");
        }
    }
?>

<div class="grid-container">

<?php require_once "left-sidebar.php"; ?>

<div class="main">
    <p class="page_title">홈</p>

    <div class="tweet_box tweet_add">
        <div class="tweet_left">
            <img src = "images/<?php if($user_profile != ''){echo $user_profile;} else{echo "non-profile.png";}?>" alt="">
        </div>

        <div class = "tweet_body">
            <form method = "post" enctype = "multipart/form-data">
                <textarea name="post_text" id= "" cols="100%" rows="3" placeholder="무슨 일이 일어나고 있나요?"></textarea>
            
                <div class="tweet_icons-wrapper">
                    <div class = "tweet_icons-add">
                        <i class = "far fa-image"></i>
                        <i class = "far fa-chart-bar"></i>
                        <i class = "far fa-smile"></i>
                        <i class = "far fa-calendar-alt"></i>
                    </div>
            
                    <button class="button_tweet" type="submit" name="btn_add_post">트윗</button>
                </div>            
            </form>
        </div>
    </div>
      
    <?php require_once "tweet.php"; ?>

</div>    

<?php require_once "right-sidebar.php"; ?>

</div>

</body>
</html>