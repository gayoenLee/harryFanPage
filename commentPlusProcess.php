<?php
include 'config.php';
include 'dbConnect.php';

    $bno = $_POST['bno'];
	$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
	$sql = database("insert into commentTable(contentNum,id,password,comment) values('".$bno."','".$_POST['dat_user']."','".$userpw."','".$_POST['content']."')");


?>
	<script type="text/javascript">location.replace("showImageBoardContents.php?num=<?php echo $bno; ?>");</script>

