<?php
include "config.php";
include "dbConnect.php";
$contentNum = $_POST['num'];
$time = date('Y-m-d');
//받아온  num값을 선택해서 게시글 수정.
database(
    "UPDATE talkBoard SET
    time = '$time',
    title = '{$_POST['title']}',
    content = '{$_POST['content']}'
    WHERE num = $contentNum
    "
    );
?>
<script>
alert("수정되었습니다.");
</script>
<meta http-equiv="refresh" content="0 url=/imageBoardPage.php">