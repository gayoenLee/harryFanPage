<?php
$comment = $_POST["comment"];
$email = $_POST["email"];
$title = $_POST["title"];
$time = $_POST["time"];

$commentArray = array($title, $email, $comment, $time);
$data = serialize($commentArray);
//rename('imageBoardCommentData/'.$_POST['oldTitle'], 'imageBoardCommentData/'.$_POST['title']);
unlink('imageBoardCommentData/'.$_POST['editTitle']);
file_put_contents('imageBoardCommentData/'.$_POST['editTitle'], $_POST['contents']);
header('Location: /showImageBoardContents.php?title='.$_POST['url']);
?>