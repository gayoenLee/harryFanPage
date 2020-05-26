<?php
include 'config.php';
include 'dbConnect.php';

//포인트 테이블 데이터 가져오기
$pointSql = database(
    "SELECT * FROM levelPointTable WHERE id='$userid'
    ");
    $userPoint = $pointSql->fetch_array();
//게시판에 로그인한 아이디인 사람이 글을 얼마나 올렸는지 갯수 가져오기.
    $writeIdNum = database(
        "SELECT COUNT(id) from talkBoard WHERE id='$userid'"
    );
//쿠키를 ','로 나누어서 구분한다.
$todayViewEach = explode(",", $_COOKIE['todayViewBoardCookie'.$userid]);
//최근 목록 5개를 뽑기 위해 배열을 최신 것부터 반대로 정렬해주기.
$todayViewArray = array_reverse($todayViewEach);

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
<?php
//방문횟수 확인하는 쿠키
if(isset($_COOKIE[$userid."visitLog"])){
    //쿠키가 있으면
    $logData = $_COOKIE[$userid."visitLog"];
   $counter = $logData["counter"];
    $time = $logData["time"];
    $lastDate = date("Y년n월j일 A g시i분", $time);
    
}else{
    $counter = 0;
 $lastDate = "첫 방문입니다.";
   // $counter = 1;
    //최근 한달 동안의 활동을 기준으로 회원 레벨 등급 올리기.
}
//쿠키가 없으면
//setcookie('visitNum'.$userid, $counter, time()+60*2);
if($lastDate == date("Y년n월j일 A g시i분")){
    $firstResult = setcookie($userid.'visitLog[counter]', $counter, time()+60,'/');
$secondResult = setcookie($userid.'visitLog[time]', time(), time()+60,'/');
}else{
$firstResult = setcookie($userid.'visitLog[counter]', ++$counter, time()+60,'/');
$secondResult = setcookie($userid.'visitLog[time]', time(), time()+60,'/');
}
$result = ($firstResult && $secondResult);

// if($counter == 1){
//     echo '처음 방문했습니다.';
// }else{
//     echo $counter.'번째 방문';
// }
//새싹 회원이 우수회원으로 올라가기 위한 조건.
if($userPoint['point']==0 && $counter>3){
    database("UPDATE levelPointTable 
    SET
    point = 3
    WHERE point = 0;
    "
    );
        }
//게시물 올린 갯수 구해서 그에 따라서 회원등급 우수회원으로 올리기.
//그러면 글 쓸수 있도록 하기.
if($writeIdNum>3 && userPoint['point'] == 3){
    database("UPDATE levelPointTable
    SET
    point=5
    WHERE point = 3");
}
function resize_image($file, $newfile, $w, $h) {
    list($width, $height) = getimagesize($file);
    if(strpos(strtolower($file), ".jpeg"))
       $src = imagecreatefromjpeg($file);
       else if(strpos(strtolower($file), ".jpg"))
       $src = imagecreatefromjpg($file);
    else if(strpos(strtolower($file), ".png"))
       $src = imagecreatefrompng($file);
    else if(strpos(strtolower($file), ".gif"))
       $src = imagecreatefromgif($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    if(strpos(strtolower($newfile), ".jpeg"))
       imagejpeg($dst, $newfile);
       else if(strpos(strtolower($file), ".jpg"))
       $src = imagecreatefromjpg($file);
    else if(strpos(strtolower($newfile), ".png"))
       imagepng($dst, $newfile);
    else if(strpos(strtolower($newfile), ".gif"))
       imagegif($dst, $newfile);
 }

?>
<!DOCTYPE html>

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

    <link rel="stylesheet" href="firstPageCSS.css">
    <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
 $(document).ready(function(){
  var currentPosition = parseInt( $(".float").css("top"));
  $(window).scroll(function(){
   var position = $(window).scrollTop();
   $(".float").stop().animate({"top":position+currentPosition+"px"},1000);
  });
 });
</script>
<style>
 .float{position:absolute; top:110px; right:30px;}
</style>
    <title>홈</title>
</head>

<body>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.14.2/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyBeHGe1OvUTDn3bnwkmVRIaMUZNtBcWds4",
    authDomain: "gayeonnharry.firebaseapp.com",
    databaseURL: "https://gayeonnharry.firebaseio.com",
    projectId: "gayeonnharry",
    storageBucket: "gayeonnharry.appspot.com",
    messagingSenderId: "703101803443",
    appId: "1:703101803443:web:c930cf37df7e315ca209c6",
    measurementId: "G-YJEEVCXFM3"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>

    <div class="wrapper">
        <a href="donationPage.php">기부하기</a>
        <h1>harryPotter Community</h1>
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
}?>
             <?php   if(!$userid){
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
                }if($userid!='admin67'){
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
</ul>
<ul>
    <li>
        <a href="/chat/chat.html">채팅하기</a>
    </li>
</ul>
                <br /><br /><br /><br /><br /><br />

<ul>
    <li><?php if ($result) {
    echo "이 페이지의 방문은 ", $counter, " 번째입니다<hr>";
    echo "이전 방문 : ", $lastDate, "<hr>";
    echo "오늘 날짜 : ", date("Y년n월j일"), "<hr>";
} else echo '<span class="error">print_r($_COOKIE);</span>';?></li>
</ul>
                    </li>
                    </ul>
                    <?php
                }?>
                   </div> 
        <!-- <li><a href="/bbs/login.php">로그인</a></li>
        <li><a href="/bbs/register_form.php">회원가입</a></li> -->
    </ul>
    <!-- 메인부분 시작 -->
    <span class="username">
     <!-- 게시판 최신글 가져오기 -->
     <h3>최근 게시물</h3>
     <table class="listTable" style=" border: 1px solid#ddddda">
     <thead>
            <tr>
                <th width = "70" style="background-color: #eeeeee; text-align: center;">번호</th>
                <th width = "70"style="background-color: #eeeeee; text-align: center;">   </th>
                <th width = "500"style="background-color: #eeeeee; text-align: center;">제목</th>
                <th width = "100"style="background-color: #eeeeee; text-align: center;">작성자</th>
                <th width="100"style="background-color: #eeeeee; text-align: center;">작성일</th>
                <th width = "70"style="background-color: #eeeeee; text-align: center;">조회수</th>

            </tr>
            </thead>
            <!-- 최신 글 5개가져오기 -->
            
<?php
$list = 5;
$sql  = database(
"SELECT * FROM talkBoard ORDER BY num DESC LIMIT $list
");
?>
<!-- 저장된 내용 가져오기 -->
<?php
while($talkBoard = $sql-> fetch_array()){
$title = $talkBoard['title'];
?>
<tbody>
    <tr>
<td width="70"><?=$talkBoard['num']; ?></td>
<!-- data-action은 커스텀 속성., 클릭한 글의 번호에 해당하는 글을 읽는 페이지로 이동하겠다는 것. -->
    <?php 
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
    <td><p><img src=" "> </p></td>
    <td  class="title" width = "500"><span class="readCheck" style="cursor:pointer" 
    data-action="./showImageBoardContents.php?num=<?=$talkBoard['num']?>"><?=$talkBoard['title']?></p></span></td>
   <?php }?>
    <td width="120"><?=$talkBoard['id'];?></td>
    <td width="100"><?=$talkBoard['time'];?></td>
    <td width="100"><?=$talkBoard['view'];?></td>
</tr>
</tbody>
<?php
};
?>
</table>
    <!-- 최근에 본 게시물 -->
<br /><br/><br /><br /><br/><br /><br /><br/><br />

    <div class="recentView"><h3>내가 최근에 본 게시물</h3>
    <?php      
    if(isset($todayViewArray)){
    ?>
    <table class ="listSecond" border=0 background=" " style=background-repeat:no-repeat width=80% cellpadding=0 cellspacing=0 ;>
    <tr>
                <th style="background-color: #eeeeee; text-align: center;">번호</th>
                <th style="background-color: #eeeeee; text-align: center;">제목</th>
                <th style="background-color: #eeeeee; text-align: center;">작성자</th>
                <th style="background-color: #eeeeee; text-align: center;">작성일</th>
                <th style="background-color: #eeeeee; text-align: center;">조회수</th>

            </tr>
<?
 if(!($todayViewArray[0] == "" || $todayViewArray[0] == null)){
?>
<?} ?>
<?
//상품명을 몇 자로 이내로 자르는 함수
function substr2($str, $start, $end){ //start부터 end까지 상품명을 추출한다.
 preg_match_all('/([\x00-\x7e]|..)/', $str, $string);
 return implode('',array_slice($string[0],$start,$end));
}
?>

<?
for($i=0; $i<5 && $todayViewArray[$i]; $i++){
 if($todayViewArray[$i] !=""){
 $query="select title, id, time, view from talkBoard where num=$todayViewArray[$i]";
 $result=database($query);
 $rows=mysqli_fetch_array($result);
?>
<tr style="padding-top:5px;">
<td><?=$todayViewArray[$i]?></td>
 <td  height=42 >
 <a href="showImageBoardContents.php?num=<?=$rows['num']?>"><?=$rows['title']?>
  <!-- <img src="../shopimages/<?=$rows[minimage]?>" width=60 height=42 border=0 onerror='this.src=../img/noimage.gif'> -->
 </a>
 </td>
 <td><?=$rows['id']?></td>
 <td><?=$rows['time']?></td>
 <td><?=$rows['view']?></td>
</tr>
<?

 /*echo "<tr><td align=center height=5 style=line-height :9px; font-size:11>"."\\".number_format($rows[price])."</td></tr>";*/
 }
}
?>
</table>
<?php
    }
else{?>
<h2>아직 조회한 게시물이 없습니다.</h2>
<?php
}
?>
</div>

    </span>
    <br /><br/><br /><br /><br/><br /><br /><br/><br />

<div class="wrap">
    <main class="content">
        <p>
        <div class="float">

</div>
        </p>
            </main>
  
</div><!--.wrap --> 
<?php
$recentNewsSql = database(
    "SELECT * FROM news ORDER BY idx DESC LIMIT 0,4"
);

while($recentNews = $recentNewsSql->fetch_array()){
    $recentUrl = $recentVideos['link'];
    $recentTitle = $recentVideos['title'];
    $recentImage = $recentVideos['image'];
?>
<h3>최근 뉴스</h3>
<section class="features">
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
  <a class="feature" href="#"><img src="https://fakeimg.pl/300x200/"></a>
</section> 

<a href="#">제일 위로</a>

</body>

</html>