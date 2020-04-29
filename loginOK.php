<?php
$id = $_POST['id'];
$password = $_POST['password'];

$connect = mysqli_connect("localhost", "root", "Dlrkdus0607", "harrypotter");
$sql = "SELECT * FROM userProfile WHERE id='$id'";

$result = mysqli_query($connect, $sql);

$numberMatch = mysqli_num_rows($result);

if(!$numberMatch){
    echo("
    <script>
    window.alert('등록되지 않은 아이디입니다.')
    history.go(-1)
    </script>");
}else{
    $row = mysqli_fetch_array($result);
    $dbPassword = $row['password'];

    mysqli_close($db);

    if(!password_verify($password, $dbPassword)){
        echo("
        <script>
        window.alert('비밀번호가 틀립니다.')
        history.go(-1)
        </script>");
        exit;
    }else{
        session_start();
        $_SESSION["userid"] = $row["id"];
        $_SESSION["username"] = $row["name"];
        echo(
            "<script>
            location.href = 'imageBoardPage.php';
            </script>
            "
        );
    }
}
