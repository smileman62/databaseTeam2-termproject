/*
    This php code is about login page
*/

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter_login</title>
    <script src="https://kit.fontawesome.com/51db22a717.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/loginStyle.css">

    <script>
        function submit2(frm){
            frm.action="check_signup.php";
            frm.submit();
            return true;
        }
    </script>
</head>

<body>
    <div class="wrap">
        <div class="main-wrap">
            <div class="side left-section">
                <div class="left-msg-wrap">
                    <ul>
                        <li><i class="fas fa-search"></i><span>Follow your interests.</span></li>
                        <li><i class="fas fa-user-friends"></i><span>Hear what people are talking about.</span></li>
                        <li><i class="far fa-comment"></i><span>Join the conversation.</span></li>
                    </ul>
                </div>
            </div>
            <div class="side right-section">
                <form method="post" action="check_login.php" class="login-form-wrap">
                    <div class="login-input-wrap">
                        <label>Phone,email,or username</label>
                        <input type="text" name = "nickname">
                    </div>
                    <div class="login-input-wrap">
                        <label>Password</label>
                        <input type="text" name = "pw">
                    </div>
                    <div class="login-btn-wrap">
                        <button type="submit" class="login-btn" onclick="button()">Log in</button>
                    </div>
                <div class="join-container">
                    <div class="join-wrap">
                        <div class="join-logo-wrap">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <h2>See what’s happening in the world right now</h2>
                        <div class="login-signup-btn-wrap">
                            <span>Join Twitter today.</span>
                            <button type="submit" class="signup-btn" onclick = 'return submit2(this.form);'>Sign up</button>
                            <button type="submit" class="login-btn" onclick="button()">Log in</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <footer>
            <ul>
                <li><a href=""> About
                <li><a href="">Help Center</a></li>
                <li><a href="">Terms</a></li>
                <li><a href="">Privacy policy</a></li>
                <li><a href="">Cookies</a></li>
                <li><a href="">Ads info</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="">Status</a></li>
                <li><a href="">Jobs</a></li>
                <li><a href="">Brand</a></li>
                <li><a href="">Advertise</a></li>
                <li><a href="">Marketing</a></li>
                <li><a href="">nesses</a></li>
                <li><a href="">Developers</a></li>
                <li><a href="">Directory</a></li>
                <li><a href="">Settings</a></li>
                <li><a href="">© 2020 Twitter, Inc.</a></li>
            </ul>

        </footer>

    </div>
</body>

</html>