<?php
    session_start();

    if(isset($_SESSION['username'])){

    }
    else{
        header("Location: http://localhost/finalproject/login.php");
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
        <a class="login" href="login.php">Login/Register</a>
    </header>



    <nav>
        <a id="brandname" href="index.php">BlumigeSeifen</a>
        <a href="payment.php" id="cart">Cart</a>
        <a href="index.php">Home</a>
        <a href="product.php">Products</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About us</a>
        <a id="login" href="login.php">Login/Register</a>
    </nav>