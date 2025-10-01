<html>
<head>
    <link rel="stylesheet" href="mrrobot-theme.css">
    <title>eVoting</title>
    
    <!-- FLAG-CONFIG-002: Exposing admin functionality in title -->
</head>
<body>
    <h1>User Deletion Complete</h1>
    <h3>Admin</h3>
    <!-- FLAG-BAC-001: No authentication check for admin page -->
    <!-- Anyone can access this URL directly -->
</body>
</html>

<?php
// FLAG-AUTH-002: No session validation
// No check if user is authenticated or has admin privileges

// FLAG-CSRF-002: No CSRF token validation
// Attackers can create malicious pages to delete users

include 'connect.php';

// FLAG-SQL-005: SQL Injection in user deletion
if (isset($_POST["submit"]));  // FLAG-LOGIC-007: Semicolon makes this always true!
{
    // FLAG-SQL-006: No input sanitization
    $CitizenNum = $_POST['CitizenNum'];  // Should use mysql_real_escape_string
    $vID = $_POST['vID'];
    $vName = $_POST['vName'];
    
    // FLAG-CONFIG-002: Exposing internal operations
    echo "<!-- Deleting user: $vName with CitizenNum: $CitizenNum and VoterID: $vID -->";
    
    // FLAG-SQL-007: Cascading delete without transaction
    // If one fails, database is left in inconsistent state
    
    // FLAG-SQL-008: SQL Injection - DELETE statements
    // HINT: Try CitizenNum: 1 OR 1=1 to delete all residents
    $query1 = "DELETE FROM resident_info WHERE CitizenNum = $CitizenNum";
    echo "<!-- Query 1: $query1 -->";
    $mysql = mysql_query($query1) or die("Not Deleted from Resident Info Table: " . mysql_error());
    
    // FLAG-SQL-009: Another injection point
    $query2 = "DELETE FROM ballot WHERE v_id = $vID";
    echo "<!-- Query 2: $query2 -->";
    $mysql = mysql_query($query2) or die("Not Deleted from Ballot Table: " . mysql_error());
    
    // FLAG-SQL-010: Third injection vector
    $query3 = "DELETE FROM voter WHERE CitizenNum = $CitizenNum";
    echo "<!-- Query 3: $query3 -->";
    $mysql = mysql_query($query3) or die("Not Deleted from Voter Table: " . mysql_error());
    
    // FLAG-SQL-011: Fourth injection opportunity
    $query4 = "DELETE FROM person_info WHERE CitizenNum = $CitizenNum";
    echo "<!-- Query 4: $query4 -->";
    $mysql = mysql_query($query4) or die("Not Deleted from Person Info Table: " . mysql_error());
    
    // FLAG-XSS-005: Reflected XSS in success message
    echo "Successfully Deleted User: " . "<br><br>" . "Name: " . $vName . " " . 
         "<br>" . "CitizenNum: " . $CitizenNum . "<br>" . "Voter ID: " . $vID . 
         "<br><br><br>";
    echo "Removed From Resident, Ballot, and Voter Tables" . "<br><br>";
    
    // FLAG-LOGIC-008: No confirmation required
    // No "Are you sure?" check before deletion
    
    // FLAG-AUDIT-001: No logging of deletion action
    // No audit trail of who deleted what and when
}

// FLAG-CONFIG-003: Connection not properly closed
mysql_close($db);
?>

<html>
<body>
    <!-- FLAG-BAC-002: Direct access to admin functions -->
    <form action="AdminCode.php">
        <input type="submit" value="Back">
    </form>		
    
    <form action="Logout.php">
        <input type="submit" value="Sign Out">
    </form>
</body>
</html>

<!-- HIDDEN CHALLENGES -->
<!--
FLAG-ADV-003: Second-Order SQL Injection
Steps:
1. Insert malicious data through registration
2. Trigger execution through deletion
3. Extract database information

FLAG-ADV-004: Blind SQL Injection
Try: CitizenNum: 1 AND (SELECT SLEEP(5) FROM person_info WHERE Username='Admin187')
This reveals if specific usernames exist via timing attacks

FLAG-LOGIC-009: Race Condition
Multiple simultaneous delete requests can cause:
- Duplicate deletions
- Partial deletions
- Database inconsistency

BONUS CHALLENGE - FLAG-SECRET-001:
Chain this vulnerability with others:
1. SQL Injection in login to get admin access
2. Extract all CitizenNum values
3. Mass delete all voters
4. Cover tracks by deleting from audit logs (if they existed)
-->

<script>
// FLAG-CSRF-003: No JavaScript validation
// Auto-submit form can be triggered from external site

// CSRF Attack Example:
// <form action="http://localhost:8181/evoting/DeleteUser.php" method="POST">
//   <input type="hidden" name="CitizenNum" value="111111111">
//   <input type="hidden" name="vID" value="50001">
//   <input type="hidden" name="vName" value="Victim">
//   <input type="hidden" name="submit" value="1">
// </form>
// <script>document.forms[0].submit();</script>

function confirmDelete() {
    // FLAG-LOGIC-010: Client-side only - can be bypassed
    return true;  // Should ask for confirmation!
}
</script>

<?php
// DEVELOPER NOTES (Intentional vulnerability documentation)
/*
KNOWN ISSUES (DO NOT FIX - For training purposes):

1. SQL Injection in all DELETE queries
   - No prepared statements
   - No input validation
   - Direct variable interpolation

2. No Access Control
   - Anyone can access this page
   - No role-based permissions
   - No session checks

3. CSRF Vulnerability
   - No token validation
   - External sites can trigger deletions

4. XSS in Output
   - User input echoed without sanitization
   - HTML injection possible

5. Logic Flaws
   - Deletion happens even if form not submitted (semicolon bug)
   - No confirmation required
   - No rollback on partial failure

6. No Audit Trail
   - Deletions not logged
   - No accountability

EXPLOITATION SCENARIOS:

Scenario 1 - Mass Deletion:
CitizenNum: 1 OR 1=1
Result: Deletes ALL users from database

Scenario 2 - Selective Extraction:
CitizenNum: 1 UNION SELECT Username,Password,SSN,1 FROM person_info WHERE 1=1
Result: Extracts sensitive data before deletion

Scenario 3 - Database Drop:
CitizenNum: 1; DROP TABLE person_info--
Result: Destroys entire table

Scenario 4 - Privilege Escalation:
vID: 1 OR v_id IN (SELECT v_id FROM voter WHERE CitizenNum IN (SELECT CitizenNum FROM person_info WHERE Username='admin'))
Result: Delete admin voting records to manipulate elections

REMEDIATION (For student reports):
1. Use prepared statements with parameterized queries
2. Implement authentication and authorization checks
3. Add CSRF tokens to forms
4. Sanitize all output with htmlspecialchars()
5. Use database transactions for multi-table operations
6. Implement soft deletes instead of hard deletes
7. Add comprehensive logging
8. Require confirmation for destructive operations
9. Implement rate limiting
10. Add input validation on both client and server side
*/
?>

