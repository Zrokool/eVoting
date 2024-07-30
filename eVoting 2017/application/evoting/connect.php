<?php

define('DB_NAME' , 'evoting');
define('DB_USER' , 'root');
define('DB_PASSWORD','');
define('DB_HOST', 'localhost');

$db = mysql_connect (DB_HOST, DB_USER, DB_PASSWORD );
if(!$db)
{
	die ("MySQL Error: " . mysql_error());
}
$db_select =  mysql_select_db('evoting', $db);
#echo "Connection Made";

?>