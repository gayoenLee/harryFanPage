<?php

unlink('imageBoardCommentData/'.$_GET['title']);
header('Location: /showImageBoardContents.php?title='.$_GET['pageTitle']);
?>