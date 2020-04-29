<?php
file_put_contents('imageBoardCommentData/'.$_POST['email'], $_POST['comment']);
header('Location: /showImageBoardContents.php'
);
?>

