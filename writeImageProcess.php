<?php
// ob_start();
// $userName=$_POST['userName'];
// $contents=$_POST['contents'];
// $title=$_POST['title'];
// $password=$_POST['password'];
// $boardTime=$_POST['boardTime'];

// $boardArray = array($title, $userName, $contents, $password, $boardTime);
// $data = serialize($boardArray);

// file_put_contents('imageBoardData/'.$_POST["title"], $data);
// header('Location: /imageBoardPage.php?title='.$_POST["title"]);
session_start();
include "config.php";
include "dbConnect.php";
//세션에 저장된 아이디값을 name에 저장.
$name = $userid;
$date = date('Y-m-d');
$userPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
//앞에서 포스트로 받은 값들 저장.
$title = $_POST['title'];
$content = $_POST['content'];

database(
    "INSERT talkBoard SET 
    name = '".$name."';
    password = '".$userPassword."';
    title = '".$title."';
    content = '".$content."';
    time = '".$date."';
");

?>
<script>
    alert("글쓰기가 완료되었습니다.");
    location.href = 'imageBoardPage.php';
</script>