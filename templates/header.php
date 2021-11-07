<?php
    session_start();
    //Case: user not logged in
    if(!isset($_SESSION['email'])){
        header("Location: http://localhost/finalproject/login.php");
    }
    //Case: user inactive after 10 minutes
    $_SESSION['timestamp'] = time();
    if(time() - $_SESSION['last_login_timestamp'] > 600) {
        header("Location: http://localhost/finalproject/logout.php");
    }
    //Case: renew timestamp
    else {
        $_SESSION['last_login_timestamp'] = time();
    }
?>

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
    <header>
        Enjoy free shipping for any orders of RM50 and above!
    </header>



    <nav>
        <a id="brandname" href="index.php">BlumigeSeifen</a>
        <a href="payment.php" id="cart">Cart</a>
        <a href="index.php">Home</a>
        <a href="product.php">Products</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About us</a>
        <a id="login" href="login.php">My Account</a>
    </nav>