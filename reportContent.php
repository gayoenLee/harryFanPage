<?php
include "dbConnect.php";
include "config.php";
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
    <script language="text/javascript">
    var category

    </script>
</head>
<body>
<div class="login-page">
  <div class="form">
    
      <p class="message"><h3>신고하기</h3></p>
    <p class="message"><h5>제목 : 글 제목</h5></p>
    <p class="message"><h5>작성자 : 작성자 정보</h5></p>
    <p class="message"><h5>아래에서 대표적인 사유 1개를 선택해주세요</h5></p>

    <form class="login-form" action="reportProcessPage.php" method="post">
      <input type="text" placeholder="신고자 이름" name="userName" id="userName"/>
      <li>
        <input type="radio" name="radioTxt" value="Apple" checked>부적절한 홍보 게시글
      </li>
      <li>
        <input type="radio" name="radioTxt" value="Grape">음란성 또는 청소년에게 부적합한 내용
      </li>
      <li>
        <input type="radio" name="radioTxt" value="Banana">명예훼손/사생활 침해 및 저작권 침해등
      </li>
      <li>
        <input type="radio" name="radioTxt" value="Banana">기타
      </li>
      <input type="text" name="message" placeholder="해당 신고는 운영자에게 전달됩니다.">
    </ul>
          <input type="hidden" name="userId" id="userId" value="$userid"/>
      <button><input type="submit" id="radioButton" name="submit"value="신고"></button>
      <button><input type="submit" id="radioButton2" name="submit"value="취소"></button>

      <p class="message"> <a href="#">운영원칙 자세히 보기</a></p>
    </form>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#radioButton').click(function()){
    //get
    var radioval = $('input[name="radioTxt"]:checked').val();
    $('#radioButton2').click(function () {
          // setter
          // 선택한 부분을 세팅할 수 있다.
          $('input[name="radioTxt"]').val(['Banana']);
        });
});


</script>
</body>


  </body>
</html>

