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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$stmt->close();

if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
    $_SESSION['user_id'] = $user_id;
    

    // DELTE USER COMMENTS
    $stmt = $mysqli->prepare("delete from comments where username=?");
    if(!$stmt){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
    }   

    $stmt->bind_param('s', $user);

    $stmt->execute();
    $stmt->close();


    // DELETE USER POSTS
    
    $stmt2 = $mysqli->prepare("delete from stories where username=?");
    if(!$stmt2){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
    }   

    $stmt2->bind_param('s', $user);

    $result = $stmt2->execute();
    if($result){
        printf("Query Failed: %s\n", $mysqli->error);
    }
    $stmt2->close();
    // echo ('Done');



    // echo ('Done');
    // DELETE FROM USERINFO
    $stmt3 = $mysqli->prepare("delete from userinfo where username=?");
    if(!$stmt3){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
    }   

    $stmt3->bind_param('s', $user);

    $stmt3->execute();
    $stmt3->close();
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