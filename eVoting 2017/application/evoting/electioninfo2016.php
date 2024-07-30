<html>
	<head>
		<title>evoting</title>
		<h1>2016 Election Candidates</h1>
	</head>
	<body>
	</body>
</html>

<?php
include 'connect.php';

	$sql = "select * from candidatesinfo";	
	mysql_select_db('evoting');
	$response = mysql_query($sql,$db);	
	$canname = "Hilary Clinton";
	$canname1 = "D. Trump";
	$canname2 = "Mr. Robot";
// If the query executed properly proceed
	if(!$response)
		{
			die('Could not issue database query' . mysql_error());
		}

		
	echo "<h2>Your 2016 Candidate are </h2>"; 
	echo "<h3> $canname, $canname1, $canname2\n</h3>";
	while($row = mysql_fetch_array($response, MYSQL_ASSOC))
	{	
		echo 
			"Candidate: {$row['C_name']}<br>". 	"Election Year:{$row['Term']}<br>".	
			"Party Name:{$row['Party_Name']}<br>". 	"Description:{$row['Description']}<br><br>";
	}
	
	echo "Who will win your vote?";
?>

<html>
	<head>
		<h1>Cast Vote Here</h1>
	</head>
	<body>
		 President Selection:

   <form method="post" action=""> 
   <input type="radio" name="president" value="Hilary Clinton"> Hilary Clinton
   <input type="radio" name="president" value="D. Trump">D. Trump		
   <input type="radio" name="president" value="Mr. Robot">Mr. Robot
   <br><br>
	
	Enter Voter Id  <input type="text" name = "VoterId"></br /></br>
	State Number  <input type="text" name="StateNum"></br /></br>
   
   <input type="submit" name="submit" value="Submit"> 
	</form>

		<form action="home.php"><input type="submit" value="Back" ></form>
		
		<form action="Logout.php"> <input type="submit" value="Log Out"> </form>
	</body>
</html>
<?php
if (isset($_POST['submit'])) 
{
	if(isset($_POST['president']))
	{

$president = $_POST['president'];	
		$VoterId = $_POST['VoterId'];
		$StateNum = $_POST['StateNum'];
		$PartyId = 0;
		$Cid = 0;
		$DateOfVote = 2016;
		
		if($president == 'Hilary Clinton')
		{
			$PartyId = 200;
			$Cid = 11;
			$DateOfVote = 2016;
		}
		else if($president == 'D. Trump')
		{
			$PartyId = 100;
			$Cid = 12;
			$DateOfVote = 2016;

		}
		else if($president == 'Mr. Robot')
		{
			$PartyId = 300;
			$Cid = 13;
			$DateOfVote = 2016;	
		}
	
	echo "Your votes for ".$_POST['president'] . " has been succesfull casted";  //  Displaying Selected Value

	$mysql = mysql_query( "insert into ballot (Ballot_id, V_id, Party_id, Date_of_Vote, C_id, State_Num, President_Selection) 
	values (DEFAuLT, $VoterId, $PartyId, '2016', $Cid, $StateNum, '$president' )") or die("no data added" . mysql_error());
	
	$mysql2 = mysql_query( "UPDATE Voter SET ifVoted = 1 Where V_id = $VoterId ") or die("no data added" . mysql_error());
	header('Location: /evoting/VoteSavedInDB.HTML');

	
	// Close connection to the database
	mysql_close($db);

	}
}

?>
