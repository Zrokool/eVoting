<html>
	<head>
		<title>View Polling Station is you Area</title>
	</head>
	<body>
			<h1>eVoting</h1>
		<form action="MyPollingStation.php" method="Post">
				Enter your Zipcode: </br >

				</br /><input type= "number" name="PollingStationNumber" >

				<input type="Submit" name="Submit" value="Submit"></br /></br>
		</form>	
	</body>
	
	<form action="home.php">
	<input type="submit" value="Back">
	</form>	

	<form action="home.php">
	<input type="Submit" value="Log out">
	</form>

</html>

<?php
include 'connect.php';


if(isset($_POST['Submit'])) 
{
	echo "Locations below are in the area code of " . $_POST['PollingStationNumber'] ;
	echo "<br><br>";
	$PollingStationNumber = $_POST['PollingStationNumber'];
	#echo "Number = " . $PollingStationNumber; 
	 //  Displaying Selected Value
	
	$sql = "Select * from users_polling_station_location where polling_ZipCode = $PollingStationNumber";

	$response = mysql_query($sql,$db);	
	while($row = mysql_fetch_array($response, MYSQL_ASSOC))
	{	
		echo 
		    "State:{$row['State']}<br>". "City:{$row['City']}<br>".
			"County:{$row['County']}<br>" . "Zipcode:{$row['polling_ZipCode']}<br>".
			"Address:{$row['Address']}<br><br>";
	
	}
mysql_close($db);	

}	

?>
