<?php
include 'connect.php';
	echo "<html><head>
		<link rel="stylesheet" href="mrrobot-theme.css">
		<title> eVoting</title>
		<h1> 2012 Presidential Results</h1>
	</head></html> ";
#mysql_select_db('evoting');
//number of votes in a year
$query = "select Date_of_Vote, count(voter.V_id) as Number_of_voters
from voter join ballot on voter.V_id = ballot.V_id
where Date_of_Vote = '2012';";	
	
	#mysql_select_db('evoting');	
	$result = mysql_query($query,$db);	
	
	echo"<img src='B Sanders.png' alt='President Pic' style='width:304px;height:228px;'> ";

	// If the query executed properly proceed
	if(!$result)
		{
			die('Could not issue database query' . mysql_error());
		}
		
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{	
		echo " <h3>In the {$row['Date_of_Vote']} General Elections  {$row['Number_of_voters']} Citizens voted</h3><br>";
		
	}
	
#if(isset($_POST['Submit']))
#{	$StateNum = $_POST['StateNum'];

	//who won in north carolina in 2012
	$sql2 = "select * from PresVotes";
	
	$response2 = mysql_query($sql2,$db);	
		
	// If the query executed properly proceed
	if(!$response2)
		{
			die('Could not issue database query' . mysql_error());
		}
		
	while($row = mysql_fetch_array($response2, MYSQL_ASSOC))
		{	
		
			echo "<h2>Majority vote for goes to {$row['President_selection']}. He won the election with {$row['vote']} of votes<br><br></h2>";
		
	mysql_close($db);
		}

?>


<html>
		<form action="home.php">
			<input type="submit" value="Back">
		</form>		
		<form action="Logout.php">
			<input type="submit" value="Log Out">
		</form>		

</html>
