/*
    This php code show follow relation.
*/


<?php
    session_start();

    $con = mysqli_connect("localhost","root","12345","database-twitter");

    $profile_user_id = $_GET['profile-user-id'];
    $query32 = "SELECT * FROM user_info WHERE user_id = $profile_user_id";
    $result = mysqli_query($con,$query32);
    $row32 = mysqli_fetch_array($result);

    $profile_user_nickname = $row32["nickname"];

    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['nickname'];

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/follower.css">
    <script src="https://kit.fontawesome.com/94747f9244.js" crossorigin="anonymous"></script>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href="css/tweet-box.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <div class="profile-header">
    <a href = "javascript:window.history.back();"><i class="fa fa-arrow-left" id="fa-arrow-left"></i></a>
    <div class="user-info">
      <div class="username"><?php echo $profile_user_nickname;?></div>
      <div class="user-handle">@<?php echo $profile_user_id;?></div>
    </div>
  </div>
  <div class="tabs">
    <div class="tab selected" id="followersTab">Followers</div>
    <div class="tab" id="followingTab">Following</div>
  </div>
  <div class="followers-list" id="followersList" style = "display:block;"> 
    
    <?php

    $con = mysqli_connect("localhost","root","12345","database-twitter");

    $following_query = "SELECT * from (SELECT * FROM follow WHERE following_id = $profile_user_id) as a left join user_info as u ON a.follower_id = u.user_id ORDER BY follow_id;"; // 팔로워들
    $following_data = mysqli_query($con,$following_query);

    while($row = mysqli_fetch_assoc($following_data)) // After query, get user's info
        {
        $follower_user_id = $row['user_id'];
        $follower_user_nickname = $row['nickname'];
        $follower_user_introduction = $row['introduction'];
        $follower_user_profile_image = $row['profile_image'];

        $query_profile = "SELECT * FROM follow WHERE following_id = $profile_user_id AND follower_id = $user_id";
        $data_profile = mysqli_query($con, $query_profile);
        
        if($row = mysqli_fetch_assoc($data_profile)){
            $follwing = true;
        }
        else{
            $follwing = false;
        }

    ?>  

    <div class="follower">
        <div class="follower-info">
            <img src="images/<?php if($follower_user_profile_image){echo $follower_user_profile_image;} else {echo 'non-profile.png';} ?>" class="img" alt="">
            <div class="follower-details">
                <div class="follower-name"><?php echo $follower_user_nickname ?> <span class="verified-icon"></span></div>
                <div class="follower-handle">@<?php echo $follower_user_id ?></div>
                <div class="follower-bio"> <?php echo $follower_user_introduction ?> </div>
            </div>
        </div>
    </div>

    <?php
    }
    ?>

    </div>
    
    <div class="followers-list" id="followingList" style="display: none;"> 
        <?php
        $following_query = "SELECT * from (SELECT * FROM follow WHERE follower_id = $profile_user_id) as a left join user_info as u ON a.following_id = u.user_id ORDER BY follow_id;"; // 팔로잉
        $following_data = mysqli_query($con,$following_query);

        while($row = mysqli_fetch_assoc($following_data)) // After query, get user's info
        {
            $following_user_id = $row['user_id'];
            $following_user_nickname = $row['nickname'];
            $following_user_introduction = $row['introuction'];
            $following_user_profile_image = $row['profile_image'];

            $query_profile = "SELECT * FROM follow WHERE following_id = $following_user_id AND follower_id = $user_id";
            $data_profile = mysqli_query($con, $query_profile);
        
            if($row = mysqli_fetch_assoc($data_profile)){
                $follwing = true;
            }
            else{
                $follwing = false;
            }

        ?>  

        <div class="follower">
            <div class="follower-info">
                <img src="images/<?php if($following_user_profile_image){echo $following_user_profile_image;} else {echo 'non-profile.png';} ?>" class="img" alt="">
                <div class="follower-details">
                    <div class="follower-name"><?php echo $following_user_nickname ?> <span class="verified-icon"></span></div>
                    <div class="follower-handle">@<?php echo $following_user_id ?></div>
                    <div class="follower-bio"> <?php echo $following_user_introduction ?> </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</body>
<script>
  document.getElementById('followersTab').addEventListener('click', function(){
    document.getElementById('followersTab').classList.add('selected');
    document.getElementById('followingTab').classList.remove('selected');
    document.getElementById('followersList').style.display = 'block';
    document.getElementById('followingList').style.display = 'none';
  });
  document.getElementById('followingTab').addEventListener('click', function(){
    document.getElementById('followingTab').classList.add('selected');
    document.getElementById('followersTab').classList.remove('selected');
    document.getElementById('followingList').style.display = 'block';
    document.getElementById('followersList').style.display = 'none';
  });
</script>
<script>
    function changeButtonStatus(button) {
      if (button.innerHTML === 'Follow') {
        button.innerHTML = 'Following';
        button.className = 'following-button';
      } else {
        button.innerHTML = 'Follow';
        button.className = 'follower-button';
      }
    }
  </script>
</html>
