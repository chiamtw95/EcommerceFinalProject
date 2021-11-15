<?php
    session_start();
    require_once("phpfiles/dbcontroller.php");
    require_once("phpfiles/utilities.php");
    $db_handle = new DBController();


    if (isset($_SESSION['update_success_password']) || isset($_SESSION['update_success_name']) ){
        //both name and pw change
        if ($_SESSION['update_success_password'] == true && $_SESSION['update_success_name'] == true)
        alert("Your name and password has been succesfully updated.");
        //pw change
        else if($_SESSION['update_success_password'] == true)
            alert("Your password has been succesfully updated.");
        //name change
        else if($_SESSION['update_success_name'] == true)
            alert("Your name has been succesfully updated.");

        //errors
        else if($_SESSION['update_success_password'] == false)
            alert("Please ensure you entered the correct passwords.");

        else if($_SESSION['update_success_name'] == false )
            alert("Please ensure you entered a valid name.");
        unset($_SESSION['update_success_password']);
        unset($_SESSION['update_success_name']);
    }
?>

<!-- header -->
<?php include 'templates/header.php'; ?>

<!-- body -->
<main class="index">

    <div class="intro">
            <h1>My Account</h1>
    </div>
    <!-- Account Details Form for normal users -->
    <?php

        $res = $db_handle->runQuery("SELECT * FROM users WHERE email='" . $_SESSION["email"] . "'");
        $account_details = array(
                                'email' => $res[0]["email"],
                                'password' => $res[0]["password"],
                                'fullname' => $res[0]["name"]
                            );
    ?>
    <div class="form-container">
        <form class="cart" action="phpfiles/updateAccount.php" method="POST">
                <div>
                <!-- Display Email: READONLY -->
                <label for="email">Email: </label>
                <input id="email" value="<?php echo $account_details['email'];?>" readonly="readonly">
                <!-- Change Name -->
                <label for="fullname">Fullname:</label>
                <input type="text" name="fullname" id="fullname" placeholder="Enter new name" value="<?php echo $account_details['fullname'] ?>">
                <!-- change password -->
                <label for="fullname">Change Password: </label>
                <input type="password" name="oldPassword" id="oldPassword" placeholder="Old password">
                <input type="password" name="newPassword" id="newPassword" placeholder="New password">
                <input type="password" name="repeatPassword" id="repeatPassword" placeholder="Re-type new password">

                <input type="submit" value="Update account details">
                </div>
        </form>
    </div>
    <div class="intro">
            <h1>Past Orders</h1>
    </div>
    <!-- Order History table -->
    <div class="center">
        <table cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
            <th style="text-align:center;" width="5%">OrderID</th>
            <th style="text-align:center;" width="15%">Items</th>
            <th style="text-align:center;" width="30%">Details</th>
            <th style="text-align:center;" width="20%">Total Price</th>
            </tr>

            <?php
                $query = ("SELECT * FROM orders WHERE email='" . $_SESSION["email"] . "' ORDER BY id ASC");
                $res = mysqli_query($mysqli, $query);
                if (!empty($res)) {
                    while ($row = mysqli_fetch_assoc($res)) {

                        $products = json_decode($row['products'], true); ?>

                        <tr>
                            <td> <?php echo $row['id']?> </td>
                            <td ><span class="order-history"><?php
                                foreach($products as $k => $v){
                                    echo $products[$k]['name']. "&nbsp&#215&nbsp";
                                    echo $products[$k]["quantity"] . "<br>";
                                }?>
                                </span>
                            </td>
                            <td>
                                Name: <?php echo $row['name'] ?>  <br>
                                Address: <?php echo $row['address'] ?> <br>
                                <?php echo $row['city'] . "&nbsp";
                                    echo $row['postcode'] ?>
                            </td>
                            <td>
                                <?php echo "RM" . $products[$k]["quantity"]*$products[$k]["price"]; ?>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>

        </tbody>
        </table>
    </div>

<!-- footer -->
<?php include 'templates/footer.php'; ?>