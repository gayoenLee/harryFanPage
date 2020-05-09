<?php
include 'dbConnect.php';
//동영상 저장하는 페이지에서 받은 포스트값들 저장
$title = $_POST['title'];
$location = $_POST['location'];
$duration = $_POST['duration'];
$time = date('Y-m-d');

//동영상 삭제시 번호가 비워지지 않게 하기 위해 작성
database("alter table videos auto_increment = 1");
database(
    "INSERT INTO videos
    (title, location, duration, time) VALUES
    ('$title', '$location', '$duration', '$time')
");
// echo "<script>
// location.href='showVideo.php';
// </script>";
// ?>
<script type="text/javascript">location.replace("showVideo.php");</script>