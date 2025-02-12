<?php
// Get environment variables with fallbacks
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASSWORD') ?: '';
$db_name = getenv('DB_NAME') ?: 'evoting';

// Use mysqli instead of deprecated mysql_connect
$db = mysqli_connect($db_host, $db_user, $db_pass);
if (!$db) {
    die("MySQL Error: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($db, $db_name);
if (!$db_select) {
    die("Database Selection Error: " . mysqli_error($db));
}

// Set charset to ensure proper character handling
mysqli_set_charset($db, 'utf8');

#echo "Connection Made";
?>
