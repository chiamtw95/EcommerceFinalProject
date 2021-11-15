<?php
    session_status();
    require_once("phpfiles/utilities.php");
    require_once("phpfiles/sessionControl.php");
    unset($_SESSION['checkout']);
    //Case: user not logged in
    if(!isset($_SESSION['email'])){
        header("Location: http://localhost/finalproject/login.php");
    }
    // //Case: user inactive after 10 minutes
    $_SESSION['timestamp'] = time();
    if(time() - $_SESSION['last_login_timestamp'] > 5) {
        header("Location: http://localhost/finalproject/logout.php");
    }
    //Case: renew timestamp
    else {
        $_SESSION['last_login_timestamp'] = time();
    }
    // Case: Successful redirect from placing an order
    if(isset($_SESSION['order_success'])){
        if($_SESSION['order_success'] == true)
            alert("Order succesfully made. Thank you for your purchase.");
        elseif($_SESSION['order_success'] == false)
            alert("Something went wrong when placing your order. Please ensure your details are correct and try again.");
        unset($_SESSION['order_success']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>BlumigSeifen </title>
</head>

<body>
    <header>
        Enjoy free shipping for any orders of RM50 and above!
        <a style="float: right" href="logout.php">Logout</a>
    </header>



    <nav>
        <a id="brandname" href="index.php">BlumigSeifen</a>
        <a href="index.php">Home</a>
        <a href="product.php">Products</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About us</a>
        <?php
            if($_SESSION['admin'] == true)
             echo "<a href='dashboard.php'>Dashboard</a>";
             else
             echo "<a href='myAccount.php'>My Account</a>";
        ?>
    </nav>