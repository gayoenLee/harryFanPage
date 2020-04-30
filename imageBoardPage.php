<?php  
session_start();
include_once"config.php";
include_once"dbConnect.php";
$sendingValue=$_GET["title"];
//  디비에서 게시글 정보 가져오기
?>
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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>이미지 공유 게시판</title>
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
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
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
        <h1>게시판</h1>
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

<!-- 글 목록 가져오기 -->
<tbody>
    <tr>
<td width="70"><?=$board['num']; ?></td>
<td width = "500">
<!-- data-action은 커스텀 속성., 클릭한 글의 번호에 해당하는 글을 읽는 페이지로 이동하겠다는 것. -->
    <span class="readCheck" style="cursor:pointer" 
    data-action="./showImageBoardContents.php?num=<?=$talkBoard['num']?>"><?=$title?></span>
    <td width="120"><?=$talkBoard['name'];?></td>
    <td width="100"><?=$talkBoard['time'];?></td>
    <td width="100"><?=$talkBoard['view'];?></td>
</tr>
</tbody>
<?php
//while문이 끝날 때까지 게시판테이블 배열의 정보를 가져옴.
}?>
</table>
</div>
   




<?php
$pageNum = ($_GET['page']) ? $_GET['page'] : 1;
//한 페이지에 보여줄 글 목록 갯수
$listNum = ($_GET['listNum'])?$_GET['listNum']:5; 

//한 블럭에 나타낼 페이지 번호 갯수
$blockPageNumList=5; 

//현재 리스트의 블럭 위치 구하기
$block = ceil($pageNum/$blockPageNumList);
// 블럭 조건 정의
//현재 블럭에서 시작페이지 번호
$blockStartPage=(($block -1) * $blockPageNumList)+1;

//현재 블럭에서 마지막 페이지 번호
$blockEndPage = $blockStartPage + $blockPageNumList - 1 ;

//총 페이지 수
$totalPage=ceil($listNum);
//한 페이지의 시작 글번호
$offset = $listNum*($pageNum-1)+2;
//한 페이지 마지막 글 번호
$lastNum=$listNum*($pageNum-1)+2;

if($blockEndPage > $totalPage){
    $blockEndPage = $totalPage;
}

$list=scandir('./imageBoardData');
$boardData=file_get_contents("imageBoardData/".$list[$offset]);
$boardArray = unserialize($boardData);

while($offset<$lastNum+5){

    if($list[$offset] != '.') {
       if($list[$offset]!= '..'){
        $boardData=file_get_contents("imageBoardData/".$list[$offset]);
        $boardArray = unserialize($boardData);
        $order = $offset-1;
echo "<tr><td>$order</td>
<td><li><a href=\"showImageBoardContents.php?title=$list[$offset]\">$list[$offset]</a></li>\n</td>
<td>$boardArray[1]</td>
<td>$boardArray[4]</td>
<td>$order\n</td>
</tr>";

       }
    }
    $offset = $offset + 1;
}

?>
</table>
</div>


<!-- 페이징 그리기 -->
<div class="pagingSection">
<tr class="pagingItem">
<td height="30" align="center" valign="middle" colspan="50" style="border:1px #CCCCCC solid";>
<?php
//페이지 번호가 1보다 작거나 같으면 링크 없이 그냥 처음이라는 문자만 출력.
if($pageNum <=1){
    ?>
    <font size=3 color=red>처음</font>
    
    <?
    //1보다 크면 링크걸린 처음을 출력.
}else{?>
    <font size=3><a href="imageBoardPage.php?page=$listNum=<?=$listNum?>">처음</a></font>
    <?}
//block이 1보다 작거나 같으면 더 이상 거꾸로 갈 수 없으므로 아무 표시도 하지 않음.
    if($bolck <=1){?>
    <font></font>
    <?}else{
        //블럭이 1보다 크다면 이전 링크를 보여줌.
        ?>
    <font size=3><a href="imageBoardPage.php?page=<?=$blockStartPage-1?>&listNum=<?=$listNum?>"이전</a></font>
    <?}
for($j = $blockStartPage; $j <=$blockEndPage; $j++){
if($pageNum == $j){
    ?>
    <font size=3 color=red><?=$j?></font>
    <?}
    else{?>
    <font size=3 colof=red><a href="imageBoardPage.php?page=<?=$j?>&listNum=<?$listNum?>"><?=$j?></a></font>
    <?
           }
}
$totalBlock = ceil($totalPage/$blockPageNumList);

if($block>= $totalBlock){
    ?>
    <font></font>
    <?}else{?>
    <font size=3><a href="imageBoardPage.php?page=<?=$blockEndPage+1?>&listNum=<?=$listNum?>">다음</a></font>
    <?
    }
if($pageNum >= $totalPage){
    ?>
    <font size=5 color=red>마지막</font>
    ><?}else{?>
    <font size=3><a href="imageBoardPage.php?page=<?=$totalPage?>&listNum=<?=$listNum?>">마지막</a></font><?}
    ?>
    </td>
    </tr>
    </div>
    </div>
    </div>
    <aside>
       
    </aside>
    </section>
        </body>
    </html>