<html>
	<head>
		<title>eVoting</title>
		<h3>eVoting</h3>
		<h3>Update Residential Information </h3>
	</head> 
<body>
<!--update the voter Address that match with  user citizenNum passed from the form text_box-->
 <p>
 	<form action="VoterResidentInfoUpdate.php" method="Post">
<b><I>To update your reisedential information,  input your Citizen Number and Address below: </I></b></br></br>

	Citizen Number: 
       <input type "number" name="CitizenNum" ></br></br>	
	Street:	
	      <input type= "text" name="Street" > </br></br>
	City:  
      	<input type= "text" name="City" > </br></br>
	State:  
         <input type= "text" name="State" > </br></br>
	County:  
         <input type= "text" name="County" > </br></br>
	Zip Code:
	        <input type= "Number" name="ZipCode" > </br></br>
	Phone:  
         <input type= "text" name="Phone" > </br></br>
		 
		</br>
  </p>

	<input type="Submit" name="Submit">
		</form>
		<form action="home.php">
			<input type="submit" value="Back"></form>
		<form action="Logout.php">
			<input type="submit" value="Log Out">
		</form>	
   </body>
</html>
