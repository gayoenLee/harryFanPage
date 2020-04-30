<?php  
session_start();
echo session_cache_expire();
include_once"config.php";
include_once"dbConnect.php";
$id = $_POST['id'];
$sendingValue=$_GET["title"];
//  디비에서 게시글 정보 가져오기

if(isset($_GET['page'])){
    $page = $_GET["page"];
}
else{
    $page = 1;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>이미지 공유 게시판</title>
        <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
        <!-- <link rel="stylesheet" href="imageBoardPageCSS.css"> -->
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
<li ><a href="http://192.168.56.101/mainPage.php">인물 소개</a></li>
<li ><a href="http://192.168.56.101/mainPage.php">굿즈샵</a></li>
</ul>
</div>
		</nav><!-- #site-navigation -->
			<section class="container">
<div class="content">
    <div>
        <h1><b>게시판</b></h1>
       <!--세션 넘어오는 것 확인  <?php print_r($_SESSION) ;?> -->
        <div class="writeBtn">
        <button  class="write" onclick="location.href='writeImageBoard.php'">글쓰기</button>
        </div>
        <p></p>
        <div>
        <table class="listTable" style="text-align: center; border: 1px solid#ddddda">
            <tr>
                <th style="background-color: #eeeeee; text-align: center;">번호</th>
                <th style="background-color: #eeeeee; text-align: center;">제목</th>
                <th style="background-color: #eeeeee; text-align: center;">작성자</th>
                <th style="background-color: #eeeeee; text-align: center;">작성일</th>
                <th style="background-color: #eeeeee; text-align: center;">조회수</th>

            </tr>
            <?php
// 저장된 내용 가져오기
$sqlSecond = database(
    //테이블로부터 num기준으로 내림차순으로 정렬해서 모든 정보 가져오기
"SELECT * FROM talkBoard ORDER BY num DESC");
while(
    //fetch_aray : mysql 레코드 가져오기. 배열로 가져옴.
    //https://blog.naver.com/diceworld/220295811114
    $talkBoard = $sqlSecond->fetch_array()
){
    //배열로 저장.
$title = $talkBoard["title"];
// 글자수가 30이 넘으면 ...처리
if(strlen($title)>30){
    $title = str_replace($board["title"], mb_substr($talkBoard["title"],0,30,"utf-8")."...",$talkBoard["title"]);
}
?>

<!-- 글 목록 가져오기 -->
<tbody>
    <tr>
<td width="70"><?=$board['num']; ?></td>
<td width = "500">
<!-- data-action은 커스텀 속성., 클릭한 글의 번호에 해당하는 글을 읽는 페이지로 이동하겠다는 것. -->
    <span class="readCheck" style="cursor:pointer" 
    data-action="./showImageBoardContents.php?num=<?=$talkBoard['num']?>"><?=$title?></span>
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



<div id="pageNum" style="text-align:center;">
<?php
if($page <=1){
    //빈 값
}else{
    echo "<a href='imageBoardPage.php?page=1'>처음</a>";
}
if($page<=1){
    //빈 값
}else{
    $present = $page - 1;
    echo"<a href='imageBoardPage.php?page=$present'>이전</a>";
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
    echo "<a href='imageBoardPage.php?page=$next'>다음</a>";
}
if($page >= $totalPage){
    //빈 값
}else{
    echo "<a href='imageBoardPage.php?page=$totalPage'>마지막</a>";
}
?>
</div>
    </div>
    <aside>
       사이드
    </aside>
    </section>
        </body>
    </html>