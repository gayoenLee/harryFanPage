<?php
include_once "config.php";
include "dbConnect.php";

$contentNum = $_GET['num'];
$sql = database(
    "SELECT * FROM talkBoard where num='$contentNum'
    ");
    $talkBoard = $sql -> fetch_array();
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
		</nav><!-- 네비 바 끝 -->
    </header>

    <div id="boardRead">
        <form action="editImageBoardOK.php/<?php echo $talkBoard['num'];?>" method="post">
            <input type="hidden" name="num" value="<?=$contentNum?>"/>

            <h2><input type="text" name="title" placeholder="Title" value="<?= $talkBoard['title']?>" required></h2>
            <div id="userInfo">
            <span>작성자 아이디 :</span>
                <?=$talkBoard['id']
?>
 <span>작성일 :</span>
                <?=$talkBoard['time']
                ?>
                <div id="boardLine"></div>
            </div>
            <!-- 글 내용 -->
            <div id="boardContents">
               <textarea rows="10" cols="70" name="content"><?=$talkBoard['content']
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