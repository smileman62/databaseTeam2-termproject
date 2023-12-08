/*
    This php code is edit page.
    You can change user's info in here.
*/

<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    $user_profile_image = $_SESSION['profile_image'];
    $user_nickname = $_SESSION['nickname'];

    $con = mysqli_connect("localhost","root","12345","database-twitter");
    $query = "SELECT * FROM user_info";
    $result = mysqli_query($con,$query);

    $row = mysqli_fetch_array($result);
    $user_introduction = $row["introduction"];

?>


<div class="wrapper bg-white mt-sm-5">
  <link href="css/profileEdit.css" rel="stylesheet" />
  <h4>&lt</h4>
  <h4 class="pb-4 border-bottom">Profile edit</h4>
  <div class="d-flex align-items-start py-3 border-bottom">
      <img src="images/<?php echo $user_profile_image?>"
          class="img" alt="">
      <div class="pl-sm-4 pl-2" id="img-section">
          <b>Profile Photo</b>
          <p>Accepted file type .png. Less than 1MB</p>
          <button class="btn button border"><b>Upload</b></button>
      </div>
  </div>
  <div class="py-2">
    <form action="edit.php" method = "post">
      <div class="row py-2">
          <div class="col-md-6">
              <label for="name">User Name</label>
              <div>
              <input type="text" class="bg-light form-control" placeholder=" Input name you want to change" name = "nickname">
              </div>
          </div>
      </div>
      <div class="row py-2">
          <div class="col-md-6">
              <label for="bio">password</label>
              <div>
              <input type="text" class="bg-light form-control" placeholder=" Input password you want to change" name = "password">
              </div>
          </div>
          <div class="col-md-6 pt-md-0 pt-3">
              <label for="website">File name</label>
              <div>
              <input type="text" class="bg-light form-control" placeholder="<?php echo $user_profile_image ?>" name = "profile_image">
              </div>
          </div>
          <div class="col-md-6 pt-md-0 pt-3" id="lang">
            <label for="birhtday">Introduction</label>
            <div>
            <input type="text" class="bg-light form-control" placeholder="<?php echo $user_introduction ?>" name = "introduction">
            </div>  
           </div>
      </div>
      <div class="py-3 pb-4 border-bottom">
          <button class="btn btn-primary mr-3" type = "submit" value = "전송">Save Changes</button>
    </form>
        <a href="profile-index.php?search=<?php echo $user_nickname;?>" class="btn border button" >Cancel</a>
      </div>
    
  </div>
</div>