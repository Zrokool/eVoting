<html>
	<head>
		<title>eVoting</title>
	</head>
	<body>

		<h1>User Deletion Complete</h1>
		<h3> Admin</h3>
			
		</form>
	</body>
</html>

<?php

#Caling connection.php to reuse the script to connect db server 
Include 'connect.php';

//Statement runs once submit is clicked in the register View
if (isset($_POST["Submit"]));
{
		$CitizenNum = mysql_escape_string($_POST['CitizenNum']);
		$vID = mysql_escape_string($_POST['vID']);
		$vName = mysql_escape_string($_POST['vName']);
		
		
	
	//Rest works
	$mysql = mysql_query("DELETE  FROM resident_info Where CitizenNum = $CitizenNum ")or die("Not Delted from Resident Info Table" . mysql_error());

	$mysql = mysql_query("DELETE  FROM ballot where v_id = $vID") or die("Not Delted from Voter Info Table" . mysql_error());

	$mysql = mysql_query("DELETE  FROM voter where CitizenNum = $CitizenNum ") or die("Not Delted from Person Info Table" . mysql_error());

	$mysql = mysql_query("DELETE  FROM  person_info Where CitizenNum = $CitizenNum ")or die("Not Delted from Voters Info Table" . mysql_error());


	
	echo "Successfully Deleted User:  "."<br>"."<br>"."Name: " . $vName. " "."<br>".  "CitizenNum: " .$CitizenNum."<br>".  "Voter ID: " .$vID ."<br>" ."<br>"."<br>";
	echo " Removed From Resident, Ballot, and Voter Tables"."<br>"."<br>";
	
	# Sending user to Logged In Page
	#header('Location: /evoting/loggedin.php');

	/*
	
	*/
}


mysql_close($db);

?>


<html>
	<body>

<form action="AdminCode.php">
<input type="submit" value="Back">

</form>		
		<form action="Logout.php">
		<input type="submit" value="Sign Out">
		</form>

	</body>
</html>
