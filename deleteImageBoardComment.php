<?php
include 'config.php';
include 'dbConnect.php';

$rno = $_POST['rno']; 
$sql = database("select * from commentTable where num='".$rno."'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = database("select * from talkBoard where num='".$bno."'");
$board = $sql2->fetch_array();

$pwk = $_POST['pw'];
$bpw = $reply['pw'];

if(password_verify($pwk, $bpw)) 
	{
		$sql = database("delete from commentTable where num='".$rno."'"); ?>
	<script type="text/javascript">alert('댓글이 삭제되었습니다.'); location.replace("showImageBoardContents?num=<?php echo $board["num"]; ?>");</script>
	<?php 
	}else{ ?>
		<script type="text/javascript">alert('비밀번호가 틀립니다');history.back();</script>
	<?php } ?>
