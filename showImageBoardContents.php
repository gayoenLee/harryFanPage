<?php
include_once"config.php";
include"dbConnect.php";

$contentNum = $_GET['num'];
//받아온 num값을 선택해서 게시글 정보 가져오기
$sql = database(
    "SELECT * FROM talkBoard where num='$contentNum'
    ");
    $talkBoard = $sql -> fetch_array();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>이미지 게시판</title>
    <link rel="stylesheet" type="text/css" href="showImageBoardCSS.css"/>
    <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script> 
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
        <form method="POST" action="editImageBoard.php">
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
                            <form action="deleteImageBoard.php" method="post">
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