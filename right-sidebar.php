/*
    This php code is about right side bar
*/

<div class="right_sidebar">
    <div class="search-container">
        <form action="profile-index.php" method = "get">
            <button type ="submit" class="search-btn" value="Submit">
                <i class = "fa fa-search"></i>
            </button>
            <input type="text" name = "search" placeholder="Search Twitter" class= "search-input">
        </form>
    </div>

    <div class = "trends_container">
        <div class="trends_box">
            <div class="trends_header">
                <P>당신을 위한 트렌드</p>
                <i class = "fa fa-cog"></i>
            </div>
        
            <div class = "trends_body">
                <div class = "trend">
                    <span>트렌딩</span>
                    <p>#trend</p>
                </div>
                <div class = "trend">
                    <span>트렌딩</span>
                    <p>#trend</p>
                    <div class = "trend">
                </div>
                <div class = "trends_show-more">
                    <a href="">더보기</a>
                </div>
            </div>
        </div>
    </div>
</div>