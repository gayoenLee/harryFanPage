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
       else if(strpos(strtolower($file), ".jpeg"))
       $src = imagecreatefromjpeg($file);
    else if(strpos(strtolower($file), ".png"))
       $src = imagecreatefrompng($file);
    else if(strpos(strtolower($file), ".gif"))
       $src = imagecreatefromgif($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    if(strpos(strtolower($newfile), ".jpg"))
       imagejpeg($dst, $newfile);
       else if(strpos(strtolower($newfile), ".jpeg"))
       imagejpeg($dst, $newfile);
    else if(strpos(strtolower($newfile), ".png"))
       imagepng($dst, $newfile);
    else if(strpos(strtolower($newfile), ".gif"))
       imagegif($dst, $newfile);
 }
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
  accessTime, userIp, enrollDate, signDate)
   VALUES('$browser', '$os', '$staticsYear', '$staticsMonth',
   '$staticsDay', '$staticsPageURL','$staticsDayOfWeek', '$staticsAccessTime',
     '$staticsUserIp', '$staticsEnrollDate', $staticsSignDate, '$userid')");
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
    <title>이미지 게시판</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="showImageBoardCSS.css"/>
    <link rel="stylesheet" type="text/css" href="css/jqueryUI.css" />

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/jqueryUI.js"></script>
<script type="text/javascript" src="js/common.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script> 
  <!-- <link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/css/style.css" />
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>
<script type="text/javascript" src="/js/common.js"></script> -->
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
<li ><a href="http://192.168.56.101/newsPage.php">최근 뉴스</a></li>
                   </div> 
		</nav><!-- 네비 바 끝 -->
    </header>
    <ul style="float:right; list-style-type:none; margin-right : 200px">
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
                    <?=$userid?>님
                    <span class="caret"></span></a></li></ul>
                    <ul><li>
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
                    <?php
                }?>
                    </li></ul>
<ul>
<li><a href="logout.php">로그아웃</a></li>
</ul>
                <br /><br /><br /><br /><br /><br />
                    </li>
                    </ul>
                    <?php
                }?>
                   </div> 
        <!-- <li><a href="/bbs/login.php">로그인</a></li>
        <li><a href="/bbs/register_form.php">회원가입</a></li> -->
    </ul>
    <div class="boardRead" >
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
            <div id="boardContents" style="overflow-y:auto; overflow-x:auto !important;   height : auto; padding:10px; position: relative">
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
   
<?php } ?> 
</div>
<br />
 <div id="boardLine"></div>
</h2></div>
<br /><br />
                    <!-- 목록, 수정 , 삭제 -->
              <p>      <div class="boardBottomMenu">
                        <ul>
                            <li class="button">
                          <button type="button" onClick="location.href='imageBoardPage.php'">[목록]</button>
                            </li>
                            <li class="button">
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
                                <input type="submit" value="[삭제]"><?php } ?>
                            </li>
                        </ul>
                    </div>
                </form>
                </p>
                <!-- 신고하기 버튼 -->
                <form action="reportContent.php" method='post'>
                <input type="hidden" name="contentNum" value=<?=$contentNum?>>
               <div><button type="button">
               <input type="submit" name="submit">글 신고하기</button>
               </form>
               </div>
                <!-- 하단에 댓글 달기 버튼, 입력 폼 -->
                <div class="commentSide">
                <div class="commentSide ">    
                    <h3>댓글 남기기</h3>
         
           	<!--- 댓글 불러오기 -->
<div class="reply_view">
<h3>댓글목록</h3>
		<?php
        //commentTable의 contentNum은 게시판 글번호
        
			$sql3 = database("select * from commentTable where contentNum=$contentNum order by num desc");
			while($reply = $sql3->fetch_array()){ 
                
		?>
         <?php $check = $reply['num'] ?>
         <?php $delete = $reply['num']+1 ?>

        <!-- 댓글이 보여지는 내용 dap_lo 댓글 수정시 작성자에게만 수정, 삭제 나오도록 하기-->
          <div class="dap_lo" id="<?php echo 'container'.$check?>" style='visibility:visible'>
			<div><b><?php echo $reply['id'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[comment]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
			<div class="rep_me rep_menu">
            <? if($userid == $reply['id']){?>
            <input type = "button" onClick="hideElement(<?php echo $check?>)" value="수정하기">

            <input type = "button" onClick = "showCheck(<?php echo $delete?>)" value="삭제하기">
        <? } 
        ?>
			</div>
            </div>
       
            <!-- 댓글 수정 폼  -->
			<div class="dap_edit" id = "<?php echo 'containerEdit'.$check ?>" style = 'visibility:hidden' onClick="showElement(<?php echo $check?>)">
				<form method="post" action="editImageBoardCommentProcess.php">
					<input type="hidden" name="rno" value="<?php echo $reply['num']; ?>" />
                    <input type="hidden" name="b_no" value="<?php echo $contentNum; ?>"/>
					<input type="text" name="content" value="<?php echo $reply['comment']; ?>"/>
					<input type="submit" name = "submit"value="수정하기">
				</form>
            
			</div>
            <!-- 댓글 삭제 비밀번호 확인 -->
			<div id = "<?php echo 'containerDelete'.$delete ?>" style = 'visibility:hidden' onClick="showCheck(<?php echo $delete?>)">
				<form action="deleteImageBoardComment.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['num']; ?>" /><input type="hidden" name="b_no" value="<?php echo $contentNum; ?>">
                    <p>위의 댓글을 정말 삭제하시겠습니까?</p>
                     <input type="submit" name="cancel"value="취소">
                      <input type="submit" name="ok" value="확인">
				 </form>
			</div><br />
		
       

	<?php } ?>
    <!--- 댓글 입력 폼 -->
	<div class="dap_ins">
			<input type="hidden" name="bno" class="bno" value="<?php echo $contentNum; ?>">
            <p>아이디 : <?=$userid?></p>
			<!-- <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디"> -->
            <input type="hidden" name="dat_user" id="dat_user" class="dat_user" size="20" value=<?=$userid?>>
			<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
	</div>
   
    <script>
            function showElement(num) {    
            element = document.querySelector('#containerEdit'+num); 
            element.style.visibility = "visible"; 

        } 
        function hideElement(num) { 
            element = document.querySelector('#container'+num); 
            element.style.visibility = "hidden"; 
            showElement(num);

        } 
        function showCheck(p){
            element = document.querySelector('#containerDelete'+p); 
            element.style.visibility = "visible"; 
        }
    </script> 
    <!--- 댓글 불러오기 끝 -->
<div id="foot_box"></div>
</div>
        </body>
    </html>