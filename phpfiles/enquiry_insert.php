<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "WebsiteDB";
$handler = mysqli_connect($host, $username, $password, $db) or die("Connection failed <br>" . mysqli_connect_error() . "<br>");

$email = $_POST['email'];
$name = $_POST['fullname'];
$msg = $_POST['msg'];


$query = "INSERT into enquiry VALUES ('$name', '$email','$msg')";
$insert = mysqli_query($handler, $query);
$errormsg = mysqli_error($handler);

if ($insert) {
    echo ' <script> alert("Enquiry inserted succesfully.") </script>';
} else {
    echo '<script>alert("Enquiry insertion was unsuccesful.")</script>';
}
mysqli_close($handler);
exit;
?>