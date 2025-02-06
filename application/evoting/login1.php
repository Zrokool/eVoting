

 <!DOCTYPE html>
	<html>   
    <head>
        <title>Evoting Login Page</title>
		   <h3> Evoting Login Page</h3>
	</head>	
       <body>		
		<form action="login1.php" method="post">
			Username: <input type= "text" name="Username" /></br /></br>
			Password: <input type= "password" name="Password" /></br>
		              <input type= "submit" name= "submit" value = "login" />
	<!--registration hyperlink -->
	  
	   </form>	
	  </body> 
     </html>    		  
<!--php code-->
<?php
include 'Connect.php';
	if(isset($_POST['submit']))
	{
		$Username = mysql_escape_string($_POST['Username']);
		$Password = mysql_escape_string($_POST['Password']);
		

            $query = mysql_query("SELECT * FROM person_info 
			WHERE Username='$Username' AND Password='$Password' ");   


		if ($Username == 'Admin187' && $Password == 'password187')
		{
			echo "Welcome Admin User";

			header('Location: /evoting/AdminCode.php');

		}		
			
		else if(mysql_num_rows($query) > 0)
			{
	
				echo "you are now loged in";
				header('Location: /evoting/home.php');
 
		    }
		
		else
			{
				echo "Wrong id/password. Try Again!!";
				 echo '<a href="AdminCode.php">Register Now</a>';
			}
		}
mysql_close($db);	
	?>
	  
             
  

