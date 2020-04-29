<?php
unlink('imageBoardData/'.$_POST["time"].$_POST["title"]);
header('Location: /imageBoardPage.php');
?>