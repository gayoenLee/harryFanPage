<?php
ob_start();
$userName=$_POST['userName'];
$contents=$_POST['contents'];
$title=$_POST['title'];
$password=$_POST['password'];
$boardTime=$_POST['boardTime'];

$boardArray = array($title, $userName, $contents, $password, $boardTime);
$data = serialize($boardArray);

file_put_contents('imageBoardData/'.$_POST["title"], $data);
header('Location: /imageBoardPage.php?title='.$_POST["title"]);

?>