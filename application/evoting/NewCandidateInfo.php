<?php 
echo "
<html>
	<head>
		<link rel="stylesheet" href="mrrobot-theme.css">
		<h1>eVoting</h1>
		<h3>New Candidate Added to the Database</h3>	
	</head>
	</html>	";

include 'Connect.php';

		
if(isset($_POST["Submit"]))
	{	
	echo "<head><h1>Adding New Candidate</h1> </head>";
	
		$PartyId = ($_POST['PartyId']);
		$CName = mysql_escape_string($_POST['CName']);
		$Term = ($_POST['Term']);
		$Title = 'President'; 
		$Description =  mysql_escape_string($_POST['Description']);
		$Location = mysql_escape_string($_POST['Location']); 

//people who voted republican
	$mysql = mysql_query("Insert Into candidate  (C_name, Title, Term, Description, Location, Party_id) values 
	('$CName', 'President', $Term, '$Description', '$Location', $PartyId)") or die ("Error : " . mysql_error());	

	
	echo " Candidate Info:" .$PartyId . "<br>".$CName . "<br>".$Term . "<br>". $Title . "<br>" . $Description . "<br>" . $Location . "<br>";
// Close connection to the database
mysql_close($db);

}	
			
?>
<html>
	<body>
	<form action="AdminCode.php" >
			Navigate to home page:
			<input type= "submit" name= "Submit" value = "Hoome">
	   
	   </form>	
		<form action="logout.php">
			Navigate to main page: 
			<input type="Submit" value="Logout" name = "Logout">
		</form>
		</body>
	   </br />
</html>

