<?php
session_start();
include 'config.php';
include 'dbConnect.php';

//세션에 저장된 아이디값을 name에 저장.
$uid = $userid;
$utime = date('Y-m-d');
$upassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
//앞에서 포스트로 받은 값들 저장.
$utitle = $_POST['title'];
$ucontent = $_POST['content'];
//삭제 시 번호가 비워지지 않게 하기 위해 작성.
database("alter table talkBoard auto_increment = 1");
database(
    "INSERT INTO talkBoard
    (id, password, title, content, time, view) VALUES ('$uid',
    '$upassword',
    '$utitle',
    '$ucontent',
    '$utime', 0)
    ");
   
    echo"
    <script>
    alert('글쓰기가 완료되었습니다.');
    location.href = 'imageBoardPage.php';
</script>  
";
?>
 
<!doctype html>

<body>

</body>

</html>