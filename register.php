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
        <h1>Register</h1>
        <form class="login" action="phpfiles/addUser.php" method="POST">
                <label for="name">Full Name: </label>
                <input type="text" name="fullname" id="fullname"><br>

                <label for="email">Email: </label>
                <input type="email" name="email" id="email"><br>

                <label for="pw">Password: </label>
                <input type="text" name="password" id="password"><br>

                <label for="pw">Repeat password: </label>
                <input type="text" name="password" id="password-repeat"><br>


                <input type="submit" value="Register">
        </form>
        <a href="login.php">Already have an account? Login here.</a>
    </div>
</body>



</html>