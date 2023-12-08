/*
    This php code is profile page index.
    Can check user's profile.

<?php
    session_start();

    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["nickname"];
    $user_profile = $_SESSION['profile_image'];

    $con = mysqli_connect("localhost","root","12345","database-twitter");


    if(isset($_GET['del']))
    {
        $Del_ID = $_GET['del'];
        $sql = "DELETE FROM article where post_id = '$Del_ID'";
        $post_query = mysqli_query($con,$sql);

        header("location: profile-index.php?search=$user_name");
    }

?>


<?php

    if(isset($_GET["search"])){
    $profile_user = $_GET['search'];
    
    $query_profile = "SELECT * FROM user_info WHERE nickname = '$profile_user'";
    $data_profile = mysqli_query($con, $query_profile);
    $row = mysqli_fetch_assoc($data_profile);

    $user_id_profile = $row["user_id"];
    $nickname_profile = $row["nickname"];
    $introduction_profile = $row["introduction"];
    $profile_image_profile = $row["profile_image"];
    $background_image_profile = $row["background_image"];
    
    if(!isset($nickname_profile)){
        echo "<script>alert('This account does not exist')</script>";
        echo "<script>history.back()</script>";
    }
    }
    
    # Get number of tweet, follower, following 

    $query_profile = "SELECT * FROM follow WHERE following_id = $user_id_profile AND follower_id = $user_id";
    $data_profile = mysqli_query($con, $query_profile);
    if($row = mysqli_fetch_assoc($data_profile)){
        $follwing = true;
    }
    else{
        $follwing = false;
    }

    $query_profile = "SELECT count(post_id) as tweet_num FROM article WHERE user_id = $user_id_profile";
    $data_profile = mysqli_query($con, $query_profile);
    $row = mysqli_fetch_assoc($data_profile);
    
    $tweet_number = $row['tweet_num'];

    $query_profile = "SELECT count(follower_id) as follower_num FROM follow WHERE follower_id = $user_id_profile";
    $data_profile = mysqli_query($con, $query_profile);
    $row = mysqli_fetch_assoc($data_profile);

    $follower_num = $row["follower_num"];

    $query_profile = "SELECT count(following_id) as following_num FROM follow WHERE following_id = $user_id_profile";
    $data_profile = mysqli_query($con, $query_profile);
    $row = mysqli_fetch_assoc($data_profile);

    $following_num = $row["following_num"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Twitter Profile</title>
    <script src="https://kit.fontawesome.com/94747f9244.js" crossorigin="anonymous"></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href="css/tweet-box.css">
    <link rel='stylesheet' type='text/css' media='screen' href='css/twitterprofile.css'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class = profile-grid>
    <a href="#totop" class="fa fa-arrow-up" id="fixedarrow"></a>
    <!-- <a href="#totop"><i class="fa fa-arrow-up" aria-hidden="true" id="fixedarrow"></i></a> -->
    <!-- LEFT VERTICAL FIXED MENU -->

    <div class="leftverticalmenu">
        <a href="index.php" class="fa fa-twitter" id="twittericon"></a>
        <ul>
            <li><a href="index.php"><i class="fa fa-home" id="icons"></i> Home</a></li>
            <li><a href="#"><i class="fa fa-hashtag" id="icons"></i> Explore</a></li>
            <li><a href="#"><i class="fa fa-bell" id="icons"></i> Notification</a></li>
            <li><a href="#"><i class="fa fa-envelope" id="icons"></i> Messages</a></li>
            <li><a href="#"><i class="fa fa-bookmark" id="icons"></i> Bookmarks</a></li>
            <li><a href="#"><i class="fa fa-list-alt" id="icons"></i> Lists</a></li>
            <li><a href="profile-index.php?search=<?php echo $user_name?>"><img src="images/<?php if(isset($user_profile)){echo $user_profile;} else{echo "non-profile.png";}?>" alt="profile"
                        class="profileimage">Profile</a></li>
            <li><a href="#"><i class="fa fa-align-center" id="icons"></i>More</a></li>
        </ul>
        <a href = "index.php"><figure> Tweet</figure></a>
    </div>

    <!-- END OF LEFT FIXED MENU -->

    <div class="flexcontainer">
        <div class="middlecontainer">
            <section class="headsec">
                <a href = "javascript:window.history.back();"><i class="fa fa-arrow-left" id="fa-arrow-left"></i></a>
                <div>
                    <h3><?php echo $nickname_profile?></h2>
                    <span><?php echo $tweet_number?> Tweets</span>
                </div>
            </section>
            <section class="twitterprofile">
                <div class="headerprofileimage">
                    <img src="images/<?php if(isset($background_image_profile)){echo $background_image_profile;} else{echo "non-background.png";}?>" alt="header" id="headerimage">
                    <img src="images/<?php if(isset($profile_image_profile)){echo $profile_image_profile;} else{echo "non-profile.png";}?>" alt="profile pic" id="profilepic">
                    
                    <?php
                    if($profile_user == $_SESSION['nickname']){
                        echo '<a href="profile-edit.php?profile_id=';
                        echo $user_id_profile;
                        echo '" class="editprofile">Edit Profile</a>';
                    }
                    
                    else{
                        if($follwing){
                            echo '<a href="unfollow.php?profile_id=';
                            echo $user_id_profile;
                            echo '" class="unFollow">unfollow</a>';
                        }

                        else{
                            echo '<a href="dofollow.php?profile_id=';
                            echo $user_id_profile;
                            echo '" class="doFollow">follow</a>';
                        }
                    }
                    ?>

                </div>
                <div class="bio">
                    <div class="handle">
                        <h3><?php echo $nickname_profile?></h3>
                        <span>@<?php echo $user_id_profile?></span>
                    </div>
                    <p><?php echo $introduction_profile?></p>
                </div>

                <div class="nawa">
                    <div class="followers" id="followingCount"><?php echo $following_num?> <a href = "follow.php?profile-user-id=<?php echo $user_id_profile?>">Following</a></div>
                    <div id="followerCount"><?php echo $follower_num?><a href = "follow.php?profile-user-id=<?php echo $user_id_profile?>"> Followers</a></div> 
                </div>
            </section>

            <section class="tweets">
                <div class="heading">
                    <p>Tweets</p>
                    <p>Tweets and Replies</p>
                    <p>Media</p>
                    <p>Likes</p>
                </div>
            </section>
            <section class="mytweets">
                <?php
                $query_tweet = "select * from article as a where a.user_id = $user_id_profile ORDER BY post_id DESC;"; // view 로 join 문 짜서 불러오기

                $data_tweet = mysqli_query($con,$query_tweet);

                while($row = mysqli_fetch_assoc($data_tweet)) // After query, get user's tweet
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
                        <img src="images/<?php if(isset($post_user_profile)){echo $post_user_profile;} else{echo "non-profile.png";} ?>" alt="">
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
                                <a href="profile-index.php?del=<?php echo $row['post_id']; ?>"><i class = "far fa-trash-alt"></i><span>삭제</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <?php
                }
                ?>    
                </div>
            </section>
        </div>

        <!-- RIGHT CONTAINER -->

        <div class="rightcontainer">
            <section class="searchbar">
                <form action="profile-index.php" method = "get">
                    <button type ="submit" class="search-btn" value="Submit">
                        <div class="searchicon"><i class="fa fa-search" aria-hidden="true"></i></div>
                    </button>
                    <input type="text" name="search" id="searchbox" placeholder="Search Twitter">
                </form>
            </section>

            <section class="nigeriatrends">
                <div class="headertrends">
                    <h2>Korean Trends</h2>
                    <i class="fa fa-cog" id="fa-cog"></i>
                </div>
                <div class="trenditem">
                    <div class="trending"> 1 Trending</div>
                    <div class="hashtag"> Segun Olanitori</div>
                    <div class="trending"> 9054767 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 2 Trending</div>
                    <div class="hashtag"> Olanitori Olusegun</div>
                    <div class="trending"> 104767 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 3 Trending</div>
                    <div class="hashtag"> Segun</div>
                    <div class="trending"> 97367 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 4 Trending</div>
                    <div class="hashtag"> #Loremipsum</div>
                    <div class="trending"> 84767 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 5 Trending</div>
                    <div class="hashtag"> Olanitori </div>
                    <div class="trending"> 7476 Tweetsg</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 6 Trending</div>
                    <div class="hashtag"> SegunOS</div>
                    <div class="trending"> 6477 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 7 Trending</div>
                    <div class="hashtag"> Segun_OS </div>
                    <div class="trending"> 54767 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 8 Trending</div>
                    <div class="hashtag"> Soy Segun</div>
                    <div class="trending"> 44762 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 9 Trending</div>
                    <div class="hashtag"> #Loremipsum</div>
                    <div class="trending"> 3476 Tweets</div>
                </div>
                <div class="trenditem">
                    <div class="trending"> 10 Trending</div>
                    <div class="hashtag"> #Loremipsum</div>
                    <div class="trending"> 247 Tweets</div>
                </div>
                <div class="showmore">
                    <a href="#" style="padding: 25px; color: royalblue;">Show more</a>
                </div>
            </section>

        </div>
    </div>
    </div>
</body>

</html>