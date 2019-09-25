<?php 
session_start();
?>
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


require 'database.php';

// Use a prepared statement
$stmt = $mysqli->prepare("SELECT COUNT(*), username, password FROM userinfo WHERE username=?");

// Bind the parameter
$user = (string)$_POST['username'];
$stmt->bind_param('s', $user);
$stmt->execute();

// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['password'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
    $_SESSION['user_id'] = $user_id;
    $_SESSION['pu'] = $user_id;
    // Redirect to your target page
    // header("Location: mainpaige.php");
    ?>

    <a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php"> Login Successful! Continue to News Site </a>
<?php
} else{
    // Login failed; redirect back to the login screen
    // header("Location: newhome.php");
    ?>
    <a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/newhome.php"> Login Failed! Return to Homepage </a>
<?php
}

?>







</body>
</html>
