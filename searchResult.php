<?php 
  include 'dbConnect.php';
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel="stylesheet" type="text/css" href="/css/style.css" />
</head>
<body>
<div id="board_area"> 
<!-- 18.10.11 검색 추가 -->
<?php
 
  /* 검색 변수 */
  $catagory = $_GET['category'];
  $search = $_GET['search'];
?>
  <h1><?php echo $catagory; ?>에서 '<?php echo $search; ?>'검색결과</h1>
  <h4 style="margin-top:30px;"><a href="/">홈으로</a></h4>
    <table class="list-table">
      <thead>
          <tr>
              <th width="70">번호</th>
                <th width="500">제목</th>
                <th width="120">글쓴이</th>
                <th width="100">작성일</th>
                <th width="100">조회수</th>
            </tr>
        </thead>
        <?php
          $sqlSecond = database("select * from talkBoard where $catagory like '%$search%' order by num desc");
          while($talkBoard = $sqlSecond->fetch_array()){
           
          $title=$talkBoard["title"]; 
            if(strlen($title)>30)
              { 
                $title=str_replace($talkBoard["title"],mb_substr($talkBoard["title"],0,30,"utf-8")."...",$talkBoard["title"]);
              }
        
        ?>
      <tbody>
        <tr>
          <td width="70"><?php echo $talkBoard['num']; ?></td>
          <td width="500">
        

        <!--- 추가부분 18.08.01 --->
        <?php
          $boardTime = $board['time']; //$boardtime변수에 board['date']값을 넣음
          $timeNow = date("Y-m-d"); //$timenow변수에 현재 시간 Y-M-D를 넣음
          
          if($boardTime==$timeNow){
            $img = "<img src='/img/new.png' alt='new' title='new' />";
          }else{
            $img ="";
          }
          ?>
        <!--- 추가부분 18.08.01 END -->
        <a href='showImageBoardContents.php?num=<?php echo $talkBoard["num"]; ?>'><span style="background:yellow;"><?php echo $title; }?></span></a></td>
          <td width="120"><?php echo $talkBoard['id']?></td>
          <td width="100"><?php echo $talkBoard['time']?></td>
          <td width="100"><?php echo $talkBoard['view']; ?></td>

        </tr>
      </tbody>
    </table>
    <!-- 18.10.11 검색 추가 -->
    <div id="search_box2">
      <form action="searchResult.php" method="get">
      <select name="catgo">
        <option value="title">제목</option>
        <option value="id">글쓴이</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required"/> <button>검색</button>
    </form>
  </div>
</div>
</body>
</html>
