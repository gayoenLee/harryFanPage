<?php

include_once "dbConnect.php";

$id = $_POST['id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$name = $_POST['name'];
$email = $_POST['email'];
database(
    "INSERT userProfile SET
id = '$id',
password='$password',
name='$name',
email = '$email'
"
);
echo "
<script>
alert('회원가입이 완료 되었습니다.');
location.href='firstPage.php';
</script>
";
?>
<!doctype html>

<body>

</body>

</html>