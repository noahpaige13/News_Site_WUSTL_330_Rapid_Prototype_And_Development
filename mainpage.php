<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CompSci Newz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    Computer Science Newz
</head>
<body>


<a href = addstory.php> <br> <br> Submit New Story (Note: Only Passes if Logged In!)</a>

<div id = "logout">
        <form name = "logout" action = "logout.php" method = "GET">
            <input type = "submit" value = "Log Out" />
        </form>
</div>
<br>


<?php    

require 'database.php';
// View Stories on Main page


$stmt = $mysqli->prepare("select title, username, story_id from stories");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

// $stmt->bind_param('sss', $user, $title, $story);

$stmt->execute();

$stmt->bind_result($title, $user, $story_id);

echo "<ul>\n";
while($stmt->fetch()){
    $link = 'http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/readstory.php?story_id='.$story_id;
    $dellink ='http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/deletestory.php?story_id='.$story_id;
    $editlink ='http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/editstory.php?story_id='.$story_id;
    
    printf("\t<li> %s <br> By: %s <br> <br> </li>",
		htmlspecialchars($title),
        htmlspecialchars($user));

    // $_SESSION['story_id'] = $story_id;

    // CHECK IF YOURE THE CREATOR

    if($user == $_SESSION['user_id']){
        
        // <!-- Edit Article -->
        printf('<a href = "%s" > Edit Article </a> <br>', $editlink);

        // <!-- Delete Article -->
        printf('<a href = "%s" > Delete Article </a> <br>', $dellink);

       
    }

    // Otherwise Just Read
    // $_SESSION['story_id'] = $story_id;
    // $n = (int)$_SESSION['story_id'];


    printf('<a href = "%s" > Read Article </a> <br>', $link);

    
    echo "<br><br>";

}
echo "</ul><br><br>";
$stmt->close();




?>
</body>



</html>

<!-- database: allusers
     Tables: stories and userinfo -->