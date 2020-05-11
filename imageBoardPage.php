<?php  
session_start();
include_once'config.php';
include_once'dbConnect.php';

$pointSql = database(
    "SELECT * FROM levelPointTable WHERE id='$userid'
    "
    );
    $userPoint = $pointSql->fetch_array();
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 1;
}
?>

<?php
//방문횟수 확인하는 쿠키
if(isset($_COOKIE['visitLog'])){
    //쿠키가 있으면
    $logData = $_COOKIE['visitLog'];
   // $counter = $_COOKIE['visitNum'.$userid]+1;
   $counter = $logData["counter"];
    $time = $logData["time"];
    $lastDate = date("Y년n월j일", $time);
}else{
    $counter = 0;
 $lastDate = "첫 방문입니다.";
   // $counter = 1;
    //최근 한달 동안의 활동을 기준으로 회원 레벨 등급 올리기.
}
//쿠키가 없으면
//setcookie('visitNum'.$userid, $counter, time()+60*2);

// if($counter == 1){
//     echo '처음 방문했습니다.';
// }else{
//     echo $counter.'번째 방문';
// }

function resize_image($file, $newfile, $w, $h) {
    list($width, $height) = getimagesize($file);
    if(strpos(strtolower($file), ".jpg"))
       $src = imagecreatefromjpg($file);
    else if(strpos(strtolower($file), ".png"))
       $src = imagecreatefrompng($file);
       else if(strpos(strtolower($file), ".jpeg"))
       $src = imagecreatefromjpeg($file);
    else if(strpos(strtolower($file), ".gif"))
       $src = imagecreatefromgif($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    if(strpos(strtolower($newfile), ".jpg"))
       imagejpg($dst, $newfile);
    else if(strpos(strtolower($newfile), ".png"))
       imagepng($dst, $newfile);
       else if(strpos(strtolower($newfile), ".jpeg"))
       imagejpeg($dst, $newfile);
    else if(strpos(strtolower($newfile), ".gif"))
       imagegif($dst, $newfile);
 }

 $userAgent = $_SERVER['HTTP_USER_AGENT'];

 function getBrowserInfo(){
     $userAgent = $_SERVER['HTTP_USER_AGENT'];
 
 if(preg_match('/Firefox/i',$userAgent)){
   $browser = 'Mozilla Firefox';
 }
 else if (preg_match('/Chrome/i',$userAgent)){
   $browser = 'Google Chrome';
 }
 else if(preg_match('/Safari/i',$userAgent)){
   $browser = 'Apple Safari';
 }
 else{
   $browser = "Other";
 }
 return $browser;
 }
 //os정보 읽어오기
 function getOsInfo()
 {
     $userAgent = $_SERVER['HTTP_USER_AGENT'];
 
   if (preg_match('/linux/i', $userAgent)){ 
     $os = 'linux';}
   elseif(preg_match('/macintosh|mac os x/i', $userAgent)){
     $os = 'mac';}
   elseif (preg_match('/windows|win32/i', $userAgent)){
     $os = 'windows';}
   else {
     $os = 'Other';
   }
   return $os;
 }
 $userAgent = $_SERVER['HTTP_USER_AGENT'];
 
 $browser = getBrowserInfo();
 $os      = getOsInfo();
 
 $arrayDay= array('일요일','월요일','화요일','수요일','목요일','금요일','토요일');
 $date = date('w'); //0 ~ 6 숫자 반환
 
 $staticsPageURL    = $_SERVER['PHP_SELF'];
 $staticsDayOfWeek   = $arrayDay[$date];
 $staticsAccessTime = date('H');
 $staticsUserIp     = getenv('REMOTE_ADDR');
 $staticsEnrollDate = date('Y') . date('m') . date('d');
 $staticsSignDate    = time();
 $staticsYear        = date('Y');
 $staticsMonth       = date('m');
 $staticsDay         = date('d');
 database(
     "INSERT INTO statistics(browser, os, year, month, date, pageURL,dayOfWeek, 
   accessTime, userIp, enrollDate, signDate, userId)
    VALUES('$browser', '$os', '$staticsYear', '$staticsMonth',
    '$staticsDay', '$staticsPageURL','$staticsDayOfWeek', '$staticsAccessTime',
      '$staticsUserIp', '$staticsEnrollDate', $staticsSignDate, '$userid')");


?>
<!DOCTYPE html>
<html>
    <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-3P6EV1K6ZT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-3P6EV1K6ZT');
</script>
         <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165857365-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-165857365-1');
</script>
        <meta charset="utf-8">
        <title>이미지 공유 게시판</title>
         <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script> 
  <link rel="stylesheet" type="text/css" href="css/jqueryUI.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/jqueryUI.js"></script>
<script type="text/javascript" src="js/common.js"></script>
           <link rel="stylesheet" href="imageBoardPageCSS.css"> 
<script>
$(function(){
    //span의 클래스인 readCheck가 클릭 이벤트가 발생하면 자신의 속성 값인 data-action값을 새로운 변수인 actionURL에 저장하고 그 링크로 이동하게 함.
$(".readCheck").click(function(){
var actionURL = $(this).attr("data-action");
$(location).attr("href", actionURL);

});
});
</script>
    </head>
    <body>
        <div id="page" style="height: auto !important;">
        <header id="headerImage" class="site-header" role="banner">   
<h1 class="siteTitle">
    <a href="http://192.168.56.101/mainPage.php">
    </a>
</h1>
</header>
            <nav id="siteNavigation" class="mainNavigation" role="navigation">
			<div class="navMenu"><ul>
<li><a href="http://192.168.56.101/mainPage.php">홈</a></li>
<li ><a href="http://192.168.56.101/imageBoardPage.php">게시판</a></li>
<li ><a href="http://192.168.56.101/mainPage.php">최근 뉴스</a></li>
<li ><a href="http://192.168.56.101/showVideo.php">영상</a></li>

    <?php
    //로그인한 계정이 관리자일 경우
if($userid=='admin67'){
    ?>
    <ul>
    <li ><a href="http://192.168.56.101/showUserInfo.php">관리자 페이지</a></li>
    <li>
    관리자님
    <span class="caret"></span></a></li></ul>
<ul>
<li><a href="logout.php">로그아웃</a></li>
</ul>
<?php
}
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

case '5':
    echo "현재 등급 : 일반회원";
break;

case '10':
    echo "현재 등급 : 우수회원";
break;
                    }
                    ?>
                    <ul>
                    <li>
                    <a href="#" role="button"><b><?=$logged?></b>님</li>
                    <span class="caret"></span></a>
<ul>
<li><a href="logout.php">로그아웃</a></li>
</ul>

                    </li>
                    </ul>
                    <?php
                }?>
                   </div> 
		</nav><!-- #site-navigation -->
			<section class="container">
<div class="content">
    <div>
        <h1><b>게시판</b></h1>
       <!--세션 넘어오는 것 확인  <?php print_r($_SESSION) ;?> -->
       <!-- 글쓰기 -->
        <div class="writeBtn">
        <button  class="write" onclick="location.href='writeImageBoard.php'">글쓰기</button>
        </div>
        <p></p>
        <div>
        <table class="listTable" style=" border: 1px solid#ddddda">
            <tr>
                <th style="background-color: #eeeeee; text-align: center;">번호</th>
                <th style="background-color: #eeeeee; text-align: center;">   </th>
                <th style="background-color: #eeeeee; text-align: center;">제목</th>
                <th style="background-color: #eeeeee; text-align: center;">작성자</th>
                <th style="background-color: #eeeeee; text-align: center;">작성일</th>
                <th style="background-color: #eeeeee; text-align: center;">조회수</th>

            </tr>
               <!-- 페이징 디비로 구현 시작 -->
               <?php
$sql = database("SELECT * FROM talkBoard");
//mysqli_num_rows : 게시판 테이블에 있는 모든 레코드 수를 변수에 저장.
$totalRecord = mysqli_num_rows($sql);
//한 페이지에 보여줄 갯수
$list = 5;
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
//게시글 정보 가져오기
$sqlSecond = database(
    //게시판 글 테이블에서 num을 내림차순으로 정렬해서 pageStart를 시작으로 list(5)만큼 보여주도록 정보를 가져오겠다.
    "SELECT * FROM talkBoard ORDER BY num DESC LIMIT $pageStart, $list"
);
?>
            <?php
// 저장된 내용 가져오기
while(
    //fetch_aray : mysql 레코드 가져오기. 배열로 가져옴.
    //https://blog.naver.com/diceworld/220295811114
    $talkBoard = $sqlSecond->fetch_array()){
    //배열로 저장.
$title = $talkBoard["title"];
$contentNum = $talkBoard['num'];
// 글자수가 30이 넘으면 ...처리
// if(strlen($title)>30){
//     $title = str_replace($talkBoard["title"], mb_substr($talkBoard["title"],0,30,"utf-8")."...",$talkBoard["title"]);
// }
?>
         
<!-- 글 목록 가져오기 -->
<tbody>
    <tr>
<td width="70"><?=$talkBoard['num']; ?></td>
<!-- data-action은 커스텀 속성., 클릭한 글의 번호에 해당하는 글을 읽는 페이지로 이동하겠다는 것. -->
    <?php 
    //게시글에 댓글 몇 개 있는지 확인하기 위해 댓글 갯수 가져오기
$commentSql=database(
    "SELECT COUNT(contentNum) FROM commentTable where contentNum=$contentNum"
);
$commentNum = mysqli_num_rows($commentSql);

    // Get images from the database
$query = $db->query("SELECT * FROM images WHERE contentTitle='".$talkBoard['title']."' ");
if($query->num_rows > 0){
    $row = $query->fetch_assoc();
    $imageURL = 'uploads/'.$row["file_name"];
    if(isset($imageURL)){
        resize_image('uploads/'.$row["file_name"], 'uploads/'.$row["file_name"]."new", 70, 70);
        $newImageURL = 'uploads/'.$row["file_name"]."new";
?>
    <td><img src="<?php echo $newImageURL; ?>" alt="" /></td>
  <td  class="title" width = "500"><span class="readCheck" style="cursor:pointer" 
    data-action="./showImageBoardContents.php?num=<?=$talkBoard['num']?>"><?=$title?></p></span></td>
<?php 
}}else{
    ?>
        <td><img src=" "></td>
        <td  class="title" width = "500"><span class="readCheck" style="cursor:pointer" 
    data-action="./showImageBoardContents.php?num=<?=$talkBoard['num']?>"><?=$talkBoard['title']?>[<?=$commentNum?>]</p></span></td>
   <?php }?>
    <td width="120"><?=$talkBoard['id'];?></td>
    <td width="100"><?=$talkBoard['time'];?></td>
    <td width="100"><?=$talkBoard['view'];?></td>
</tr>
</tbody>
<?php
//while문이 끝날 때까지 게시판테이블 배열의 정보를 가져옴.
}?>
</table>
</div>

<div class="pagination" id="pageNum" style="text-align:center;">
<?php

if($page <=1){
    //빈 값
}else{
    echo "<a class='previewEnd'href='imageBoardPage.php?page=1'>처음</a>";
}
if($page<=1){
    //빈 값
}else{
    $present = $page - 1;

    echo"<a class='preview' href='imageBoardPage.php?page=$present'>이전</a>";
}
for($i = $blockStart; $i <= $blockEnd; $i++){
    if($page == $i){
        echo "<b>$i</b>";
    }else{
        echo "<a href='imageBoardPage.php?page=$i'>$i</a>";
    }
}
if($page >= $totalPage){
    //빈 값
}else{
    $next = $page + 1;
    echo "<a class='next' href='imageBoardPage.php?page=$next'>다음</a>";
}
if($page >= $totalPage){
    //빈 값
}else{
    echo "<a class='end'href='imageBoardPage.php?page=$totalPage'>마지막</a>";
}

?>
</div>
    </div>
    <div class="serchDiv">
<div class="searchBox" style="text-align: center">
<form action="searchResult.php" method="get">
<select name="category">
<div class = "searchTitle">
<option value="title">제목</option></div>
<div class="searchName">
<option value="name">글쓴이</option>
</div>
<div class="searchContent">
<option value="content">내용</option>
</div>
</select>
<input type="text" name="search" size="80" required="required">
<button class="btn btn-primary">검색</button>
</form>

</div>
</div>
<aside>
    </aside>
    </section>
        </body>
    </html>