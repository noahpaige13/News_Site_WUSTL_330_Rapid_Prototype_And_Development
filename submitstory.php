<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Story</title>
</head>
<body>
    <?php
    if  (!isset($_SESSION['user_id'])){

    ?>

    "Not Logged In! Can Not Submit"
    <a href = http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php> Return to News Site </a>


    <?php

    } else {


        require 'database.php';
        // add and view stories -- include usr for delete privs
        // 
        $user = $_SESSION['user_id'];
        $title = $_POST['title'];
        $story = $_POST['story'];

        $stmt = $mysqli->prepare("insert into stories (username, title, story) values (?, ?, ?)");
        if(!$stmt){
	        printf("Query Prep Failed: %s\n", $mysqli->error);
	        exit;
        }

        $stmt->bind_param('sss', $user, $title, $story);

        $stmt->execute();
        $stmt->close();
        ?>
        "Submission Success"
        <a href = http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php> Return to News Site </a>
        <?php
    }
    ?>
    

</body>
</html>