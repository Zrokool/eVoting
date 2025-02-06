<?php

#Caling connection.php to reuse the script to connect db server 
Include 'connect.php';

//Statement runs once submit is clicked in the register View
if (isset($_POST["Submit"]));
{
		$CitizenNum = mysql_escape_string($_POST['CitizenNum']);
		$FirstName = mysql_escape_string($_POST['FirstName']);
		$LastName = mysql_escape_string($_POST['LastName']);
		$Sex = mysql_escape_string($_POST['Sex']);
		$Race =  mysql_escape_string($_POST['Race']);
		$DateOfBirth = mysql_escape_string($_POST['DateOfBirth']); 
		$Username = mysql_escape_string($_POST['Username']); 
		$Password = mysql_escape_string($_POST['Password']); 
		$SSN = mysql_escape_string($_POST['SSN']);

		
		// Declaring variables for ResiTable
		$CitizenNum =  mysql_escape_string($_POST['CitizenNum']);  // Number
		$Street =  mysql_escape_string($_POST['Street']); // String
		$City =  mysql_escape_string($_POST['City']); // String
		$State =  mysql_escape_string($_POST['State']); // String
		$ZipCode =  mysql_escape_string($_POST['ZipCode']); // Number
		$County =  mysql_escape_string($_POST['County']); // String
		$Phone = mysql_escape_string($_POST['Phone']); // String
		
		
	#Script used to insert user input to the person_Info table;

	$mysql = mysql_query("INSERT INTO person_Info (CitizenNum, FirstName, LastName, Gender, Race, Date_of_Birth, Username, Password, SSN) VALUES 
	($CitizenNum, '$FirstName', '$LastName', '$Sex', '$Race', '$DateOfBirth', '$Username', '$Password', $SSN )") or die("No data insert" . mysql_error());
			


	#Script used to insert input to Adding Data to Resident table

	$mysql = mysql_query ("INSERT into resident_info (Resident_Id, CitizenNum, Street, City, State, ZipCode, County, Phone) VALUES
	(DEFAULT, $CitizenNum, '$Street', '$City', '$State', $ZipCode, '$County', '$Phone')") or die("No data insert" . mysql_error());
			
	echo "Successfully inserted your information ";
	#echo  $CitizenNum . "<br>". '$Street'. "<br>". '$City'. "<br>". '$State'. "<br>". $ZipCode. "<br>". '$County'. "<br>". '$Phone'";

	
	# Sending user to Logged In Page
	header('Location: /evoting/home.php');

}

mysql_close($db);

?>
