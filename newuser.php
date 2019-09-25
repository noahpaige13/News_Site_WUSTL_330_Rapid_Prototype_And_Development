<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>



<?php
// Check Errors
session_start();


require 'database.php';

$u = $_SESSION['newuser'];
$p = $_SESSION['newpassword'];
$p = password_hash($p);


$stmt = $mysqli->prepare("insert into userinfo (username, password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ss', $u, $p);

$stmt->execute();


$stmt2 = $mysqli->prepare(sprintf("grant select,insert,update,delete on allusers.* to %s@'localhost'",$u));
$stmt3 = $mysqli->prepare('flush privileges');

$stmt2->execute();
$stmt3->execute();

$stmt->close();
$stmt2->close();
$stmt3->close();

header("Location: mainpaige.php");


?>


</html>