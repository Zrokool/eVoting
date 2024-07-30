<html>
	<head>
		<title>eVoting</title>
		<h3>eVoting</h3>
		<h3>Residential Information </h3>
</head>
<?php
include 'connect.php';

 if(isset($_POST['Submit']))
 {
		$CitizenNum = ($_POST['CitizenNum']);
		$Street = mysql_escape_string($_POST['Street']);
		$City = mysql_escape_string($_POST['City']);
		$State = mysql_escape_string($_POST['State']);
		$ZipCode = ($_POST['ZipCode']);
		$County = mysql_escape_string($_POST['County']);
		$Phone = mysql_escape_string($_POST['Phone']);
		
		# Script update user info in Resident based on user input - Resident_Id = $DEFUALT,		          				   
		$mysql = mysql_query("UPDATE resident_info 
		SET CitizenNum  = $CitizenNum, Street = '$Street', City = '$City', State = '$State', ZipCode = $ZipCode, County = '$County', Phone = '$Phone'
		where CitizenNum = $CitizenNum") or die("Erro " . mysql_error());
		 echo "Your residential information has been successfully updated to the following: ";
		 echo "</br>" . 
		 "Street: " . $Street .  "</br></br></br>".
		"City: " . $City . "</br></br></br>".
		"State: " . $State . "</br></br></br>".
		"Zip Code: ". $ZipCode ."</br></br></br>".
		"County: " . $County ."</br></br></br>".
		"Phone: " . $Phone ."</br></br></br>";
     

   

 }  
 mysql_close($db);
	
 ?>

 
 <html>
<!--update the voter Address that match with  user citizenNum passed from the form text_box-->
		<form action="Loggedin.php">
		Navigate to the Home page:
			<input type="submit" value="Home"></form>
		<form action="Logout.php">
			<input type="submit" value="Log Out">
		</form>	
</html>