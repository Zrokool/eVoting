<html>
	<head>
		<link rel="stylesheet" href="mrrobot-theme.css">
		<title>User Deletion</title>
	</head>
		<h1>eVoting</h1>
		<h3>Troubleshooting</h3>
		<h4>Help find Username for client </h4>
<!--button to go to another page-->
		 
	<form action="DeleteUser.php" method="post">
			Enter the Voter Citizen Number that you want to permenatly delete from the Database: <br/>
			<br/><input type= "text" name="CitizenNum" /><br/><br/>
			
			Enter the Voter ID associated to the Voter you want to permenatly delete in the Database: <br/>
			<br /><input type= "text" name="vID" /><br/><br/>
		
			
			Enter the Voter Name : <br/>
			<br /><input type= "text" name="vName" /><br /><br/>
			
			<input type= "submit" name= "submit" />
			<br />*** Enter Correct CitizenNum and Voter ID<br />
	</form>	
		<form action="AdminCode.php">
			Navigate to main page: 
			<input type="submit" value="Back">
		</form>
	   <br />
</html>










