<?php
// application/evoting/Connect.php (capital C to match includes)
// Get environment variables with fallbacks
$db_host = getenv('DB_HOST') ?: 'db';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASSWORD') ?: 'root_password';
$db_name = getenv('DB_NAME') ?: 'evoting';

// Create mysqli connection
$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$db) {
    die("<!-- FLAG-CONFIG-001: Database connection failed -->" . 
        "MySQL Error: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($db, 'utf8');

// Create wrapper functions for backward compatibility
// This allows old mysql_* calls to work with minimal changes
function mysql_query($query, $link = null) {
    global $db;
    $link = $link ?: $db;
    return mysqli_query($link, $query);
}

function mysql_fetch_array($result, $type = MYSQLI_BOTH) {
    return mysqli_fetch_array($result, $type);
}

function mysql_error($link = null) {
    global $db;
    $link = $link ?: $db;
    return mysqli_error($link);
}

function mysql_num_rows($result) {
    return mysqli_num_rows($result);
}

function mysql_close($link = null) {
    global $db;
    $link = $link ?: $db;
    return mysqli_close($link);
}

function mysql_escape_string($string) {
    global $db;
    return mysqli_real_escape_string($db, $string);
}

function mysql_select_db($database, $link = null) {
    global $db;
    $link = $link ?: $db;
    return mysqli_select_db($link, $database);
}

// Define constants if not already defined
if (!defined('MYSQL_ASSOC')) define('MYSQL_ASSOC', MYSQLI_ASSOC);
if (!defined('MYSQL_NUM')) define('MYSQL_NUM', MYSQLI_NUM);
if (!defined('MYSQL_BOTH')) define('MYSQL_BOTH', MYSQLI_BOTH);
?>
