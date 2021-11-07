<?php
    require_once("utilities.php");
    session_start();

    if(isset($_POST['email']) && isset($_POST['password'])){
        //need to sanitize TODO hashing
        $email = sanitize($_POST['email']);
        $pw = $_POST['password'];

        //begin the query
        $query = $mysqli->prepare("SELECT * FROM users WHERE email=?");
        $query ->bind_param("s", $email);
        $query -> execute();

        $result = $query->get_result();
        $row = $result->fetch_assoc();

        //if login successful
        if ($result && password_verify($pw, $row['password'])){
            $_SESSION['last_login_timestamp'] = time();
            $_SESSION['email'] = $email;

            unset($row['password']);
            unset($_SESSION['failedLogin']);
            header("Location: http://localhost/finalproject/index.php");
        }
        else{
            $_SESSION['failedLogin'] = true;
            header("Location: http://localhost/finalproject/login.php");
        }
    }
    $mysqli->close();
?>