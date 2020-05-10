<?php
include 'config.php';
include 'dbConnect.php';
    // //php.ini파일 수정 필요
?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="firstPageCSS.css" />

<style>
.video-list-thumbs{}
.video-list-thumbs > li{
    margin-bottom:12px;
}
.video-list-thumbs > li:last-child{}
.video-list-thumbs > li > a{
	display:block;
	position:relative;
	background-color: #111;
	color: #fff;
	padding: 8px;
	border-radius:3px
    transition:all 500ms ease-in-out;
    border-radius:4px
}
.video-list-thumbs > li > a:hover{
	box-shadow:0 2px 5px rgba(0,0,0,.3);
	text-decoration:none
}
.video-list-thumbs h2{
	bottom: 0;
	font-size: 14px;
	height: 33px;
	margin: 8px 0 0;
}
.video-list-thumbs .glyphicon-play-circle{
    font-size: 60px;
    opacity: 0.6;
    position: absolute;
    right: 39%;
    top: 31%;
    text-shadow: 0 1px 3px rgba(0,0,0,.5);
    transition:all 500ms ease-in-out;
}
.video-list-thumbs > li > a:hover .glyphicon-play-circle{
	color:#fff;
	opacity:1;
	text-shadow:0 1px 3px rgba(0,0,0,.8);
}
.video-list-thumbs .duration{
	background-color: rgba(0, 0, 0, 0.4);
	border-radius: 2px;
	color: #fff;
	font-size: 11px;
	font-weight: bold;
	left: 12px;
	line-height: 13px;
	padding: 2px 3px 1px;
	position: absolute;
	top: 12px;
    transition:all 500ms ease;
}
.video-list-thumbs > li > a:hover .duration{
	background-color:#000;
}
@media (min-width:320px) and (max-width: 480px) { 
	.video-list-thumbs .glyphicon-play-circle{
    font-size: 35px;
    right: 36%;
    top: 27%;
	}
	.video-list-thumbs h2{
		bottom: 0;
		font-size: 12px;
		height: 22px;
		margin: 8px 0 0;
	}
}
.recentUpload{
    text-align : center;
    
}
</style>
</head>
<body>
<div class="container">
<p>
 
	<div class="wrapper">
        <a href="donationPage.php">기부하기</a>
        <h1>LOGO</h1>
        <nav>
            <ul class="menu">
                <li><a href="#">홈</a></li>
                <li><a href="imageBoardPage.php">게시판</a></li>
                <li><a href="newsPage.php">최근 뉴스</a></li>
                <li ><a href="http://192.168.56.101/showVideo.php">영상</a></li>
               
        </nav>
    </div>
    <ul style="float:right; list-style-type:none;">
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
$logged = $username;
switch($userPoint['point']){
    case '0':
        echo "현재 등급 : 새싹회원 ";
    break;
    case '1':
        echo "현재 등급 : 새싹회원 ";
    break;
    case '2':
        echo "현재 등급 : 새싹회원 ";
    break;
    case '3':
        echo "현재 등급 : 새싹회원 ";
    break;
    case '4':
        echo "현재 등급 : 일반회원";
    break;
    case '5':
        echo "현재 등급 : 일반회원";
    break;
    case '6':
        echo "현재 등급 : 우수회원";
    break;
                        }
                        ?>
                    <ul>
                    <li>
                    <?=$userid?>님
                    <span class="caret"></span></a></li></ul>

<ul>
<li><a href="logout.php">로그아웃</a></li>
</ul>                    </li>
                    </ul>
                    <?php
                }?>
                   </div> 
    <hr>
</p>
<?php if($userid= 'admin67'){?>
<p>
<!-- 업로드 버튼 눌러서 동영상 추가하기, 관리자만 보이도록 -->
<form action='uploadVideo.php' method='post'>
<input type="submit" value="upload">
</form>
</p>
<?}?>
<h3>최근에 업로드된 동영상 </h3>
<div class="recentUpload">
<ul class="list-unstyled video-list-thumbs row">
<li class="col-lg-3 col-sm-4 col-xs-6"></li>
<?php
$recentVideoSql = database(
    "SELECT * FROM videos ORDER BY time DESC LIMIT 2"
);

while($recentVideos = $recentVideoSql->fetch_array()){
    $recentUrl = $recentVideos['location'];
    $recentTitle = $recentVideos['title'];
    $recentDuration = $recentVideos['duration'];
?>

	<li class="col-lg-3 col-sm-4 col-xs-6">
		<a href="#" title="해리포터 애니메이션">
        <iframe class = "img-responsive" src=<?=$recentUrl?> width="600" height="420" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<p><?=$recentTitle?></p>
			<span class="duration"><?=$recentDuration?></span>
		</a>
    </>
 
<?}?>
 </ul>
 </div>
 </div>
<br /><br /><br /><br /><br /><br />
<h3>동영상 목록</h3>
<br /><br />
<?php
$videoSql = database(
    "SELECT * FROM videos ORDER BY time
    ");
//비디오 저장된 내용 가져오기
while($videos = $videoSql->fetch_array()){
 $url = $videos['location'];
 $title = $videos['title'];
 $duration = $videos['duration'];
 

?>

<!-- 동영상 리스트들 시작-->
<ul class="list-unstyled video-list-thumbs row">
	<li class="col-lg-3 col-sm-4 col-xs-6">
		<a href="#" title="해리포터 애니메이션">
        <iframe class = "img-responsive" src=<?=$url?> width="600" height="420" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<p><?=$title?></p>
			<span class="duration"><?=$duration?></span>
		</a>
    </li>
    
    <?php
}?>
</ul>
</>
</div>
</body>
</html>
