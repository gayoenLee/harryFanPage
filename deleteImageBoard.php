<?php
include "dbConnect.php";
$contentNum = $_GET['num'];
//받아온 num값을 이용해서 게시글 삭제
database(
    "
    DELETE FROM talkBoard
    WHERE num=$contentNum
    "
);
?>
<script>
alert('선택한 게시글이 삭제되었습니다.');
</script>
<meta http-equiv="refresh" content="0 url=imageBoardPage.php">