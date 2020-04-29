<?php
rename('imageBoardData/'.$_POST['oldTitle'], 'imageBoardData/'.$_POST['title']);
$userName=$_POST['userName'];
$contents=$_POST['contents'];
$title=$_POST['title'];
$password=$_POST['password'];
$time = $_POST['time'];

$boardArray = array($title, $userName, $contents, $password, $time);
$data = serialize($boardArray);

file_put_contents('imageBoardData/'.$_POST["title"], $data);
header('Location: /imageBoardPage.php?id='.$_POST['title']);
?>