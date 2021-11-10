<?php
    include 'templates/header.php';
    session_start();
    require_once("phpfiles/dbcontroller.php");
    $db_handle = new DBController();

    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["quantity"]) && $_POST['quantity'] > 0) {
                    $productById = $db_handle->runQuery("SELECT * FROM products WHERE id='" . $_GET["id"] . "'");
                    //get the first data only with index [0]
                                $itemArray = array($productById[0]["id"]=>
                                            array('name'=>$productById[0]["name"],
                                                'id'=>$productById[0]["id"],
                                                'quantity'=>$_POST["quantity"],
                                                'price'=>$productById[0]["price"], '
                                                image'=>$productById[0]["image"]));

                    if(!empty($_SESSION["cart_item"])) {
                    //checking new add item with currect Cart
                        if(array_key_exists($productById[0]["id"], $_SESSION["cart_item"])) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productById[0]["id"] == $v['id']){
                                        //if the quantity  is empty, initializing the quantity to Zero
                                        if(empty($v['id']))
                                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                                        //if the item already in the Cart, add the quantity
                                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                    }
                            }
                        }
                        //if current item is not in the cart, add the item
                        else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    }
                    else {
                        //if the session is empty, start the new session.
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            break;
            case "remove":
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["id"] == $v['id'])
                                unset($_SESSION["cart_item"][$k]);
                            // if no more item in cart, empty the session
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);

                    }
                }
            break;
            case "empty":
                unset($_SESSION["cart_item"]);
                // header("Location: http://localhost/finalproject/product.php");
            break;
        }
        }
?>

<main class="index">
<!-- Inject cart template -->
<?php
    include 'templates/cart.php';
?>



    <div class="intro">
        <h1>Our Products</h1>
    </div>

    <div class="product-wrapper">
    <!-- dynamically display products -->
    <?php
        $product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY id ASC");
        if (!empty($product_array)) {
            foreach($product_array as $key=>$value){
	?>

        <form id="products" method="post" action="product.php?action=add&id=<?php echo $product_array[$key]["id"]; ?>">
                <figure>
                    <img src="<?php echo $product_array[$key]["image"]; ?>" alt="product">
                    <figcaption>
                        <h4><?php echo $product_array[$key]["name"]; ?></h4>
                        <p>RM<?php echo $product_array[$key]["price"]; ?></p>
                        <div class="rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                <!-- Post method for adding to Cart  -->
                                <input type="submit" value="Add to Cart"/>
                    </figcaption>
            </figure>

        </form>

    <?php
		}
	}
	?>
    </div>
    <!-- <div class="product-wrapper">

        <figure>
            <img src="style/images/index.jpg" alt="product">
            <figcaption>
                <h4>Assorted Soap Bars of 8</h4>
                <p>RM 100.00</p>
                <div class="rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <a href="payment.html"><button href="payment.html" >Buy now</button></a>
            </figcaption>
        </figure>

        <figure>
            <img src="style/images/pink.jpg" alt="product">
            <figcaption>
                <h4>Pink</h4>
                <p>RM 15.00</p>
                <div class="rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <a href="payment.html"><button href="payment.html" >Buy now</button></a>
            </figcaption>
        </figure>

        <figure>
            <img src="style/images/blue.jpg" alt="product">
            <figcaption>
                <h4>Blue</h4>
                <p>RM 15.00</p>
                <div class="rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <a href="payment.html"><button href="payment.html" >Buy now</button></a>
            </figcaption>
        </figure>

        <figure>
            <img src="style/images/set.jpg" alt="product">
            <figcaption>
                <h4>Wellness Set</h4>
                <p>RM 69.00</p>
                <div class="rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <a href="payment.html"><button href="payment.html" >Buy now</button></a>
            </figcaption>
        </figure>
    </div> -->

<!-- Footer -->
<?php include 'templates/footer.php'; ?>