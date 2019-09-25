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
$id = $_SESSION['edit_id'];
$edits = $_POST['edits'];

$stmt = $mysqli->prepare("update stories set story = (?) where story_id = (?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('ss', $edits, $id);

    $stmt->execute();
    $stmt->close();
    ?>

    "Edit Success"
    <a href = http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php> Return to News Site </a>

    
</body>
</html>