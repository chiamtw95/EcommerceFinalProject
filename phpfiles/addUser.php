<?php
require_once("utilities.php");

//Ensures Registration form is filled and password is the same password
if(isset($_POST['fullname']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['password-repeat']) &&
    ($_POST['password'] == $_POST['password-repeat']))
{
    session_start();
    $email = $_POST['email'];
    $pw = $_POST['password'];
    $name = $_POST['fullname'];

    //sanitize name
    $name = sanitize($name);
    //validate email
    $email = filter_var ( $email, FILTER_SANITIZE_EMAIL);
    //hash pw
    $hashpw = password_hash($pw,PASSWORD_DEFAULT);

    //Add user into database
        $query = $mysqli->prepare("INSERT INTO users (email,password,name) VALUES(?,?,?)");
        $query ->bind_param("sss", $email, $hashpw, $name);
        $status = $query -> execute();
        //success
        if($status){
            unset($_SESSION['failedRegistration']);
            $_SESSION['failedRegistration'] = false;
            header("Location: http://localhost/finalproject/login.php");
        }//fail
        else{
            $_SESSION['failedRegistration'] = true;
            header("Location: http://localhost/finalproject/register.php");
        }
}

$mysqli->close();
exit;
?>

