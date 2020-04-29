<?php
ob_start();
$comment = $_POST["comment"];
$email = $_POST["email"];
$title = $_POST["title"];
$time = $_POST["time"];

$commentArray = array($title, $email, $comment, $time);
$data = serialize($commentArray);

file_put_contents('imageBoardCommentData/'.$time.$title, $data);
//file_put_contents('imageBoardCommentContents/'.$_POST["title"], $_POST["comment"]);
header('Location: /showImageBoardContents.php?title='.$_POST["title"]);

?>
<!-- <!doctype html>
<head></head>
<body>
<form id = "sending" method="POST" action="showImageBoardContents.php?title=.$title">
<input type="hidden" value=$time name="time">
<input type="hidden" value=$email name="email">
<input type="hidden" value="submit">
</form>

<script type="text/javascript">
<this.document.form.getElementById("sending").submit();
</script>
</body>
</html> -->