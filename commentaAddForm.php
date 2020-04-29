<?php
// $test = $_GET["title"];
// $comment = $_POST["comment"];
// $email = $_POST["email"];
// $title = $_POST["time"]+$_POST["title"];
// $time = $_POST["time"];
// 데이터 받기
//$data = file_get_contents("imageBoardCommentData/".$date);
//$array = unserialize($data);


?>
<!-- 댓글 추가되는 곳 -->
<!doctype html>
<body>
<div>
<p>

   <div>
    <?php
                       // echo $_POST["email"];
                   
                    echo printCommentList();
                           // echo $date;
                            ?>
                            </div>
</p>
</div>


</body>
</html>