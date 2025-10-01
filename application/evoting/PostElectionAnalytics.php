<?php

include 'connect.php';
//number of votes in a year
$query = "select * from VoterBreakDown";	
	
	#mysql_select_db('evoting');	
	$result = mysql_query($query,$db);	
		
?>

<html>
  <head>
  <link rel="stylesheet" href="mrrobot-theme.css">
  <h1> 2012 Presidential Statistics </h1>
  <h3>Based on All Candidates Statistical Breakdown</h3>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Name ', 'Number of Votes'],
	<?php		
			while($row = mysql_fetch_array($result, MYSQL_ASSOC))
			{	
				echo '["' . $row['Name'] . '", ' . $row['TotalVotes'] . '],'; 
			}
			mysql_close($db);

	?>		
        ]);

		
        var options = 
		{
          title: 'Percentage of 2012 Voters'
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
			<input type="submit" value="Back">
		</form>
  

</html>
