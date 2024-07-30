<?php 

echo "
<html>
	<head>

		<h1>eVoting</h1>
		<h3>Add New Candidate in the Database</h3>	
	</head>
	</html>	";

include 'Connect.php';

	$sql = "Select * from PartyType";

	$response = mysql_query($sql,$db);	
		
	// If the query executed properly proceed
	if(!$response)
		{
			die("Could not issue database query" . mysql_error());
		}


	while($row = mysql_fetch_array($response, MYSQL_ASSOC))
		{	
			echo "{$row['Party_Name']} " . " -  " . "Id : {$row['Party_id']}<br>";	
		}
		
/*		
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

// Close connection to the database
*/
mysql_close($db);

			
?>
<html>
	<body>
	<form action="NewCandidateInfo.php" method="post">
			</br /></br> Enter the Candidate Name: </br />
			</br /><input type= "text" name="CName" ></br /></br>
			
			Enter the Term for the General Election: </br />
			</br /><input type= "number" name="Term" ></br /></br>
			
			Enter the Description : </br />
			</br /><input type= "text" name="Description" ></br /></br>
				
			Enter the Location : </br />
			</br /><input type= "text" name="Location" ></br /></br>
		
			
			Enter the Party Id associated to the Candidate: </br />

			</br /><input type= "number" name="PartyId" ></br /></br>
			
			See the list above for the Party Name with the  Associated Party Id</br />

			<input type= "submit" name= "Submit" >
	   
	   </form>	
		<form action="AdminCode.php">
			Navigate to main page: 
			<input type="Submit" value="Back" name = "Back">
		</form>
		</body>
	   </br />
</html>
