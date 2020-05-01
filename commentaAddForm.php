<form action="commentUpdate.php" method="post">

	<input type="hidden" name="contentNum" value="<?php echo $contentNum?>">

	<table>

		<tbody>

			<tr>

				<th scope="row"><label for="commentId">아이디</label></th>

				<td><input type="text" name="commentId" id="commentId"></td>

			</tr>

			<tr>

				<th scope="row">

			<label for="commentPassword">비밀번호</label></th>

				<td><input type="password" name="commentPassword" id="commentPassword"></td>

			</tr>

			<tr>

				<th scope="row"><label for="commentContent">내용</label></th>

				<td><textarea name="commentContent" id="commentContent"></textarea></td>

			</tr>

		</tbody>

	</table>

	<div class="btnSet">

		<input type="submit" value="댓글 작성">

	</div>

</form>