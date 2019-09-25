<?php 
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read Story</title>
</head>
<body>


<?php
require 'database.php';

$usr = $_GET['user'];
$id = $_GET['story_id'];
$tit = $_GET['title'];
$stry = $_GET['story'];

$stmt0 = $mysqli->prepare("select stories.story_id from stories join userinfo on (userinfo.username) where story_id=?");
if(!$stmt0){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt0->execute();

$stmt0->bind_result($usr, $tit, $stry);


$user = $_POST['user'];
$title = $_POST['title'];
$story = $_POST['story'];

$stmt = $mysqli->prepare("select user, title, story from stories");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->execute();

$stmt->bind_result($user, $title, $story);

echo "<ul>\n";
while($stmt->fetch()){
	printf("\t<li><h1>%s</h1> by %s</li>\n<li>%s</li>",
		htmlspecialchars($title),
        htmlspecialchars($user),
        htmlspecialchars($story)
	);
}
echo "</ul>\n";

$stmt->close();
?>


</body>
</html>