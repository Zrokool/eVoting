<?php 
session_start();
if(empty($_SESSION['is_authenticated']))
{
	
}
?>
<html>
	<head>
		<title>Admin View</title>
	</head>
	<body>

		<h1>eVoting System Controls</h1>
		<h3>System Maintances </h3>
<!--button to go to another page-->

	</body>
	<body>
		Select the Number of rows in the database you would like to view:
	</body>
	<form action="AdminCodeStuff.php" method="post">
			</br><input type= "text" name="Limit" /></br></br>
			<input type= "submit" name= "submit" />
			</br>*** Database Sorts user by first name</br>
	<!--registration hyperlink -->
	   </form>	

	<form action="AdminCode.php">
	Navigate to main page: 
	<input type="submit" value="Back">
	</form>	

	   </br />
</html>
<?php
include 'connect.php';

#session_start();

if(empty($_SESSION['is_authenticated']))
{
	
}
echo "Batch List of Users Information to Troubleshoot Voters Lost \n \n";

if (isset($_POST['submit'])) 
{
	$Limit = $_POST['Limit'];
	
	 //  Displaying Selected Value
	
	$sql = mysql_query(" Select * from Admin_UsernameCheck");	
	#mysql_select_db('evoting');
	#$response = mysql_query($sql,$db);	
	// If the query executed properly proceed
	if(!$sql)
		{
			die('Could not issue database query' . mysql_error());
		}

	while($row = mysql_fetch_array($sql, MYSQL_ASSOC))
	{	
		echo 
		
			"<br>Full Name: {$row['Name']}<br>". 
			"Birth Year:{$row['BirthYear']}<br>".
			"ZipCode is:{$row['Zip']}<br>". 
			"Last_Four_Of_SSN:{$row['Last_Four_Of_SSN']}<br>".
			"Username: {$row['Username']}<br>". 
			"Password:{$row['Password']}<br><br><br>";
	}
	#Used to Clear anything stored in the variable 
	$Limit = 0;
}
mysql_close($db);	
	
?>

