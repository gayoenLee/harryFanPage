<?php
include 'dbConnect.php';

$rno = $_POST['rno']; 
$sql = database("select * from commentTable where num=$rno");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = database("select * from talkBoard where num=$bno");
$board = $sql2->fetch_array();

$sql3 = database("update commentTable set comment='".$_POST['content']."' where num = $rno"); ?>
<script type="text/javascript">alert('수정되었습니다.'); location.replace("showImageBoardContents.php?num=<?php echo $bno; ?>");</script>

