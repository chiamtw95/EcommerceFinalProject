<?php
require_once("utilities.php");
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(isset($_POST['fullname']) &&
    isset($_POST['email']) &&
    isset($_POST['msg'])
){
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    //sanitizing
    $name = sanitize($name);
    $email = filter_var ($email, FILTER_SANITIZE_EMAIL);
    $msg = sanitize($msg);

    $query = $mysqli->prepare("INSERT INTO enquiry (name, email, message) VALUES(?,?,?)");
    $query ->bind_param("sss", $name, $email, $msg);
    $status = $query -> execute();

    if($status)
        alert("Enquiry inserted succesfully.");
    else
        alert("Enquiry insertion was unsuccesful. Please try again.");

}
redirect();

$mysqli->close();
exit;
?>