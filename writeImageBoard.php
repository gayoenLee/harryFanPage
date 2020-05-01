<?php
session_start();
include "config.php";
include "dbConnect.php";
//아래 코드 지웠더니 로그인 상태 확인됨.
// include "loginOK.php";
//$id = $_POST['id'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charse="UTF-8">
<meta name="viewport" content="width=device-width" initial-scale="1">
    <title>이미지 공유 게시판</title>
    <link rel="stylesheet" type="text/css" href="showImageBoardCSS.css"/>
     <script src="https://code.jquery.com/jquery-3.5.0.min.js" ></script> 
    <script src="/js/login.js">
</script> 
</head>
<body>
    <p>
        <div class="title"><h4>게시판</h4></div>
    </p>
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
    <form action="writeImageProcess.php" method="POST">
        <p>
            <table class="writeTable" style="text-align: center; border: 1px solid #ddddda">
                <thead>
                    <tr>
                        <th colspan="2" style="background-color: #eeeeee; text-align: center;">
                            <h3>게시판 글쓰기</h3>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span>&nbsp;&nbsp;&nbsp;아이디 : <b><?=$userid?></b></span>
                               <b></b></td>
                        </tr>
                        <tr>
                            <input
                                type="text"
                                placeholder="글 제목"
                                name="title"
                                id="title"
                                required="required"></td>
                    </tr>
                    <tr>
                        <td><input
                            type="password"
                            placeholder="글 비밀번호"
                            name="password"
                            id="upassword"
                            style="width: 150px;"></td>
                    </tr>
                    <tr>
                        <td>
                            <textarea
                                placeholder="글 내용"
                                name="content"
                                id="ucontent"
                                style="height: 350px"
                                required="required"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <input type="hidden" name="boardTime" value="<?php echo date("Y-m-d H:i:s");?>"> -->
            <input class="button" type="submit"></input>
        </form>
    </body>

</html>