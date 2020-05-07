
<?php
include 'dbConnect.php';

$browserTotal = database(
  "SELECT COUNT(browser) from statistics"
);
$sqlMozila = database(
  "SELECT COUNT(browser) from statistics WHERE browser='Mozilla Firefox'"
);
$mozilaResult = mysqli_fetch_array($sqlMozila);
$check = $mozilaResult[0];

$sqlChrome = database(
  "SELECT COUNT(browser) from statistics WHERE browser='Google Chrome'"
);
$sqlSafari = database(
"SELECT COUNT(browser) from statistics WHERE browser='Apple Safari'" 
);
//os
$osTotal = database(
  "SELECT COUNT(os) from statistics"
);
$sqlLinux = database(
  "SELECT COUNT(os) from statistics WHERE os='linux'"
);
$sqlMac = database(
  "SELECT COUNT(os) from statistics WHERE os='mac'"
);
$sqlWindow = database(
  "SELECT COUNT(os) from statistics WHERE os='win32'"
);
$browserOthers = $browserTotal - $sqlChrome - $sqlLinux - $sqlMozila;
$osOthers = $osTotal - $sqlLinux - $sqlMac - $sqlWindow;

?>

<!doctype html>
<html>
  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
          ['Mozila',    <?echo($check)?>],
          ['Chrome',  <?echo($check)?>],
          ['Safari', <?echo($check)?>],
          ['Others', 0]
        
        ]);

        var optionsDevice = {
          title: 'DEVICE'
        };

        var chartDevice = new google.visualization.PieChart(document.getElementById('piechartDevice'));

        chartDevice.draw(dataDevice, optionsDevice);
      }



      function drawChartOS() {

var dataOS = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work',     11],
  ['Eat',      2],
  ['Commute',  2],
  ['Watch TV', 2],
  ['Sleep',    7]
]);

var optionsOS = {
  title: 'OS'
};

var chartOS = new google.visualization.PieChart(document.getElementById('piechartOS'));

chartOS.draw(dataOS, optionsOS);
}

function drawChartBrowser() {

var dataBrowser = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Work',     11],
  ['Eat',      2],
  ['Commute',  2],
  ['Watch TV', 2],
  ['Sleep',    7]
]);

var optionsBrowser = {
  title: 'Browser'
};

var chartBrowser = new google.visualization.PieChart(document.getElementById('piechartBrowser'));

chartBrowser.draw(dataBrowser, optionsBrowser);
}

    </script>
</head>
<body>
<div id="piechartDevice" style="width: 900px; height: 500px;"></div>
<div id="piechartOS" style="width: 900px; height: 500px;"></div>
<div id="piechartBrowser" style="width: 900px; height: 500px;"></div>

  </body>
</html>