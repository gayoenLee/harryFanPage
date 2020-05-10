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
<!-- 업로드 버튼 눌러서 동영상 추가하기 -->
<form action='uploadVideoProcess.php' method='post'>
<input type='text' placeholder='url을 입력하세요' name='location'/>
<input type='text' placeholder='영상 제목을 입력하세요' name='title'>
<input type='text' placeholder='영상길이 예)01:00' name='duration'>
<input type="submit" value="submit">
</form>
</p>
</body>

</html>