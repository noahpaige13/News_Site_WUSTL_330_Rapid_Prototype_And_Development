<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CompSci Newz</title>
    Computer Science Newz
</head>
<body>

<?php    
require 'database.php';
// add and view stories -- include usr for delete privs
// 
$user = $_POST['user'];
$title = $_POST['title'];
$story = $_POST['story'];

$stmt = $mysqli->prepare("insert into stories (user, title, story) values (?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('sss', $user, $title, $story);

$stmt->execute();

$stmt->bind_result($user, $title, $story);

echo "<ul>\n";
while($stmt->fetch()){
	printf("\t<li>%s %s</li>\n",
		htmlspecialchars($user),
        htmlspecialchars($title),
        htmlspecialchars($story)
	);
}
echo "</ul>\n";

$stmt->close();




?>
</body>
</html>

<!-- database: allusers
     Tables: stories and userinfo -->