<?php

// Content of database.php

$usr = 'noah';
$pwd = 'Towanda15';

$mysqli = new mysqli('localhost', $usr, $pwd, 'allusers');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}

?>