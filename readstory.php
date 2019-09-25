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

$story_id = (int)$_GET['story_id'];
$_SESSION['story_id'] = $story_id;
// echo $story_id;

$stmt = $mysqli->prepare("select title, username, story from stories where story_id =(?)");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('s', $story_id);

$stmt->execute();

$stmt->bind_result($title, $user, $story);
while($stmt->fetch()){
printf("\t Title:    %s <br> By:    %s <br> <br> <u>Story:</u><br>   %s<br><br>",
		htmlspecialchars($title),
        htmlspecialchars($user), 
        htmlspecialchars($story));


}
$stmt->close();

?>

<br> <u>Comments: </u><br>

<?php

$stmt = $mysqli->prepare("select username, comment, comment_id from comments where story_id =(?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('s', $story_id);

$stmt->execute();

$stmt->bind_result($username, $comment, $comment_id);


echo "<ul>\n";
while($stmt->fetch()){
    $dellink ='http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/deletecom.php?story_id='.$comment_id;
    $editlink ='http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/editcom.php?story_id='.$comment_id;
    

    printf("\t<li> <pre> %s : </pre>   %s <br><br> </li>",
		htmlspecialchars($username),
        htmlspecialchars($comment));


echo "</ul>";

if($user == $_SESSION['user_id']){
    // <!-- Edit Comment -->
    printf('<a href = "%s" > Edit Comment </a> <br>', $editlink);

    // <!-- Delete Comment -->
    printf('<a href = "%s" > Delete Article </a> <br>', $dellink);
}
}

?>

<!-- Add Comment Form -->
<form name = "comment" action ="comment.php" method = "post" >
        Comment: <input type = "text" name = "comment"/>
        <input type = "submit" value = "Add"/>

    </form>


<a href = http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php> Return to News Site </a>




</body>
</html>