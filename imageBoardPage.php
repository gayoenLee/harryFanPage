
<?php  
//  디비에서 게시글 정보 가져오기
include_once"./config.php";
include_once"./dbConnect.php";
$sendingValue=$_GET["title"];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>이미지 공유 게시판</title>
        <link rel="stylesheet" href="imageBoardPageCSS.css">
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