<?php
session_start();
include 'config.php'
?>
<!DOCTYPE html>

<head>
    <style type="text/css">
 .content {
    width: 67%;
    float: left;
}
.sidebar {
    width: 33%;
    float: right;
}
.feature {
    width: 25%;
    float: left;
}
.wrap:after, .features:after {
    content: " "; 
    display: block; 
    clear: both;
}
    </style>
    <link rel="stylesheet" href="firstPageCSS.css">
    <title>홈</title>
</head>

<body>

    <div class="wrapper">
        <h1>LOGO</h1>
        <nav>
            <ul class="menu">
                <li><a href="#">HOME</a></li>
                <li><a href="aboutPage.html">ABOUT</a></li>
                <li><a href="imageBoardPage.php">BOARD</a></li>
                <li><a href="newsPage.html">NEWS</a></li>
                <li><a href="goodsPage.html">GOODS</a></li>
                <?php
                if(!$userid){
                    ?>
                    <ul>
                    <li>
                    <a href='#' role="button">접속하기<span class="caret"></span></a>
                    <ul>
                    <li><a href="login.php">로그인</a></li>
                    </li>
                    <li><a href="joinMember.php">회원가입</a></li>
                    </ul>
                    </li>
                    </ul>
                    <?php
                }else{
$logged = $username."(".$userid.")";
                    ?>
                    <ul>
                    <li>
                    <a href="#" role="button"><b><?=$logged?></b>님의 회원관리
                    <span class="caret"></span></a>
<ul>
<li><a href="logout.php">로그아웃</a></li>
</ul>

                    </li>
                    </ul>
                    <?php
                }?>
                   </div> 
        </nav>
    </div>
    <span class="username">WELCOME !</span>
<div class="wrap">
    <main class="content">
        <p>여기에 게시물들 가져오기ㅁㄴ아리;'ㅁㅇ넣;ㅣ'ㄴㅇ러하;'ㅣㅁ나ㅓ일'ㄴ이;마히;ㅇㄴㅁ'ㅏㅎ;</p>
            </main>
    <aside class="sidebar">ㅇㄴㅁㄹㄴㅇㄹㄴㅁㅇㄹㅇㄴ사이드</aside>
</div><!--.wrap --> 
<section class="features">
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
</section> 



</body>

</html>