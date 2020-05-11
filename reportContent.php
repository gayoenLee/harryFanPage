<?php
include "dbConnect.php";
include "config.php";
//신고한 게시글 번호 이전에 포스트값으로 넘겨받음.
$contentNum = $_POST['contentNum'];
//게시글 작성자, 제목  디비에서 가져오기
$boardSql = database(
  "SELECT * FROM talkBoard WHERE num=$contentNum"
);
$boardInfo = $boardSql->fetch_array();
$boardTitle = $boardInfo['title'];
$boardId = $boardInfo['id'];
$etc = 1;

?>

<!DOCTYPE html>
<html lang="ko">
 
  <head>
    <title>게시글 신고하기</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <style>

@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #76b852, #8DC26F);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
    </style>
    <script language="text/javascript"></script>
</head>
<body>
<div class="login-page">
  <div class="form">
      <p class="message"><h3>신고하기</h3></p>
    <p class="message"><h5>제목 :<?=$boardTitle?> </h5></p>
    <p class="message"><h5>작성자 :<?=$boardId?></h5></p>
    <p class="message"><h5>아래에서 대표적인 사유 1개를 선택해주세요</h5></p>

    <form class="login-form" name="reportReason" action="reportProcessPage.php" method="post">
    <!-- 게시글 번호, 제목, 작성자 정보, 신고자 아이디 넘기기 -->
      <input type="hidden" name="contentNum" value=<?=$contentNum?>>
      <input type="hidden" name="boardTitle" value=<?=$boardTitle?>>
      <input type="hidden" name="boardId" value=<?=$boardId?>>
      <input type="hidden" name="reportPerson" value=<?=$userid?>>
      <!-- 신고 사유 선택한 것 넘기기 -->
      <li>
        <label><input type="radio" name="reason" value="부적절한 홍보" checked>부적절한 홍보 게시글</label>
      </li>
      <li>
        <label><input type="radio" name="reason" value="음란성 또는 청소년에게 부적합">음란성 또는 청소년에게 부적합한 내용</label><
      </li>
      <li>
        <label><input type="radio" name="reason" value="명예훼손/사생활 침해 및 저작권 침해등">명예훼손/사생활 침해 및 저작권 침해등</label>
      </li>
      <li>
        <label><input type="radio" name="reason" value="기타" onClick = "showElement(<?php echo $etc?>)">기타</label> </li>
     <!-- 기타 버튼 클릭시에만 입력창나오기 -->
     <div id="<?php echo 'container'.$etc ?>" style="visibility:hidden" onClick="showElement(<?php echo $etc?>)">
     <li><input type="text" name="message" placeholder="해당 신고는 운영자에게 전달됩니다.">
     </li>
     </div>
    </ul>
          <input type="hidden" name="userId" id="userId" value=<?=$userid?>/>
      <button><input type="submit" id="radioButton" name="submit"></button>
      <button type="button" onClick="location.href='mainPage.php'">취소</button>
      <p class="message"> <a href="#">운영원칙 자세히 보기</a></p>
    </form>
  </div>
</div>
<!-- 체크박스중 기타 체크시 아래 사유 입력칸 필요 -->
<script>
function showElement(num){
element = document.querySelector('#container'+num);
element.style.visibility = "visible";
}
function hideElement(num){
  element = document.querySelector('#container'+num);
  element.style.visibility = "hidden";
  showElement(num);
}
</script>

</body>
</html>

