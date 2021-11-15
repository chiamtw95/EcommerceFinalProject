<?php
require_once("utilities.php");
session_start();

//Ensures Registration form is filled
if(isset($_POST['fullname']) &&
    isset($_POST['email']) &&
    isset($_POST['address']) &&
    isset($_POST['postcode']) &&
    isset($_POST['city']) &&
    preg_match($city_pattern, $_POST['city']) &&
    isset($_SESSION['cart_item']))
{
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $postcode =$_POST['postcode'];
    $city =$_POST['city'];
    $products = json_encode($_SESSION['cart_item']);

    //sanitizing
    $name = sanitize($name);
    $email = filter_var ($email, FILTER_SANITIZE_EMAIL);
    $address = sanitize($address);
    $postcode = sanitize($postcode);
    $city= sanitize($city);


    //Add user into database
    $query = $mysqli->prepare("INSERT INTO orders (id, email, products, name, address, postcode, city) VALUES(null, ?,?,?,?,?,?)");
    $query ->bind_param("ssssss", $email, $products, $name, $address, $postcode, $city);
    $status = $query -> execute();

    //successfully inserted into DB
    if($status){
        $_SESSION['order_success'] = true;
        unset($_SESSION['cart_item']);
        header("Location: http://localhost/finalproject/index.php");
    }
}
else{
    $_SESSION['order_success'] = false;
     header("Location: http://localhost/finalproject/checkout.php");
 }

$mysqli->close();
exit;
?>

