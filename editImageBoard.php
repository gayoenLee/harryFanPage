<?php
include "config.php";
include "dbConnect.php";

$contentNum = $_GET['num'];

?>


<?php
$title=$_POST['title'];
$boardData = file_get_contents("imageBoardData/".$_POST['title']);
$boardArray =unserialize($boardData);

?>


<?php
function printContents(){
       //게시글 저장한 데이터 배열 압축 풀기
$title=$_POST['title'];
$boardData = file_get_contents("imageBoardData/".$_POST['title']);
$boardArray =unserialize($boardData);
    echo $boardArray[2];
}
function printEmail(){
    $title=$_POST['title'];
$boardData = file_get_contents("imageBoardData/".$_POST['title']);
$boardArray =unserialize($boardData);

    echo $boardArray[1];
}
function printTime(){
    $title=$_POST['title'];
$boardData = file_get_contents("imageBoardData/".$_POST['title']);
$boardArray =unserialize($boardData);
    echo $boardArray[4];
}
$title=$_POST['title'];
$boardData = file_get_contents("imageBoardData/".$_POST['title']);
$boardArray =unserialize($boardData);
$userName = $boardArray[1];
$time= $boardArray[4];




?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>글 수정하기</title>
    <link rel="stylesheet" type="text/css" href="showImageBoardCSS.css"/>
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
<li><a href="192.168.56.101/mainPage.php">홈</a></li>
<li ><a href="192.168.56.101/imageBoardPage.php">게시판</a></li>
<li ><a href="192.168.56.101/mainPage.php">인물 소개</a></li>
<li ><a href="192.168.56.101/mainPage.php">굿즈샵</a></li>
</ul>
</div>
		</nav><!-- 네비 바 끝 -->
    </header>



    <div id="boardRead">
        <form action="editImageBoardOK.php" method="post">
            <input type="hidden" name="oldTitle" value="<?php echo $_POST['title'];?>">
            <h2><input type="text" name="title" placeholder="Title" value="<?php echo $_POST['title']?>"></h2>
            <input type="hidden" name="password" value="<?php
             $boardData = file_get_contents("imageBoardData/".$_POST['title']);
             $boardArray =unserialize($boardData);
             echo $boardArray[3];
             ?>">
            <input type="hidden" name="userName" value="<?php
             $boardData = file_get_contents("imageBoardData/".$_POST['title']);
             $boardArray =unserialize($boardData);
             echo $boardArray[1];
             ?>">
            <input type="hidden" name="time" value="<?php
             $boardData = file_get_contents("imageBoardData/".$_POST['title']);
             $boardArray =unserialize($boardData);
             echo $boardArray[4];
             ?>">
            <div id="userInfo">
            <span>작성자 :</span>
                <?php
echo printEmail();
?>
 <span>작성 시간 :</span>
                <?php echo  printTime();
                ?>
                <div id="boardLine"></div>
            </div>
            <!-- 글 내용 -->
            <div id="boardContents">
               <textarea rows="10" cols="70" name="contents"><?php
// echo printList();
echo printContents();
?></textarea>
            </div>

      
        <!-- 목록, 수정 , 삭제 -->
        <div id="boardBottomMenu">
            <ul>
                <li>
                    <a href="/">[목록으로]</a>
                </li>
                <li>
                    <input type="submit" value="[수정 완료]">
                    </form>
                </li>
                <li>
                
                    <a href="imageBoardPage.php">[수정 취소]</a>
                </li>
            </ul>
        </div>

    </div>
</body>
</html>