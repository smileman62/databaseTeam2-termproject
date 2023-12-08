/*
    This php code load following user's and my tweet
*/

<?php

session_start();

$userid = $_SESSION['user_id'];

$query_tweet = "SELECT * FROM ((select a.post_id, a.user_id, a.post_date, a.post_content, a.image_info, a.retweet_post_id from follow as f join article as a ON (f.follower_id = $userid AND f.following_id = a.user_id))
UNION (select * from article as a where a.user_id = $userid)) AS B
ORDER BY post_id DESC;"; // view 로 join 문 짜서 불러오기

$data_tweet = mysqli_query($con,$query_tweet);

while($row = mysqli_fetch_assoc($data_tweet)) // After query, get user's info
{
    $post_user_id = $row['user_id'];
    $post_content = $row['post_content'];
    $post_date = $row['post_date'];

    $query_post_nickname = "SELECT * FROM user_info WHERE user_id = $post_user_id";
    $nickname_data = mysqli_query($con,$query_post_nickname);
    $nickname_row = mysqli_fetch_assoc($nickname_data);

    $post_user_nickname = $nickname_row['nickname'];
    $post_user_profile = $nickname_row['profile_image'];

?>

<div class = "tweet_box">
    <div class="tweet_left">
        <img src="images/<?php if($post_user_profile){echo $post_user_profile;} else{echo "non-profile.png";} ?>" alt="">
    </div>
    <div class = "tweet_body">
        <div class = "tweet_header">
            <p class = "tweet_name"><?php echo $post_user_nickname; ?></p>
            <p class = "tweet_username">@<?php echo $post_user_id; ?></p>
            <p class = "tweet_date"><?php echo $post_date = date("M d"); ?></p>
        </div>

        <p class = "tweet_text"><?php echo $post_content; ?></p>

        <div class = "tweet_icons">
            <a href=""><i class="far fa-comment"></i></a>
            <a href=""><i class="fa fa-reply"></i></a>
            <a href=""><i class="far fa-heart"></i></a>
            <a href=""><i class="fa fa-upload"></i></a>
            <a href=""><i class="far fa-chart-bar"></i></a>
        </div>
    </div>

    <div class="tweet_del">
        <div class="dropdown">
            <button class = "dropbtn"><span class="fa fa-ellipsis-h"></span></button>
            <div class ="dropdown-content">
                <a href="index.php?del=<?php echo $row['post_id']; ?>"><i class = "far fa-trash-alt"></i><span>삭제</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
}
?>