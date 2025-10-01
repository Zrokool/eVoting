<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eVoting</title>
	<link rel="stylesheet" href="mrrobot-theme.css">
</head>
<body>
	<h1>eVoting</h1>
	<h3>Home Page</h3>

	<form action="accountinfo.php">
		<input type="submit" value="Update Info">
	</form>

	<form action="StateInfo.php">
		<input type="submit" value="Find State Id">
	</form>

	<form action="electioninfo2016.php">
		<input type="submit" value="Vote Now">
	</form>

	<form action="MyPollingStation.php">
		<input type="submit" value="Find Polling Station">
	</form>

	<form action="VoterAnalytics.php">
		<input type="submit" value="Election Stats">
	</form>

	<form action="PostElectionAnalytics.php" method="post">
		<input type="submit" value="Post Presidential Stats">
	</form>

	<form action="StateBreakdown.php" method="post">
		<input type="submit" value="State Stats">
	</form>

	<form action="StatePartyRatio.php" method="post">
		<input type="submit" value="State Party Analysis">
	</form>

	<form action="Logout.php">
		<input type="submit" value="Sign Out">
	</form>
</body>
</html>
