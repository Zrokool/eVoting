<html>
<head>
    <title>evoting</title>
    <h1>2016 Election Candidates</h1>
    <!-- FLAG-DATA-003: Exposing system information -->
    <!-- Server: Apache/2.4, PHP 7.4, MySQL 5.7 -->
    <!-- Application Version: 1.0-vulnerable -->
</head>
<body>
</body>
</html>

<?php
// FLAG-AUTH-002: No session validation
// Anyone can access this page directly without logging in
// No authentication check!

include 'connect.php';

// FLAG-SQL-003: SQL Injection in candidate listing
$sql = "select * from candidatesinfo";
mysql_select_db('evoting');
$response = mysql_query($sql, $db);

// Hardcoded candidate names for testing
$canname = "Hilary Clinton";
$canname1 = "D. Trump";
$canname2 = "Mr. Robot";

// FLAG-CONFIG-002: Verbose error messages
if(!$response)
{
    die('Could not issue database query: ' . mysql_error() . '<br>SQL: ' . $sql);
}

echo "<h2>Your 2016 Candidate are </h2>"; 
echo "<h3> $canname, $canname1, $canname2\n</h3>";

// FLAG-XSS-002: Stored XSS - candidate data displayed without sanitization
while($row = mysql_fetch_array($response, MYSQL_ASSOC))
{	
    // No htmlspecialchars() or escaping
    echo "Candidate: {$row['C_name']}<br>". 
         "Election Year:{$row['Term']}<br>".	
         "Party Name:{$row['Party_Name']}<br>". 
         "Description:{$row['Description']}<br><br>";
}

echo "Who will win your vote?";
?>

<html>
<head>
    <h1>Cast Vote Here</h1>
</head>
<body>
    President Selection:

    <!-- FLAG-CSRF-001: No CSRF token on voting form -->
    <form method="post" action=""> 
        <input type="radio" name="president" value="Hilary Clinton"> Hilary Clinton
        <input type="radio" name="president" value="D. Trump">D. Trump		
        <input type="radio" name="president" value="Mr. Robot">Mr. Robot
        <br><br>
        
        <!-- FLAG-BAC-002: User can vote multiple times by changing Voter ID -->
        <!-- FLAG-DATA-003: Voter ID exposed in form -->
        Enter Voter Id  <input type="text" name="VoterId" value="50001"><br /><br>
        
        <!-- FLAG-SQL-004: State number vulnerable to SQL injection -->
        State Number  <input type="text" name="StateNum"><br /><br>
        
        <!-- FLAG-LOGIC-002: No validation that VoterId belongs to logged-in user -->
        <input type="submit" name="submit" value="Submit"> 
    </form>

    <form action="home.php"><input type="submit" value="Back"></form>
    <form action="Logout.php"><input type="submit" value="Log Out"></form>
</body>
</html>

<?php
if (isset($_POST['submit'])) 
{
    // FLAG-LOGIC-001: Race condition - multiple simultaneous votes possible
    if(isset($_POST['president']))
    {
        // FLAG-SQL-002: SQL Injection in voting process
        // No input validation or prepared statements
        $president = $_POST['president'];
        $VoterId = $_POST['VoterId'];
        $StateNum = $_POST['StateNum'];
        
        // FLAG-XSS-001: Reflected XSS in vote confirmation
        echo "<!-- Voting for: " . $president . " with ID: " . $VoterId . " -->";
        
        $PartyId = 0;
        $Cid = 0;
        $DateOfVote = 2016;
        
        // FLAG-LOGIC-003: Predictable logic for determining party/candidate
        if($president == 'Hilary Clinton')
        {
            $PartyId = 200;
            $Cid = 11;
            $DateOfVote = 2016;
        }
        elseif($president == 'D. Trump')
        {
            $PartyId = 100;
            $Cid = 12;
            $DateOfVote = 2016;
        }
        elseif($president == 'Mr. Robot')
        {
            $PartyId = 300;
            $Cid = 13;
            $DateOfVote = 2016;	
        }
        // FLAG-LOGIC-004: No else clause - allows undefined candidates
        
        // FLAG-XSS-001: Reflected XSS vulnerability
        echo "Your vote for " . $_POST['president'] . " has been successfully casted";
        
        // FLAG-SQL-005: SQL Injection in INSERT statement
        // HINT: Inject malicious SQL through president parameter
        // Example: '; DELETE FROM ballot WHERE 1=1--
        $query1 = "INSERT INTO ballot (Ballot_id, V_id, Party_id, Date_of_Vote, C_id, State_Num, President_Selection) 
                  VALUES (DEFAULT, $VoterId, $PartyId, '2016', $Cid, $StateNum, '$president')";
        
        // FLAG-CONFIG-002: Exposing SQL query
        echo "<!-- Debug: $query1 -->";
        
        $mysql = mysql_query($query1) or die("Vote Error: " . mysql_error() . "<br>Query: " . $query1);
        
        // FLAG-BAC-003: Can update any voter's status by manipulating VoterId
        $query2 = "UPDATE Voter SET ifVoted = 1 WHERE V_id = $VoterId";
        $mysql2 = mysql_query($query2) or die("Update Error: " . mysql_error());
        
        // FLAG-LOGIC-002: No check if voter already voted
        // Can vote multiple times by setting ifVoted back to 0
        
        // FLAG-CONFIG-002: Redirect reveals internal structure
        echo "<!-- Redirecting to: /evoting/VoteSavedInDB.HTML -->";
        header('Location: /evoting/VoteSavedInDB.HTML');
        exit;
    }
    else
    {
        // FLAG-XSS-004: XSS in error message
        echo "<script>alert('Please select a candidate!');</script>";
    }
}

// FLAG-CONFIG-003: Connection not closed
// mysql_close($db);
?>

<!-- HIDDEN CHALLENGE: FLAG-ADV-001 -->
<!-- Second-order SQL injection possible through stored candidate data -->
<!-- Try injecting XSS in candidate description during admin operations -->

<!-- FLAG-LOGIC-005: Vote counting algorithm vulnerable to manipulation -->
<!-- Hint: Check the analytics.php for vote counting logic flaws -->

<script>
// FLAG-XSS-003: DOM-based XSS vulnerability
function showVoteConfirmation() {
    var urlParams = new URLSearchParams(window.location.search);
    var candidate = urlParams.get('candidate');
    if(candidate) {
        // No sanitization before displaying
        document.write("Thank you for voting for: " + candidate);
    }
}

// FLAG-CSRF-002: No same-origin validation
// Attacker can submit votes from external site

// FLAG-LOGIC-006: Client-side vote validation can be bypassed
function validateVote() {
    // This runs on client side only - easily bypassed
    var voterId = document.forms[0]["VoterId"].value;
    if(voterId < 50001 || voterId > 99999) {
        alert("Invalid Voter ID range");
        return false;
    }
    return true;
}
</script>

<?php
// BONUS FLAG: FLAG-ADV-002
// Blind SQL injection possible through timing attacks
// Try: StateNum: 1' AND (SELECT SLEEP(5))--

// FLAG-BAC-004: No verification that StateNum matches voter's registered state
// Voters can vote in any state by manipulating StateNum parameter

// FLAG-DATA-001: SSN and other PII accessible through SQL injection
// HINT: UNION SELECT to extract person_info table data
?>

<!-- Developer Notes (FLAG-CONFIG-002) -->
<!-- 
TODO: 
- Add CSRF tokens
- Implement prepared statements
- Add rate limiting
- Validate voter eligibility
- Prevent double voting
- Sanitize all inputs
- Hash passwords
- Add session timeout
- Implement proper error handling
-->
