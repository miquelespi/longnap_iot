<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <title>IoTfun | Longnap</title>

<style type="text/css">
<!--
body {
  padding: 30px 30px 30px 100px;           /* required to "hide" distance div */
  margin: 0;            /* required to "hide" distance div */
  font-family: Trebuchet MS1, Helvetica, Meiryo UI, MS UI Gothic, sans-serif;

}

h1, h2, h3, body {
  font-size: 17px;
}

h1 {
  margin: 0;
  padding: 0;
}

h2,h3 {
  font-weight: normal;
  display: inline;
}

ul {
  margin: 0;
  padding: 0;
  padding-top:10px;
}

ul li {
  list-style: none;
  padding: 0px 0px 0px 0px;
  margin: 0px;
  display: inline;
}

a {
  text-decoration:none;
  color: #070;
}

a:hover {
  color: #666;
}

.chart {
width:900px;
height:300px;
}

input {
font-size: 17px;
}

@media screen and (max-width:1024px) {
  body {
    padding: 10px;
    font-size:150%;
  }

  .chart {
    width: 100%;
  }
}


.last24 {
background-color: green;
color:white;
padding:2px;
}

a.last24:hover {
background-color:black;
color: white;
}

#ui-datepicker-div {
background-color:white;
border:1px solid green;
}


-->
</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/i18n/jquery-ui-i18n.min.js"></script>


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(initialize);
      function initialize() {
<?php if (isset($_GET['date'])) { ?>
var checkdate = new Date('<?php echo date('Y-m-d'); ?>');
<?php } else { ?>
var checkdate = new Date();
<?php } ?>


<?php if (isset($_GET['date'])) { ?>
        var query1 = new google.visualization.Query('http://spreadsheets.google.com/tq?key=16jJ08EWMqQvMe4dK2nX6f67gSbNiHUKcnrGyH4fnv78&pub=1');
        query1.setQuery("select A, B where toDate(A) = date '<?php echo date($_GET['date']); ?>'");
        query1.send(drawChart1);
        var query2 = new google.visualization.Query('http://spreadsheets.google.com/tq?key=16jJ08EWMqQvMe4dK2nX6f67gSbNiHUKcnrGyH4fnv78&pub=1');
        query2.setQuery("select A, C where toDate(A) = date '<?php echo date($_GET['date']); ?>'");
        query2.send(drawChart2);
<?php } else { ?>
var currentdate = new Date();
currentdate.setDate(currentdate.getDate() - 1)
var datetime = currentdate.getFullYear() + "-"
                + ("0"+(currentdate.getMonth()+1)).slice(-2) + "-"
                + ("0"+currentdate.getDate()).slice(-2) + " "
                + ("0"+(currentdate.getHours())).slice(-2) + ":"
                + ("0"+currentdate.getMinutes()).slice(-2) + ":"
                + ("0"+currentdate.getSeconds()).slice(-2) + ".000";

        var query1 = new google.visualization.Query('http://spreadsheets.google.com/tq?key=16jJ08EWMqQvMe4dK2nX6f67gSbNiHUKcnrGyH4fnv78&pub=1');
        query1.setQuery("select A, B where A >= datetime '"+datetime+"'");
        query1.send(drawChart1);
        var query2 = new google.visualization.Query('http://spreadsheets.google.com/tq?key=16jJ08EWMqQvMe4dK2nX6f67gSbNiHUKcnrGyH4fnv78&pub=1');
        query2.setQuery("select A, C where A >= datetime '"+datetime+"'");
        query2.send(drawChart2);
<?php } ?>
      }

      function drawChart1(response) {

        var data = response.getDataTable();
        var options = {
          title: 'Sensor 1: Temperature (C)',
          curveType: 'function',
          hAxis: {title: 'Time',  titleTextStyle: {color: '#333'}},
          legend: 'none',
colors: ['#0000ff']
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }


      function drawChart2(response) {

        var data = response.getDataTable();
        var options = {
          title: 'Sensor 1: Humidity (%)',
          curveType: 'function',
          hAxis: {title: 'Time',  titleTextStyle: {color: '#333'}},
          legend: 'none',
colors: ['#ff0000']
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }

    </script>

</head>
<body>

  <h1><a href="http://longnap.com">Longnap</a> &raquo; IoT fun</h1>

  <ul>
    <li><h3><form>
  <input type="date" value="<?php if (isset($_GET['date'])) {echo date($_GET['date']);} else {echo date('Y-m-d');} ?>" name="date" id="date"> <input type="submit" value="load"> <a href="/" class="last24" >See last 24h</a>
</form><h3></li>
  </ul>

<p><div id="chart_div1" class="chart"></div></p>
<p><div id="chart_div2" class="chart"></div></p>

<script>
if ( $('#date').type != 'date') {
    $('#date').datepicker({ dateFormat: 'yy-mm-dd' });
}
</script>

</body>
</html>
