<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="mrrobot-theme.css" />
    <title>User Deletion</title>
</head>
<body>

    <h1>eVoting</h1>
    <h3>Troubleshooting</h3>
    <h4>Help find Username for client</h4>
    <!-- Button to go to another page -->

    <form action="DeleteUser.php" method="post">
        <label for="CitizenNum">Enter the Voter Citizen Number that you want to permanently delete from the Database:</label><br />
        <input type="text" id="CitizenNum" name="CitizenNum" /><br /><br />

        <label for="vID">Enter the Voter ID associated to the Voter you want to permanently delete in the Database:</label><br />
        <input type="text" id="vID" name="vID" /><br /><br />

        <label for="vName">Enter the Voter Name:</label><br />
        <input type="text" id="vName" name="vName" /><br /><br />

        <input type="submit" name="submit" value="Delete User" /><br />
        <small>*** Enter Correct CitizenNum and Voter ID</small><br />
    </form>

    <form action="AdminCode.php" method="get">
        Navigate to main page:
        <input type="submit" value="Back" />
    </form>

</body>
</html>
