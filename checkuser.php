<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<?php 
// Check Errors
// session_start();
// session_regenerate_id(true); 
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);

$userexist = (int)-1;
$username = (string)$_GET["username"];

$_SESSION["username"] = String($username);

require 'database.php';

$stmt = $mysqli->prepare("select username from userinfo where username = $username");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$result = $stmt->get_result();
$_SESSION["result"] = $result;

$stmt->close();

if (isset($result))
{
    header("Location: mainpaige.php");
}

else{
    print htmlentities("No user found!");
}
?>


<a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/newhome.php"> Return to Homepage </a>





</body>
</html>
