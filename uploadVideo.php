<?php
include 'dbConnect.php';
$load = $_GET['load'];
if(isset($_GET['$load'])){
$videoInfo=database(
"SELECT * FROM videos WHERE title=$load"
);
$loadedVideo = $videoInfo->fetch_array();
};


?>
<!-- 업로드할 비디오 정보 작성 페이지 -->
<html>
<head></head>
<body>
<p>
<?php
//비디오 업로드 정보 입력하기 전
if(!isset($_GET['load'])){
	?>
<!-- 업로드 버튼 눌러서 동영상 추가하기 -->
<form action='uploadVideoProcess.php' method='post'>
<input type='text' placeholder='url을 입력하세요' name='location'/>
<input type='text' placeholder='영상 제목을 입력하세요' name='title'>
<input type='text' placeholder='영상길이 예)01:00' name='duration'>
<input type="submit" value="submit">
</form>
</p>
<?php }?>
<?php
//비디오를 성공적으로 업로드 했을 경우 get값을 받게 됨.
if(isset($_GET['success'])){
?>
<p>
<form action='showVideo.php' method='post'>
<input type='text' placeholder="<?=$loadedVideo['location']?>" name='location'/>
<input type='text' placeholder="<?=$loadedVideo['title']?>" name='title'>
<input type='text' placeholder="<?=$loadedVideo['duration']?>" name='duration'>
<input type="submit" value="submit">
</form>
</p>
<li class="col-lg-3 col-sm-4 col-xs-6">
		<a href="#" title="해리포터 애니메이션">
        <iframe class = "img-responsive" src="<?=$loadedVideo['title']?>" width="440" height="260" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
<p><?=$loadedVideo['title']?><a href="https://vimeo.com">Vimeo</a>.</p>
			<span class="duration"><?=$loadedVideo['duration']?></span>
		</a>
	</li>
<?php
}
?>
</body>

</html>