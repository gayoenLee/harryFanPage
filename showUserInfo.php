
<?php
include 'dbConnect.php';

$browserTotal = database(
  "SELECT COUNT(browser) from statistics"
);
$browserTotal = mysqli_fetch_array($browserTotal);
$browser = $browserTotal[0];
//모질라
$sqlMozila = database(
  "SELECT COUNT(browser) from statistics WHERE browser='Mozilla Firefox'"
);
$mozilaResult = mysqli_fetch_array($sqlMozila);
$mozila = $mozilaResult[0];
//크롬
$sqlChrome = database(
  "SELECT COUNT(browser) from statistics WHERE browser='Google Chrome'"
);
$chromeResult = mysqli_fetch_array($sqlChrome);
$chrome = $chromeResult[0];
//사파리
$sqlSafari = database(
"SELECT COUNT(browser) from statistics WHERE browser='Apple Safari'" 
);
$safariResult = mysqli_fetch_array($sqlSafari);
$safari = $safariResult[0];
////////os 카테고리
$osTotal = database(
  "SELECT COUNT(os) from statistics"
);
$osTotal = mysqli_fetch_array($osTotal);
$os = $osTotal[0];

$sqlLinux = database(
  "SELECT COUNT(os) from statistics WHERE os='linux'"
);

$linuxResult = mysqli_fetch_array($sqlLinux);
$linux = $linuxResult[0];
$sqlMac = database(
  "SELECT COUNT(os) from statistics WHERE os='mac'"
);
$macResult = mysqli_fetch_array($sqlMac);
$mac = $macResult[0];
$sqlWindow = database(
  "SELECT COUNT(os) from statistics WHERE os='windows'"
);
$windowResult = mysqli_fetch_array($sqlWindow);
$window = $windowResult[0];
$browserOthers = $browser - $mozila - $chrome - $safari;
$osOthers = $os - $linux - $mac - $window;

// 요일별로 언제 많이 들어왔는지 알아보기 위해 데이터베이스 이용하기
$sqlMonday = database(
  "SELECT COUNT(dayOfWeek) from statistics WHERE dayOfWeek='월요일'"
);
$mondayResult = mysqli_fetch_array($sqlMonday);
$monday = $mondayResult[0];
//화
$sqlTuesday = database(
  "SELECT COUNT(dayOfWeek) from statistics WHERE dayOfWeek='화요일'"
);
$tuesdayResult = mysqli_fetch_array($sqlTuesday);
$tuesday = $tuesdayResult[0];
//수요일
$sqlWednesday = database(
  "SELECT COUNT(dayOfWeek) from statistics WHERE dayOfWeek='수요일'"
);
$wednesdayResult = mysqli_fetch_array($sqlWednesday);
$wednesday = $wednesdayResult[0];
//목요일
$sqlThursday = database(
  "SELECT COUNT(dayOfWeek) from statistics WHERE dayOfWeek='목요일'"
);
$thursdayResult = mysqli_fetch_array($sqlThursday);
$thursday = $thursdayResult[0];
//금요일
$sqlFriday = database(
  "SELECT COUNT(dayOfWeek) from statistics WHERE dayOfWeek='금요일'"
);
$fridayResult = mysqli_fetch_array($sqlFriday);
$friday = $fridayResult[0];
//토요일
$sqlSaturday = database(
  "SELECT COUNT(dayOfWeek) from statistics WHERE dayOfWeek='토요일'"
);
$saturdayResult = mysqli_fetch_array($sqlSaturday);
$saturday = $saturdayResult[0];
//일요일
$sqlSunday = database(
  "SELECT COUNT(dayOfWeek) from statistics WHERE dayOfWeek='일요일'"
);
$sundayResult = mysqli_fetch_array($sqlSunday);
$sunday = $sundayResult[0];

?>

<!doctype html>
<html>
  <head>
           <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-165857365-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-165857365-1');
</script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.0.min.js">
  $(function () {
 
 $(".tab_content").hide();
 $(".tab_content:first").show();

 $("ul.tabs li").click(function () {
     $("ul.tabs li").removeClass("active").css("color", "#333");
     //$(this).addClass("active").css({"color": "darkred","font-weight": "bolder"});
     $(this).addClass("active").css("color", "darkred");
     $(".tab_content").hide()
     var activeTab = $(this).attr("rel");
     $("#" + activeTab).fadeIn()
 });
});
  </script>
  <style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600);

*, *:before, *:after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: #105469;
  font-family: 'Open Sans', sans-serif;
}
table {
  background: #012B39;
  border-radius: 0.25em;
  border-collapse: collapse;
  margin: 1em;
}
th {
  border-bottom: 1px solid #364043;
  color: #E2B842;
  font-size: 0.85em;
  font-weight: 600;
  padding: 0.5em 1em;
  text-align: left;
}
td {
  color: #fff;
  font-weight: 400;
  padding: 0.65em 1em;
}
.disabled td {
  color: #4F5F64;
}
tbody tr {
  transition: background 0.25s ease;
}
tbody tr:hover {
  background: #014055;
}

  </style>

  <link rel="stylesheet" href="imageBoardPageCSS.css"> 
<link rel="stylesheet" href="showUserInfoCSS.css">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartDevice);
      google.charts.setOnLoadCallback(drawChartOS);
      google.charts.setOnLoadCallback(drawChartBrowser);

      var mozila = '<?$countResult["COUNT(browser)"];?>'
      console.log(mozila);

      function drawChartDevice() {
        var dataDevice = google.visualization.arrayToDataTable([
          ['Browser', 'Hours per Day'],
          ['Mozila',    <?echo($mozila)?>],
          ['Chrome',  <?echo($chrome)?>],
          ['Safari', <?echo($safari)?>],
          ['Others', <?echo($browserOthers)?>]
        ]);
        var optionsDevice = {
          title: 'DEVICE'
        };
        var chartDevice = new google.visualization.PieChart(document.getElementById('piechartDevice'));
        chartDevice.draw(dataDevice, optionsDevice);
      }

      //os통계 그래프
      function drawChartOS() {
var dataOS = google.visualization.arrayToDataTable([
  ['OS', 'Hours per Day'],
  ['Linux', <?echo($linux)?>],
  ['Mac', <?echo($mac)?>],
  ['Window', <?echo($window)?>],
  ['Others', <?echo($osOthers)?>],
]);
var optionsOS = {
  title: 'OS'
};
var chartOS = new google.visualization.PieChart(document.getElementById('piechartOS'));
chartOS.draw(dataOS, optionsOS);
}

function drawChartBrowser() {
var dataBrowser = google.visualization.arrayToDataTable([
  ['DAYS', 'Hours per Day'],
  ['월',  <?echo($monday)?>],
  ['화',    <?echo($tuesday)?>],
  ['수',  <?echo($wednesday)?>],
  ['목', <?echo($thursday)?>],
  ['금',  <?echo($friday)?>],
  ['토', <?echo($saturday)?>],
  ['일', <?echo($sunday)?>]
]);
var optionsBrowser = {
  title: 'Days'
};
var chartBrowser = new google.visualization.PieChart(document.getElementById('piechartBrowser'));
chartBrowser.draw(dataBrowser, optionsBrowser);
}
    </script>
    
</head>
<body>
  
<nav id="siteNavigation" class="mainNavigation" role="navigation">
			<div class="navMenu"><ul>
<li><a href="http://192.168.56.101/mainPage.php">홈</a></li>
<li ><a href="http://192.168.56.101/imageBoardPage.php">게시판</a></li>
<li ><a href="http://192.168.56.101/mainPage.php">최근 뉴스</a></li>
<li ><a href="http://192.168.56.101/showVideo.php">영상</a></li>
<?php
    //로그인한 계정이 관리자일 경우
if($userid=='admin67'){
    ?>
    <ul>
    <li ><a href="http://192.168.56.101/showUserInfo.php">관리자 페이지</a></li>
    <li>
    관리자님
    <span class="caret"></span></a></li></ul>
<ul>
<li><a href="logout.php">로그아웃</a></li>
</ul>
<?php
}
                if($userid){
                    ?>
                    <ul>
                    <li>
                    <a href='#' role="button">접속하기<span class="caret"></span></a>
                    <ul>
                    <li><a href="login.php">로그인</a></li>
                    </li>
                    <li><a href="joinMember.php">회원가입</a></li>
                    </ul>
                    </li>
                    </ul>
                    <?php
                }
                    ?>
                   </div> 
		</nav>
    <h1>관리자 페이지</h1>
 <div class="main">
 <input id="tab1" type="radio" name="tabs" checked>

 <label for="tab1">홈페이지 정보</label>
 <input id="tab2" type="radio" name="tabs">
 <label for="tab2">게시글 신고 접수</label>
 <input id="tab3" type="radio" name="tabs">
 <label for="tab3">tab menu1</label>
 <input id="tab4" type="radio" name="tabs">
 <label for="tab4">tab menu1</label>
 <section id="content1">
 <p><div class="chart" id="piechartDevice" style="width: 600px; height: 500px;"></div>
<div  class="chart" id="piechartOS" style="width: 600px; height: 500px;"></div>
<div class="chart"  id="piechartBrowser" style="width: 600px; height: 500px;"></div></p>
 </section>
 <section id="content2">

 <p><h3>게시글 신고 접수 현황</h3>
 <table>
 <thead>
 <tr>
 <th>글 번호 
 <th>제목 
<th>작성자 
 <th>신고자 
<th>신고일  
 <th>신고 사유  
 </thead>
 <?php
//신고한 게시글 정보 가져오기
$reportSql = database(
  "SELECT * FROM boardReport order by num ");
  
while($reportInfo = $reportSql->fetch_array()){
  $contentNum = $reportInfo['contentNum'];
  $contentTitle = $reportInfo['contentTitle'];
  $contentWriter = $reportInfo['contentWriter'];
  $reportPerson = $reportInfo['reportPerson'];
  $reportReason = $reportInfo['reportReason'];
  $reportDate = $reportInfo['reportDate'];
 ?>
 <tbody>
 <tr>
      <td> <?=$contentNum?>
      <td><?=$contentTitle?>
      <td><?=$contentWriter?>
      <td><?=$reportPerson?>
      <td><?=$reportDate?>
      <td><?=$reportReason?>
 <?}?>
 </tbody>
 </table>
 </p>
 </section>
  <section id="content3">
 <p>tab menu1의 내용</p>
 </section> 
 <section id="content4">
 <p>tab menu1의 내용</p>
 </section>
 
 </div>


  </body>
</html>