<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Home</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>
<body>
Welcome to NewSite Login
    <!-- Log In Form -->
    <form name = "username" action ="checkuser.php" method = "POST" >
        Username: <input type = "text" name = "username"/>
        Password: <input type = "text" name = "password"/>
        <input type = "submit" value = "Log In"/>

    </form>


    <!-- New User Form -->
    <form name = "newuser" action ="newuser.php" method = "POST" >
        Create New User: <input type = "text" name = "newuser"/>
        New User Password: <input type = "text" name = "newpassword"/>
        <input type = "submit" value = "Create New User"/>

    </form>

    <!-- Delete User Form -->
    <form name = "deluser" action ="deleteuser.php" method = "POST" >
        Delete Username: <input type = "text" name = "deluser"/>
        User's Password: <input type = "text" name = "delpassword"/>
        <input type = "submit" value = "Delete User"/>

    </form>
    


    <a href = "http://ec2-user@ec2-18-217-184-126.us-east-2.compute.amazonaws.com/~noahpaige/module3_group/mainpage.php"> Continue as Guest to News Site </a>



</body>
</html>
