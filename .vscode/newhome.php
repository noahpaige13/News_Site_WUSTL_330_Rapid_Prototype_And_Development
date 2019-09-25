<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Home</title>
</head>
<body>

    <!-- Log In Form -->
    <form name = "username" action ="checkuser.php" method = "GET" >
        Username: <input type = "text" name = "username"/>
        <input type = "submit" value = "Log In"/>

    </form>


    <!-- New User Form -->
    <form name = "newuser" action ="newuser.php" method = "GET" >
        Create New User: <input type = "text" name = "newuser"/>
        <input type = "submit" value = "Create New User"/>

    </form>

   
<a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/newhome.php"> Continue to News Site as Guest </a>

    


</body>
</html>