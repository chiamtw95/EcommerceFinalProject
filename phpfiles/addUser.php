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

    //sanitizing, hashing, and validation
    $name = sanitize($name);
    $email = filter_var ($email, FILTER_SANITIZE_EMAIL);
    $hashpw = password_hash($pw,PASSWORD_DEFAULT);

    if(preg_match($name_pattern,$name)){
         //Add user into database
         $query = $mysqli->prepare("INSERT INTO users (email,password,name) VALUES(?,?,?)");
         $query ->bind_param("sss", $email, $hashpw, $name);
         $status = $query -> execute();

         //successfully inserted into DB
         if($status){
             unset($_SESSION['failedRegistration_email']);
             unset($_SESSION['failedRegistration_name']);
             header("Location: http://localhost/finalproject/login.php");
         }
         //failed to insert into DB
         else{
             $_SESSION['failedRegistration_email'] = true;
             header("Location: http://localhost/finalproject/register.php");
         }
    }
    //Failed to match patterns of name and email
    else{
        $_SESSION['failedRegistration_name'] = true;
        header("Location: http://localhost/finalproject/register.php");
    }
}
$mysqli->close();
exit;
?>

