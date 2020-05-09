<?php
include 'dbConnect.php';
    // //php.ini파일 수정 필요
?>
<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
</style>
</head>
<body>
<div class="container">
<p>
    <h5>Features:</h5>
    <ul>
        <li>Responsive design with hover effect</li>
        <li>Compatible with bootstrap 3.0.0 and Up</li>
        <li>No Javascript</li>
    </ul>
    <hr>
</p>
<p>
<!-- 업로드 버튼 눌러서 동영상 추가하기 -->
<form action='uploadVideo.php' method='post'>
<input type="submit" value="upload">
</form>
</p>
<?php
$videoSql = database(
    "SELECT * FROM videos ORDER BY idx
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
        <iframe class = "img-responsive" src=<?=$url?> width="440" height="260" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<p><?=$title?>on<a href="https://vimeo.com">Vimeo</a></on></p>
			<span class="duration"><?=$duration?></span>
		</a>
    </li>
    
    <?php
}?>
</ul>
</div>
</body>
</html>
