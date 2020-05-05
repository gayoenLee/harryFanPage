<?php
	$sql = "select * from commentTable where num=commentOrder and contentNum=$contentNum";
	$result = $db->query($sql);
?>
<div id="commentView">
<form action="commentUpdate.php" method="post">
		<input type="hidden" name="contentNum" value="<?php echo $talkBoard['num']?>">
	<?php
	//fetch_assoc : 쿼리를 통해 얻은 리절트에서 레코드를 1개씩 리턴해줌. 연관 배열이 특징.
		while($row = $result->fetch_assoc()) {
	?>
	<ul class="oneDepth">
		<li>
		<div id="co_<?php echo $row['num']?>" class="commentSet">
					<div class="commentInfo">
						<div class="commentId">작성자: <span class="coId"><?php echo $row['id']?></span></div>
						<div class="commentBtn">
							<a href="#" class="comt write">댓글</a>
							<a href="#" class="comt modify">수정</a>
							<a href="#" class="comt delete">삭제</a>
						</div>
					</div>
					<div class="commentContent"><?php echo $row['comment']?>
					</div>
				</div>
			<!-- <div>
				<span>작성자: <?php echo $row['id']?></span>
				<p><?php echo $row['comment']?></p>
			</div> -->
			<?php
				$sqlSecond = "select * from commentTable where num!=commentOrder and commentOrder=$row[num]";
				$resultSecond = $db->query($sqlSecond);
				while($rowSecond = $resultSecond->fetch_assoc()) {
			?>
			<ul class="twoDepth">
				<li>
				<div id="co_<?php echo $rowSecond[num]?>" class="commentSet">
							<div class="commentInfo">
								<div class="commentId">작성자:  <span class="coId"><?php echo $rowSecond['id']?></span></div>
								<div class="commentBtn">
									<a href="#" class="comt modify">수정</a>
									<a href="#" class="comt delete">삭제</a>
								</div>
							</div>
							<div class="commentContent"><?php echo $rowSecond['comment'] ?></div>
						</div>
					<!-- <div>
						<span>작성자: <?php echo $rowSecond['id']?></span>
						<p><?php echo $rowSecond['comment'] ?></p>
					</div> -->
				</li>
			</ul>
			<?php
				}
			?>
		</li>
	</ul>
	<?php } ?>
	</form>
</div>
<form action="commentUpdate.php" method="post">
	<input type="hidden" name="contentNum" value="<?php echo $contentNum?>">

	<table>
		<tbody>
			<tr>
				<th scope="row"><label for="coId">아이디</label></th>
				<td><input type="text" name="coId" id="coId"></td>
			</tr>
			<tr>
				<th scope="row">
			<label for="coPassword">비밀번호</label></th>
				<td><input type="password" name="coPassword" id="coPassword"></td>
			</tr>
			<tr>
				<th scope="row"><label for="coContent">내용</label></th>
				<td><textarea name="coContent" id="coContent"></textarea></td>
			</tr>
		</tbody>
	</table>
	<div class="btnSet">
		<input type="submit" value="댓글 작성">
	</div>
</form>
<script>
	$(document).ready(function () {
		var action = '';
		$('#commentView').delegate('.comt', 'click', function () {
			//현재 위치에서 가장 가까운 commentSet 클래스를 변수에 넣는다.
			var thisParent = $(this).parents('.commentSet');
			//현재 작성 내용을 변수에 넣고, active 클래스 추가.
			var commentSet = thisParent.html();
			thisParent.addClass('active');
			//취소 버튼
			var commentBtn = '<a href="#" class="addComt cancel">취소</a>';
			//버튼 삭제 & 추가
			$('.comt').hide();
			$(this).parents('.commentBtn').append(commentBtn);
			//commentInfo의 ID를 가져온다.
			var num = thisParent.attr('id');
			//전체 길이에서 3("co_")를 뺀 나머지가 co_no
			num = num.substr(3, num.length);

			
			//변수 초기화
			var comment = '';
			var coId = '';
			var coContent = '';
			if($(this).hasClass('write')) {
				//댓글 쓰기
				action = 'w';
				//ID 영역 출력
				coId = '<input type="text" name="coId" id="coId">';	
			} else if($(this).hasClass('modify')) {
				//댓글 수정
				action = 'u';				
				coId = thisParent.find('.coId').text();
				var coContent = thisParent.find('.commentContent').text();
			} else if($(this).hasClass('delete')) {
				//댓글 삭제	
				action = 'd';
			}
				comment += '<div class="writeComment">';
				comment += '	<input type="hidden" name="w" value="' + action + '">';
				//확인~~~~~~~~~~
				comment += '	<input type="hidden" name="num" value="' + num + '">';
				
				comment += '	<table>';
				comment += '		<tbody>';
				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coId">아이디</label></th>';
					comment += '				<td>' + coId + '</td>';
					comment += '			</tr>';
				}
				comment += '			<tr>';
				comment += '				<th scope="row">';
				comment += '			<label for="coPassword">비밀번호</label></th>';
				comment += '				<td><input type="password" name="coPassword" id="coPassword"></td>';
				comment += '			</tr>';				
				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coContent">내용</label></th>';
					comment += '				<td><textarea name="coContent" id="coContent">' + coContent + '</textarea></td>';
					comment += '			</tr>';
				}
				comment += '		</tbody>';
				comment += '	</table>';
				comment += '	<div class="btnSet">';
				comment += '		<input type="submit" value="확인">';
				comment += '	</div>';
				comment += '</div>';
				thisParent.after(comment);
			return false;
		});
		$('#commentView').delegate(".cancel", "click", function () {
				$('.writeComment').remove();
				$('.commentSet.active').removeClass('active');
				$('.addComt').remove();
				$('.comt').show();
			return false;
		});
	});
</script>