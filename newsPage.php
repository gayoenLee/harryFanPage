<?php
include 'dbConnect.php';
include 'config.php';
//페이징에서 사용할 페이지 
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Clarion 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20131009

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">Clarion</a></h1>
		</div>
		<div id="menu">
			<ul>
				<li><a href="http://192.168.56.101/mainPage.php" accesskey="1" title="">홈</a></li>
				<li><a href="http://192.168.56.101/imageBoardPage.php" accesskey="2" title="">게시판</a></li>
				<li><a href="http://192.168.56.101/newsPage.php" accesskey="3" title="">최근 소식</a></li>
				<li><a href="#" accesskey="4" title="">인물 소개</a></li>
				<li><a href="#" accesskey="5" title="">About Us</a></li>
			</ul>
		</div>
	</div>
	<div id="banner" class="container">
		<p>dhis <strong>Clarion</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>		
	</div>
</div>
<div id="page-wrapper">
	<div id="featured" class="container">
		<div class="title">
			<h2>최근 소식 BEST 4</h2>
		</div>
		<!-- 페이징 구현 시작 -->
<?php
$sql = database("SELECT * FROM news");
//뉴스 테이블에 있는 모든 레코드 수를 변수에 저장
$totalRecord = mysqli_num_rows($sql);
//한 페이지에 보여줄 갯수
$list = 2;
//블록당 보여줄 페이지 갯수
$blockCount = 5;
//현재 페이지 블록
$blockNum = ceil($page / $blockCount);

//블록 시작 번호
$blockStart = (($blockNum - 1) * $blockCount)+1;
//블럭 마지막 번호
$blockEnd = $blockStart + $blockCount - 1;
//페이징한 페이지 수
$totalPage = ceil($totalRecord / $list);
if($blockEnd > $totalPage){
    $blockEnd = $totalPage;
}
//블록의 총 갯수
$totalBlock = ceil($totalPage / $blockCount);
//페이지의 시작
$pageStart = ($page - 1) * $list;
// 뉴스 정보 가져오기
$sqlFirstRow = database(    "SELECT * FROM news WHERE MOD(idx, 2) = 1 
	ORDER BY idx DESC LIMIT $pageStart, $list"
);
$sqlSecondRow = database(
"SELECT * FROM news WHERE MOD(idx, 2) = 0 
ORDER BY idx DESC LIMIT $pageStart, $list"
);
?>
		<!-- 첫번째 세로줄 -->
		<div class="tbox1">
			<div class="padding-bottom">

				<?php
			   //첫번째 열에 홀수 idx 저장된 내용 가져오기 
			   while($news = $sqlFirstRow->fetch_array()){
				   $title = $news["title"];
				   $link = $news["link"];
				   $image = $news["image"];
				   $contents = $news["contents"];
			   
			   
				?>
				<h2><?=$title?></h2>
				<img src="<?php echo $image ?>"width=490; height=220; alt="" />
				<p><?=$contents?></p>
				<a href=<?=$link?> class="button">뉴스 보러가기</a>
				<?php
}
				?>
			</div>
		</div>
		<!-- 두번째 세로줄에 짝수idx뉴스 가져오기 -->
		<div class="tbox2">
			<div class="padding-bottom">

			<?php
			while($newsSecond = $sqlSecondRow->fetch_array()){
$titleSecond = $newsSecond["title"];
$linkSecond = $newsSecond["link"];
$imageSecond = $newsSecond["image"];
$contentsSecond = $newsSecond["contents"];

			
			?>
				<h2><?=$titleSecond?></h2>
				<img src="<?php echo $imageSecond ?>" width=490; height=220; alt="" />
				<p><?=$contentsSecond?></p>
				<a href=<?=$linkSecond?> class="button">뉴스 보러가기</a>
				<?php
}
				?>
			</div>
		</div>
	</div>
</div>
<div id="copyright">
	<p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
</body>
</html>
