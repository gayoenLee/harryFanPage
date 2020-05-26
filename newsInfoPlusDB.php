<?php
include 'dbConnect.php';
$newsData = file_get_contents('crawl/newsinfo.json');
//제이슨 파일 php 배열로 바꾸기
$data = json_decode($newsData, true);
$rows = count($data);
//배열 정보 뽑기
for($i=0; $i<$rows; $i++){
$title = $data[$i]['title'];
$link = $data[$i]['link'];
$image = $data[$i]['image'];
$date = $data[$i]['date'];
$contents = $data[$i]['contents'];

database( "INSERT INTO news(title, link, image, date, contents) VALUES
('$title', '$link', '$image', '$date', '$contents')
");

}

?>
<script type="text/javascript">location.replace("mainPage.php");</script>