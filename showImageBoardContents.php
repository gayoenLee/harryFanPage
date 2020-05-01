<?php
include_once"config.php";
include"dbConnect.php";

$contentNum = $_GET['num'];
$cookieContentNum = $contentNum;
$view = mysqli_fetch_array(
    database("SELECT * FROM talkBoard WHERE num='$contentNum'
"));
$view = $view['view'] + 1;
//받아온 num값을 선택해서 게시글 정보 가져오기
$sql = database(
    "SELECT * FROM talkBoard where num='$contentNum'
    ");
    $talkBoard = $sql -> fetch_array();
//조회수 올리기-쿠키 사용해서 중복 조회 방지 
if(!empty($contentNum) && empty($_COOKIE['imageBoard'.$contentNum])){
    $sqlSecond = 
        "UPDATE talkBoard SET 
        view='$view'
        WHERE num='$contentNum'
        ";
        $result = $db->query($sqlSecond);
if(empty($result)){
?>
<script>
alert('오류가 발생했습니다');
history.back();
</script>
<?php
}else{
    setcookie('imageBoard'.$contentNum, TRUE, time()+(60*60*24), '/');
}
}

//오늘 본 게시물 또는 최근 본 게시물 만들기
$i=0;
//todayViewBoardCookie라는 쿠키가 존재하면
if(isset($_COOKIE['todayViewBoardCookie'.$userid])){
    //todayViewBoard변수에 todayViewBoardCookie를 저장.
$todayViewBoard = $_COOKIE['todayViewBoardCookie'.$userid];
//쿠키를 ','로 나누어서 구분한다.
$todayViewEach = explode(",", $_COOKIE['todayViewBoardCookie'.$userid]);
//최근 목록 5개를 뽑기 위해 배열을 최신 것부터 반대로 정렬해주기.
$todayViewArray = array_reverse($todayViewEach);
//위의 배열의 사이즈만큼 반복.
while($i<sizeof($todayViewArray)){
if($cookieContentNum == $todayViewArray[$i]){
    //중복을 막기 위한 변수 $save
    $save='no';
}
$i++;
}
}
//저장된 쿠키값이 없을 경우 새로 쿠키 저장.
if(!isset($_COOKIE['todayViewBoardCookie'.$userid])){
    setcookie('todayViewBoardCookie'.$userid, $cookieContentNum, time()+21600, "/");
}
//저장된 쿠키값이 존재하고, 중복된 값이 아닌 경우 기존의 todyaViewBoardCookie에 현재 쿠키를 추가하는 소스
if(isset($_COOKIE['todayViewBoardCookie'.$userid])){
    if($save != 'no'){
        setcookie('todayViewBoardCookie'.$userid, $todayViewBoard.",".$cookieContentNum, time()+21600, "/");
    }
}
?>
<!-- 쿠키가 잘됐는지 확인하는 코드 -->
<script>
alert(document.cookie);
</script>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>이미지 게시판</title>
    <link rel="stylesheet" type="text/css" href="showImageBoardCSS.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script> 
 <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/common.js"></script>

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
    <div class="boardRead">
        <!-- 게시물 수정하는 페이지로 데이터 보내기 -->
        <form method="POST" action="editImageBoard.php?num=<?=$talkBoard['num']?>">
            <input type="hidden" value="<?php echo $_GET['title'];?>" name="title">
            <input type="hidden" value=$email name='email'>
           
            <h3 ><?=$talkBoard['title']?></h3>
            <div id="userInfo">
            <span>작성자 :<?=$talkBoard['id']?></span>
  
 <span>작성 시간 :<?=$talkBoard['time']?></span>
                
                <div id="boardLine"></div>
            </div>
            <!-- 글 내용 나오는 부분 시작-->
            <div id="boardContents">
                <h2><?=$talkBoard['content']?>
</div>
 <div id="boardLine"></div>
</h2></div>
                    <!-- 목록, 수정 , 삭제 -->
              <p>      <div class="boardBottomMenu">
                        <ul>
                            <!-- <li class="button">
                                <a href="http://192.168.56.101/imageBoardPage.php">[목록으로]</a>
                            </li> -->
                            <li class="button">
                            <a href="imageBoardPage.php">[목록]</a>
                            <?php
                            if($userid==$talkBoard['id']){
                                ?>
                                <input  type="submit" value="[수정]" name="submit">
                            </li>
                        </form>
                        <li class="button">
                            <form action="deleteImageBoard.php?num=<?=$talkBoard['num']?>" method="post">
                                <input type="hidden" name="title" value="<?php echo $_GET['title'];?>">
                                <input type="hidden" name="time" value="<?php 
                                  $title=$_GET['title'];
                                  $boardData = file_get_contents("imageBoardData/".$_GET['title']);
                                  $boardArray =unserialize($boardData);
                                  $contentsTime = $boardArray[4];
                                      echo $boardArray[4];
                                ?>">
                                <input  type="submit" value="[삭제]"><?php } ?>
                            </li>
                        </ul>
                    </div>
                </form>
                </p>
                <!-- 하단에 댓글 달기 버튼, 입력 폼 -->
                <div class="commentSide">    
                    <h3>댓글 남기기</h3>
                    
                    <form
                        action="imageBoardAddCommentProcess.php"
                        method="POST"
                        id="commentForm">
                        <p>
                            <span>아래에 내용을 입력해주세요</span>
                            <span>필수 입력창은</span><span class="required">*</span>로 표시되어 있습니다.
                        </p>
                        <p>댓글
                            <textarea
                                id="comment"
                                name="comment"
                                cols="45"
                                rows="8"
                                maxlength="65525"
                                required="required"></textarea>
                        </p>
                        <p>
                            비밀번호<span class="required">*</span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                size="30"
                                maxlength="245"
                                required="required">
                        </p>
                        <p>
                            이메일<span class="required">*</span>
                            
                            <input
                                id="email"
                                name="email"
                                size="30"
                                maxlength="100"
                                aria-describedby="email-notes"
                                required="required">
                        </p>
                        <p>
                            <input type="hidden" name="title" value="<?php  echo $_GET["title"];?>">
                            <input type="hidden" name="time" value="<?php echo date("Y-m-d H:i:s");?>">
                            <input name="submit" type="submit" value="댓글 작성">

                        </p>

                    </form>
                </div>
            </div>
            <div>
            <!-- 댓글 추가되는 곳 -->
            <?php
             $title = $_GET["title"];
function printCommentList(){
    //게시물 제목에 맞는 댓글 파일 전부 가져오기
    $list = scandir('./imageBoardCommentData');
    $i=0;
    if(isset($_POST["editTitle"])){
        $comment = $_POST["comment"];
$email = $_POST["email"];
$title = $_POST["title"];
$time = $_POST["time"];

$commentArray = array($title, $email, $comment, $time);
$data = serialize($commentArray);
    file_put_contents('imageBoardCommentData/'.$_POST["editTitle"], $data);
}//echo count($list);
    while($i < count($list)){
        if($list[$i] != '.'){
            if($list[$i] !='..'){
       if($list[$i]){
                if(strpos($list[$i],$_GET["title"])!==false){
                $data = file_get_contents("imageBoardCommentData/".$list[$i]);
                 $array = unserialize($data);
                // echo "0번째".$array[0]."<br/>";
                 echo "<div ><li >작성자".$array[1]."<br/></li></div>";
                 echo "<div style='visibility: visible'><li class='commentList'>댓글 내용 : ".$array[2]."<br/></li></div>";
                 echo "<div><li>작성 시간 : ".$array[3]."<br/></li></div>";
                 $sendTitle=$_GET["title"];
               echo  "<HTML>
                <form 
                 action= 'deleteImageBoardComment.php'
                  method='get'>
                    <input type='hidden' name='title' value='$list[$i]';?>
                    <input type='hidden' name='pageTitle' value='$sendTitle';?>
                    <input type='submit' value='[삭제]'>
                    </form>
                    </HTML>";
                   
                    echo  "<HTML>
                    <form action='showImageBoardContents.php?title=.$sendTitle '
                     >
                     
                        <input type='button' value='[수정]' onClick='showElement($i)'>
                                         </form>
                        </HTML>";

                    echo "<html>
                    <div class='container$i' style='visibility:hidden'>
                    <form action='' method='POST'>
                 
                    <input type='hidden' name='editTitle' value='$list[$i]';?>
                    <input type='hidden' name='title' value='$array[0]' ;?>
                    <input type='hidden' name='email' value='$array[1]' ;?>
                    <input type='text' name='comment' value='$array[2]' ;?>
                    <input type='hidden' name='time' value='$array[3]' ;?>
                    <input type='hidden' name='pageTitle' value='$sendTitle';?>
                    <input type='button' value='[취소]' onClick='hideElement($i)'>
                    <input type='submit' value='[저장]'>
                    </form>
                    </div>
                    </html>";
  
                }
            
                }
    
            }
    }
    $i =$i + 1;
        
}
}
            include 'commentaAddForm.php';
            ?>
            <script type="text/javascript">
            function showElement(position) {    
            element = document.querySelector('.container'+position); 
            element.style.visibility = 'visible'; 
        } 
        function hideElement(position) { 
            element = document.querySelector('.container'+position); 
            element.style.visibility = 'hidden'; 
        } 
    </script> 
    </div>
    </div>                    
            <!-- </script> -->
    
        </body>
    </html>