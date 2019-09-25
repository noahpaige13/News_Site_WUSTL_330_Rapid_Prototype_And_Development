<?php 
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Sign Up</title>
</head>
<body>
    
</body>



<?php
// Check Errors
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ALL;

require 'database.php';

$u = (string)$_POST['newuser'];
$p = (string)$_POST['newpassword'];
$_SESSION['user_id'] = $u;
$_SESSION['pu'] = $u;
$p = password_hash($p, PASSWORD_BCRYPT);


$stmt = $mysqli->prepare("insert into userinfo (username, password) values (?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('ss', $u, $p);

$stmt->execute();
$stmt->close();

$stmt2 = $mysqli->prepare("grant select,insert,update,delete on allusers.* to $u@'localhost' ");
// $stmt2->bind_param('s', $u);

$stmt2->execute();
$stmt2->close();

$stmt3 = $mysqli->prepare('flush privileges');

$stmt3->execute();
$stmt3->close();

// header("Location: mainpage.php");
// http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/

?>

<a href = http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php> Login Succesful! Go to News Site </a>

</html>