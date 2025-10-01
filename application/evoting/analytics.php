<html>
	<head>
		<link rel="stylesheet" href="mrrobot-theme.css">
		<title> eVoting</title>
		<h1>Analytical Results</h1>
	</head>
</html>

<?php
include 'connect.php';
//number of votes in a year
$query = "select Date_of_Vote, count(voter.V_id) as Number_of_voters
from voter join ballot on voter.V_id = ballot.V_id
where Date_of_Vote = '2012';";	
	
	mysql_select_db('evoting');	
	$result = mysql_query($query,$db);	
		
	// If the query executed properly proceed
	if(!$result)
		{
			die('Could not issue database query' . mysql_error());
		}
		
while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{	
		echo "<h2>In the {$row['Date_of_Vote']} General Elections  {$row['Number_of_voters']} Citizens voted</h2>";
	}

/*
//who won in north carolina in 2012
	$sql = "select State_Name, ballot.state_num, president_selection, ballot.party_id, count(president_selection) as Votes
		from ballot join district_info on ballot.State_Num = district_info.State_Num
		where Date_of_Vote = 2012 and ballot.state_num = 1 
		group by president_selection 
		having count(president_selection)=(select max(Votes)
		from(select count(president_selection) as Votes
		from ballot
		where Date_of_Vote = 2012 and ballot.state_num = 1
		group by president_selection
		order by votes desc)t)";	
	
	#mysql_select_db('evoting');	
	
	$response = mysql_query($sql,$db);	
		
	// If the query executed properly proceed
	if(!$response)
		{
			die('Could not issue database query' . mysql_error());
		}
		
		while($row = mysql_fetch_array($response, MYSQL_ASSOC))
	{	
		
		echo 
			"Majority vote for the state of {$row['State_Name']} goes to {$row['president_selection']}. He ended up with {$row['Votes']} of votes<br><br>";
			
	}	
	*/

?>

<html>
	<body>
	
		</br>
		<form action="analytics.php" method = "post">
			<input type="submit" name ="Democratic" value="Democratic Voters">
		</form>
	</br>	
	</br>
		<form action="analytics.php" method = "post">
			<input type="submit" name = "Republican" value="Republican Voters">
		</form>

	</body>


		<body>
		</body>
</html>

<?php
if (isset($_POST["Democratic"]))
{
		echo "<head><h1>Democratic Voters</h1> </head>";

	//people who voted democratic
	$sql1 = " select  voter.V_name as Voter, district_info.State_Name as State, party.Party_Name as Party, ballot.President_Selection as President, 
		ballot.Date_of_Vote as Election_year
		from voter join ballot on ballot.V_id = voter.V_id join party on ballot.Party_id=party.Party_id join district_info on ballot.State_Num = district_info.State_Num
		where party.Party_Name = 'Democratic Party'
		order by Voter;";	
	#mysql_select_db('evoting');	
	$response1 = mysql_query($sql1,$db);	
		
	// If the query executed properly proceed
	
	if(!$response1)
		{
			die('Could not issue database query' . mysql_error());
		}
		while($row = mysql_fetch_array($response1, MYSQL_ASSOC))
	{	
		
		echo 
			"Voters name: {$row['Voter']}<br>". 
			"State: {$row['State']}<br>".   
			"President Selected: {$row['President']}<br>".
			"In: {$row['Election_year']}<br><br>";
			
	}
}

?>

<?php

if(isset($_POST["Republican"]))
{
		echo "<head><h1>Republican Voters</h1> </head>";


//people who voted republican
	$sql2 = "select   voter.V_name as Voter, district_info.State_Name as State , party.Party_Name as Party, ballot.President_Selection as President, ballot.Date_of_Vote as Election_year
		from voter join ballot on voter.V_id = ballot.V_id join  party on party.Party_id =ballot.Party_id join district_info on district_info.State_Num = ballot.State_Num
		where party.Party_Name = 'Republican Party'
		order by Voter;";	
	mysql_select_db('evoting');	
	$response2 = mysql_query($sql2,$db);	
		
	// If the query executed properly proceed
	if(!$response2)
		{
			die('Could not issue database query' . mysql_error());
		}



	while($row = mysql_fetch_array($response2, MYSQL_ASSOC))
	{	
		echo 
			"Voters name: {$row['Voter']}<br>". 
			"State: {$row['State']}<br>".   
			"President Selected: {$row['President']}<br>".
			"In: {$row['Election_year']}<br><br>";	
	}
}	
			
// Close connection to the database
mysql_close($db);

?>

		<form action="AdminCode.php">
			<input type="submit" value="Back">

		</form>
