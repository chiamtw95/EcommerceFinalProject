<?php
require_once("utilities.php");


$host = "localhost";
$username = "root";
$password = "";
$db = "WebsiteDB";
$handler = mysqli_connect($host, $username, $password, $db)
    or die("Connection failed <br>" . mysqli_connect_error() . "<br>");
$email = $_POST['email'];
$name = $_POST['fullname'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$city = $_POST['city'];
$item = $_POST['item'];
$itemQuantity = $_POST['itemQuantity'];

$query = "INSERT into orders(name,email,address,postcode,city,item,qty) VALUES ('$name','$email','$address','$postcode','$city','$item','$itemQuantity')";
$insert = mysqli_query($handler, $query);
if ($insert) {
    echo ' <script> alert("Order confirmed. Thank you for the purchase!") </script>';
} else {
    echo '<script>alert("Failed to place order. Please try again.")</script>';
}

mysqli_close($handler);
exit;
?>