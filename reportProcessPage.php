<?php
include 'config.php';
include_once 'dbConnect.php';

$contentNum = $_POST['contentNum'];
$boardTitle = $_POST['boardTitle'];
$boardId = $_POST['boardId'];
$reportReason = $_POST['reason'];
if(isset($_POST['message'])){
$reportReason = $_POST['message'];
};
$reportPerson = $_POST['reportPerson'];
$reportDate = 
database(
"INSERT INTO boardReport 
(contentNum, contentTitle, contentWriter, reportPerson, reportReason) 
VALUES($contentNum, '$boardTitle', '$boardId', '$reportPerson', '$reportReason' )
");
echo "
<script>
alert('신고가 접수 되었습니다.');
location.href='imageBoardPage.php';
</script>
";
?>