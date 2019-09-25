<?php 
session_start();
?>
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
$user = (string)$_POST['deluser'];
$stmt->bind_param('s', $user);
$stmt->execute();


// Bind the results
$stmt->bind_result($cnt, $user_id, $pwd_hash);
$stmt->fetch();

$pwd_guess = $_POST['delpassword'];
// Compare the submitted password to the actual password hash

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
    $_SESSION['user_id'] = $user_id;
    
    // DELETE USER POSTS
    
    $stmt = $mysqli->prepare("delete from stories where username = (?)");
    if(!$stmt){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
    }   

    $stmt->bind_param('s', $user);

    $stmt->execute();
    $stmt->close();
    // echo ('Done');


    // DELTE USER COMMENTS
    $stmt = $mysqli->prepare("delete from comments where username = (?)");
    if(!$stmt){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
    }   

    $stmt->bind_param('s', $user);

    $stmt->execute();
    $stmt->close();
    // echo ('Done');
    // DELETE FROM USERINFO
    $stmt = $mysqli->prepare("delete from userinfo where username = (?)");
    if(!$stmt){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
    }   

    $stmt->bind_param('s', $user);

    $stmt->execute();
    $stmt->close();
    // echo ('Done');
    session_destroy();

    ?>

    <a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/newhome.php"> Deletion Success! Return to Home Page </a>

<?php
} else{
    // Login failed; redirect back to the login screen
    ?>

    Deletion Failed: Wrong Username/Password! <br>
    <a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/newhome.php">  Return to Homepage </a>
<?php
}

?>

    
</body>
</html>