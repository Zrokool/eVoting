<?php

include 'connect.php';
//number of votes in a year
$query = "select * from partystats";	
	
	#mysql_select_db('evoting');	
	$result = mysql_query($query,$db);	
		
?>

<html>
  <head>
  <h1> 2012 Party Statistics </h1>
  <h3> Breakdown Per Party </h3>
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
				echo '["' . $row['party_name'] . '", ' . $row['votes'] . '],'; 
			}
			mysql_close($db);

	?>		
        ]);

		
        var options = 
		{
          title: 'Party Percentages for 2012 Elections'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
  
		<form action= "Loggedin.php">
			<input type="submit" value="Back">
		</form>
  
</html>