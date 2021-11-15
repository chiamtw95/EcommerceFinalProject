<?php
session_start();
require_once("phpfiles/dbcontroller.php");
$db_handle = new DBController();
// Inject header
include 'templates/header.php'; ?>

<main class="index">
<?php
$_SESSION['checkout']=true;
// Inject cart template
include 'templates/cart.php';
?>


    <div class="intro">
        <h1>Orders</h1>
    </div>

    <div class="form-container">
        <form class="cart" action="phpfiles/addOrder.php" method="POST">
            <div>
                <label for="fullname">Fullname: </label>
                <input type="text" name="fullname" id="fullname" placeholder="Name">

                <label for="email">Email: </label>
                <input name="email" id="email" value="<?php echo $_SESSION['email'];?>" readonly="readonly">

                <label for="address">Address: </label>
                <input type="text" name="address" id="address" placeholder="Address">

                <label for="postcode">Postcode: </label>
                <input type="number" name="postcode" id="postcode" placeholder="Postcode">

                <label for="city">City: </label>
                <input type="text" name="city" id="city" placeholder="City">

                <input type="submit" value="Confirm details and place order">
            </div>
        </form>
    </div>

<!-- footer -->
<?php include 'templates/footer.php'; ?>

