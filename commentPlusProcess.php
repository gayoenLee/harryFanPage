<?php
include 'config.php';
include 'dbConnect.php';

    $bno = $_POST['bno'];
	$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
	$sql = database("insert into commentTable(contentNum,id,password,comment) values('".$bno."','".$_POST['dat_user']."','".$userpw."','".$_POST['content']."')");
?>
<script type="text/javascript" src="js/common.js"></script>

	<h3>댓글목록</h3>
		<?php
			$sql3 = database("select * from commentTable where contentNum='".$bno."' order by num desc");
			while($reply = $sql3->fetch_array()){ 
		?>
		<div class="dap_lo">
			<div><b><?php echo $reply['id'];?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[comment]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
			<div class="rep_me rep_menu">
				<a class="dat_edit_bt" href="#">수정</a>
				<a class="dat_delete_bt" href="#">삭제</a>
			</div>
			<!-- 댓글 수정 폼 dialog -->
			<div class="dat_edit">
				<form method="post" action="editImageBoardCommentProcess.php">
					<input type="hidden" name="rno" value="<?php echo $reply['num']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
					<input type="password" name="pw" class="dap_sm" placeholder="비밀번호" />
					<textarea name="content" class="dap_edit_t"><?php echo $reply['comment']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>
			<!-- 댓글 삭제 비밀번호 확인 -->
			<div class='dat_delete'>
				<form action="deleteImageBoardComment.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['num']; ?>" /><input type="hidden" name="b_no" value="<?php echo $bno; ?>">
			 		<p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인"></p>
				 </form>
			</div>
		</div>
	<?php } ?>

	<!--- 댓글 입력 폼 -->
	<div class="dap_ins">
		<form method="post" class="reply_form">
			<input type="hidden" name="bno" value="<?php echo $bno; ?>">
			<input type="text" name="dat_user" id="dat_user" size="15" placeholder="아이디">
			<input type="password" name="dat_pw" id="dat_pw" size="15" placeholder="비밀번호">
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button type="submit" id="rep_bt" class="re_bt">댓글</button>
			</div>