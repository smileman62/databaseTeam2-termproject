/*
    This php code show left side bar
*/
<?php
session_start();

$userid = $_SESSION['user_id'];
$user_name = $_SESSION['nickname'];
$query = "SELECT * FROM user_info WHERE user_id = $userid";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_array($result);

$session_nickname = $row["nickname"];
$session_id = $row["user_id"];
$session_profile = $row["profile_image"];
?>


<div class="sidebar">
    <ul style="list-style: none">
    <li><i class = "fab fa-twitter"></i><li>
    <li class="active_menu"><i class="fa fa-home"></i><span> 홈</span></li>
    <li><i class="fa fa-hashtag"></i><span> 탐색</span></li>
    <li><i class="fa fa-bell"></i><span> 알림</span></li>
    <li><i class="fa fa-envelope"></i><span> 메세지</span></li>
    <li><i class="fa fa-bookmark"></i><span> 북마크</span></li>
    <li><i class="fa fa-list"></i><span> 리스트</span></li>
    <li><a href="profile-index.php?search=<?php echo $user_name?>"><i class="fa fa-user"></i><span> 프로필</span></a></li>
    <li><i class="fa fa-ellipsis-h"></i><span> 더보기</span></li>
    <li style="padding: 10px 40px;"><button class ="sidebar_tweet"> 트윗하기</button></li>
    </ul>

    <div class = "user-info">
        <div class = "user-profile">
            <img src = "images/<?php if(isset($session_profile)){echo $session_profile;} else{echo "non-profile.png";} ?>" alt = "">
        </div>
        <div class = "name-and-id">
            <p class = "name"><?php echo $session_nickname?></p>
            <p class = "id">@<?php echo $session_id?></p>
        </div>
        <div class = "logout-box"> 
            <button type = "button" class = "logout-btn" onclick="location.href='logout.php'">
                <i class = "fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </div>
    </div>
    
</div>