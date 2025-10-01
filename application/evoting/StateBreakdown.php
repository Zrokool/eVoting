<?php

include 'connect.php';
//number of votes in a year
$query = "select * from StateBreakDown";	
	
	#mysql_select_db('evoting');	
	$result = mysql_query($query,$db);	
		
?>

<html>
  <head>
  <link rel="stylesheet" href="mrrobot-theme.css">
  <h1> 2012 Presidential Statistics </h1>
  <h3>Statistical Breakdown<h3>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['State Name ', 'Number of Votes'],
	<?php		
			while($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{	
			echo '["' . $row['state_name'] . '", ' . $row['votes'] . '],'; 
			}
			mysql_close($db);


	?>		
        ]);

		
        var options = 
		{
          title: 'Percentage of Voters per State'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
  
		<form action= "home.php">
			<input type="Submit" value="Back">
		</form>
  

</html>
