<?php
session_start();
$id = $_POST['id'];
$password = $_POST['password'];
//서버에 접속하기 위해 필요
$connect = mysqli_connect("127.0.0.1", "root", "Dlrkdus0607", "harrypotter");



$sql = "SELECT * FROM userProfile WHERE id='$id'";

$result = mysqli_query($connect, $sql);

$numberMatch = mysqli_num_rows($result);

if (!$numberMatch) {
    echo ("
    <script>
    window.alert('등록되지 않은 아이디입니다.')
    history.go(-1)
    </script>");
} else {
    $row = mysqli_fetch_array($result);
    $dbPassword = $row['password'];

    

    if (!password_verify($password, $dbPassword)) {
        echo ("
        <script>
        window.alert('비밀번호가 틀립니다.')
        history.go(-1)
        </script>");
        exit;
    } else {
        $_SESSION['userid'] = $row['id'];
        $_SESSION['username'] = $row['name'];
        echo("<script>
            location.href = 'mainPage.php';
            </script>  " ); }

}
  
?>