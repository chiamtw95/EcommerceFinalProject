<?php
    session_start();
    require_once('phpfiles/utilities.php');

    //redirected after failed login attmept
    if( $_SESSION['failedLogin'] == true && isset($_SESSION['failedLogin'])){
        $msg = "Incorrect username/password combination";
        alert($msg);
    }
    //redirected after registering successfully
    else if($_SESSION['failedRegistration'] == false &&
            isset($_SESSION['failedRegistration'])){
        alert("Account succesfully created. Please login.");
        session_destroy();
    }
?>

<!-- html things here -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>BlumigeSeifen </title>
    </head>

    <body>
        <div class="login-form-div">
            <h1>Login</h1>
            <form class="login" action="phpfiles/authenticate.php" method="POST">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email"><br>
                    <label for="pw">Password: </label>
                    <input type="password" name="password" id="password"><br>
                    <input type="submit" value="Login">
            </form>
            <a href="register.php">Not a member? Register here.</a>
        </div>
    </body>



</html>