<?php
	require_once('config.php');
require('dbConnect.php');
	$w = '';
	$coNo = 'null';

	//2depth 수정, 삭제
if(isset($_POST['w'])){
	$w = $_POST['w'];
	$coNo = $_POST['coNo'];
}

//공통 변수
	$contentNum = $_POST['contentNum'];
	$coPassword = $_POST['coPassword'];

	if($w !== 'd'){
		//$w 변수가 d일 경우 $coContent와 $coId가 필요 없음.
		$coContent = $_POST['coContent'];
if($w !== 'u'){
	//$w 변수가 u일 경우 $coId가 필요 없음.
	$coId = $_POST['coId'];
}
	}
	if(empty($w) || $w === 'w'){
		 //$w 변수가 비어있거나 w인 경우
		 $msg = '작성';
		 $sql = "INSERT INTO commentTable 
		 (num, contentNum, id, password, comment, commentOrder)
		 VALUES(null, $contentNum, '$coId', password('$coPassword'), '$coContent', null)";
	//$commentTime = date('Y-m-d H:i:s');
if(empty($w)){
	//$w 변수가 비어있다면,
	$result = $db->query($sql);
	//방금 인서트된 레코드의 프라이머리키값을 가져옴.
	$coNo = $db->insert_id;
	$sql = "update commentTable set commentOrder = num where num = $coNo";
}
	}elseif($w === 'u'){
		//작성
$msg = '수정';
$sql = "select count(*) as count from commentTable where password=password(' $coPassword  ') and num = $num";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	if(empty($row['count'])) {
//맞는 결과가 없을 경우 종료
?>
	<script>
		alert('비밀번호가 맞지 않습니다.');
        history.back();
</script>
<?php
exit;
	}
	$sql = "update commentTable set comment = '$coContent ' where password=password(' $coPassword ') and num = $coNo";
} else if($w === 'd') { //삭제

	$msg = '삭제';
	$sql = "select count(*) as count from commentTable where password=password('$coPassword ') and num = $coNo";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	if(empty($row['count'])) { //맞는 결과가 없을 경우 종료
?>
		<script>
			alert('비밀번호가 맞지 않습니다.');
			history.back();
		</script>
<?php 
		exit;	
	}
	$sql = "delete from commentTable where password=password('$coPassword') and num = $coNo";
} else {
?>
	<script>
		alert('정상적인 경로를 이용해주세요.');
		history.back();
	</script>
<?php 
	exit;
}
$result = $db->query($sql);
if($result) {
?>
	<script>
		alert('댓글이 정상적으로 <?php echo $msg?>되었습니다.');
		location.replace("/showImageBoardContents.php?num=<?php echo $contentNum?>");
	</script>
<?php
} else {
?>
	<script>
		alert('댓글 <?php echo $msg?>에 실패했습니다.');
		history.back();
	</script>
<?php
	exit;
}
?>











