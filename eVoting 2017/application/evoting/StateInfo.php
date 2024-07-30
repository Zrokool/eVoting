<html>
	<head>
		<title>evoting</title>

	<h1>State Information</h1>
		<body><h3> State Id Listing: </h3></body>
		<form action="home.php">
		<input type="submit" value="Back"></form>
		
		<form action="Logout.php"> 
		<input type="submit" value="Sign Out"></form>
	</head>

</html>


<?php
include 'connect.php';
session_start();
if(empty($_SESSION['is_authenticated']))
{
	
}
	$sql = "select State_Name, State_Num from district_info order by State_Name;";	
	$response = mysql_query($sql,$db);	
	
// If the query executed properly proceed
	if(!$response)
		{
			die('Could not issue database query' . mysql_error());
		}

echo "<table border='2'><tr>";
  $count = 0; 
	while($row = mysql_fetch_array($response, MYSQL_ASSOC))
	{	
		echo "<tr><td>". "{$row['State_Name']}" . ": {$row['State_Num']}" . "</td></tr>";
		$count+1; 
		if ($count == 10 ||  $count == 20 ||  $count == 30 || $count == 40)
		{
			echo "<tr></tr>";
		}
		
	
	}
	
	// Close connection to the database
mysql_close($db);
?>