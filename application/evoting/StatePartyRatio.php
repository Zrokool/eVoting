<html>
  <head>
  <link rel="stylesheet" href="mrrobot-theme.css">
  <h1> 2012 Presidential Statistics </h1>
  <h3>Statistical Breakdown</h3>
<Body> List of States and Associated Party with total number of votes for 2012 Presidential Elections.
		<form action= "home.php">
			<input type="Submit" value="Back">
		</form>
		
<form action = "Logout.php" >

<input type="submit" value="Sign Out">
	
</form>

		
</body>
  </head> 
  <?php

include 'connect.php';
//number of votes in a year

$query = "select * from StateBreakDown";	
	
mysql_select_db('evoting');	
$result = mysql_query($query,$db);	

echo "<table border='2'><tr>";		

	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{	
		echo "<tr><td>" . $row["state_name"] .  " is a ". $row["party"] . " with a total Number of Voters:  ".  $row["votes"] . "</br></br></td></tr>" ;
	}
mysql_close($db);
?>


</html>
