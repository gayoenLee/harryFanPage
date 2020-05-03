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
    //회원 아이디별 포인트 정보 데이터베이스에서 가져오기
$pointSql = database(
"SELECT * FROM levelPointTable WHERE id='$userid'
"
);
$userPoint = $pointSql->fetch_array();

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

function resize_image($file, $newfile, $w, $h) {
    list($width, $height) = getimagesize($file);
    if(strpos(strtolower($file), ".jpg"))
       $src = imagecreatefromjpeg($file);
    else if(strpos(strtolower($file), ".png"))
       $src = imagecreatefrompng($file);
    else if(strpos(strtolower($file), ".gif"))
       $src = imagecreatefromgif($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    if(strpos(strtolower($newfile), ".jpg"))
       imagejpeg($dst, $newfile);
    else if(strpos(strtolower($newfile), ".png"))
       imagepng($dst, $newfile);
    else if(strpos(strtolower($newfile), ".gif"))
       imagegif($dst, $newfile);
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
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="showImageBoardCSS.css"/>
    <link rel="stylesheet" type="text/css" href="css/jqueryUI.css" />

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/jqueryUI.js"></script>
<script type="text/javascript" src="js/common.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script> 
  <!-- <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/common.js"></script> -->
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
    <div class="boardRead"  style="overflow:scroll;  height: 1500px; padding:10px; ">
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
                <?php
// Get images from the database
$query = $db->query("SELECT * FROM images WHERE contentTitle='".$talkBoard['title']."' ");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
resize_image('uploads/'.$row["file_name"], 'uploads/'.$row["file_name"]."new", 500, 500);
$newImageURL = 'uploads/'.$row["file_name"]."new";
?>
   <p><img src="<?php echo $newImageURL; ?>" alt="" /></p><br />
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?> 
</div>
<br />
 <!-- <div id="boardLine"></div> -->
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
                <div class="commentSide" style="overflow:scroll;  height: 1500px; padding:10px; ">    
                    <h3>댓글 남기기</h3>
         
           	<!--- 댓글 불러오기 -->
<div class="reply_view">
<h3>댓글목록</h3>
		<?php
			$sql3 = database("select * from commentTable where contentNum=$contentNum order by num desc");
			while($reply = $sql3->fetch_array()){ 
		?>
          <div class="dap_lo">
			<div><b><?php echo $reply['id'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[comment]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
			<div class="rep_me rep_menu">
				<a class="dat_edit_bt" href="#">수정</a>
				<a class="dat_delete_bt" href="#">삭제</a>
			</div>
            <!-- 댓글 수정 폼 dialog -->
			<div class="dat_edit">
				<form method="post" action="editImageBoardCommentProcess.php">
					<input type="hidden" name="rno" value="<?php echo $reply['num']; ?>" /><input type="hidden" name="b_no" value="<?php echo $contentNum; ?>">
					<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
					<textarea name="content" class="dap_edit_t"><?php echo $reply['comment']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>
            <!-- 댓글 삭제 비밀번호 확인 -->
			<div class='dat_delete'>
				<form action="deleteImageBoardComment.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['num']; ?>" /><input type="hidden" name="b_no" value="<?php echo $contentNum; ?>">
			 		<p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"></p>
				 </form>
			</div>
		</div>
	<?php } ?>
    <!--- 댓글 입력 폼 -->
	<div class="dap_ins">
			<input type="hidden" name="bno" class="bno" value="<?php echo $contentNum; ?>">
			<input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
			<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
	</div>
    </div><!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>
</div>
        </body>
    </html>