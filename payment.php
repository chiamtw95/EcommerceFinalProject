<!-- header -->
<?php include 'templates/header.php'; ?>

<!-- body -->
<main class="index">

    <div class="intro">
        <h1>Orders</h1>
        <p></p>
    </div>

    <div class="form-container">
        <form class="cart" action="phpfiles/order_insert.php" method="POST">
            <div>
                <label for="fullname">Fullname: </label>
                <input type="text" name="fullname" id="fullname" placeholder="Your name here">

                <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="Your email here">

                <label for="address">Address: </label>
                <input type="alphanumeric" name="address" id="address" placeholder="Address">

                <label for="postcode">Postcode: </label>
                <input type="number" name="postcode" id="postcode" placeholder="Postcode">

                <label for="city">City: </label>
                <input type="text" name="city" id="city" placeholder="City">

                <label>Item to be purchased: </label>
                <select name="item" id="item">
                    <option class="assorted" value="assorted">Assorted soap bars of 8</option>
                    <option class="pink" value="pink">Pink</option>
                    <option class="blue" value="blue">Blue</option>
                    <option class="set" value="set">Wellness set</option>
                </select>
                <input type="number" name="itemQuantity" id="itemQuantity" placeholder="Qty">

                <input id="confirmorder" type="submit" value="Confirm details and place order">
            </div>
        </form>
    </div>

<!-- footer -->
<?php include 'templates/footer.php'; ?>