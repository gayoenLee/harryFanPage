<?php
session_start();
include 'config.php';
include 'dbConnect.php';

//쿠키를 ','로 나누어서 구분한다.
$todayViewEach = explode(",", $_COOKIE['todayViewBoardCookie'.$userid]);
//최근 목록 5개를 뽑기 위해 배열을 최신 것부터 반대로 정렬해주기.
$todayViewArray = array_reverse($todayViewEach);
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
        <p>
        <div class="float">
<table border=0 background=" " style=background-repeat:no-repeat width=80 height=500 cellpadding=0 cellspacing=0;>
<?
 if(!($todayViewArray[0] == "" || $todayViewArray[0] == null)){
?>
<tr style="paddind-left:10px;"><td height=20><strong>최근 본 게시물</strong></td></tr>
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
 $query="select title, id, time from talkBoard where num=$todayViewArray[$i]";
 $result=database($query);
 $rows=mysqli_fetch_array($result);
?>

<tr align=center style="padding-right:15px;padding-top:5px;">
 <td align=center height=42 >
 <a href="showImageBoardContents.php?num=<?=$rows['num']?>"><?=$rows['title']?>
  <!-- <img src="../shopimages/<?=$rows[minimage]?>" width=60 height=42 border=0 onerror='this.src=../img/noimage.gif'> -->
 </a>
 </td>
</tr>
<?
 echo "<tr><td align=center height=5 style=padding-right:15px;line-height :9px; font-size:9,>".substr2($rows['title'],0,10)."</td></tr>";
 /*echo "<tr><td align=center height=5 style=line-height :9px; font-size:11>"."\\".number_format($rows[price])."</td></tr>";*/
 }
}
?>
<tr>
<td></td>
</tr>
</center>
</table>
</div>
        </p>
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