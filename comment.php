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
if  (!isset($_SESSION['user_id'])){

    ?>
    "Not Logged In! Can Not Submit"
    <a href = http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php> Return to News Site </a>
<?php
} else {
    require 'database.php';
    $c = (string)$_POST['comment'];

    // echo $_SESSION['story_id'];
    // echo $c;
    // echo $_SESSION['user_id'];

    $stmt = $mysqli->prepare("insert into comments (username, story_id, comment) values (?, ?, ?)");
        if(!$stmt){
	        printf("Query Prep Failed: %s\n", $mysqli->error);
	        exit;
        }

        $stmt->bind_param('sss', $_SESSION['user_id'], $_SESSION['story_id'], $c);

        $stmt->execute();
        $stmt->close();

        ?>
        
        <a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php">Comment Added.  Return to News Site</a>
        <?php
}
?>


</body>
</html>