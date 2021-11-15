<?php
    session_start();
    include 'templates/header.php';
    require_once("phpfiles/dbcontroller.php");
    $db_handle = new DBController();

    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["quantity"]) && $_POST['quantity'] > 0) {
                    $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
                    //get the first data only with index [0]
                                $itemArray = array($productByCode[0]["code"]=>
                                            array('name'=>$productByCode[0]["name"],
                                                'code' => $productByCode[0]['code'],
                                                'id'=>$productByCode[0]["code"],
                                                'quantity'=>$_POST["quantity"],
                                                'review' => $productByCode['review'],
                                                'price'=>$productByCode[0]["price"],
                                                'image'=>$productByCode[0]["image"]));

                    if(!empty($_SESSION["cart_item"])) {
                    //checking new add item with currect Cart
                        if(array_key_exists($productByCode[0]["code"], $_SESSION["cart_item"])) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productByCode[0]["code"] == $k){
                                        //if the quantity  is empty, initializing the quantity to Zero
                                        if(empty($_SESSION["cart_item"][$k]["quantity"]))
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
                            if($_GET["code"] == $k)
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
<?php include 'templates/cart.php'; ?>

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
            <div>
            <form id="products" method="post" action="product.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                    <figure>
                        <img src="<?php echo $product_array[$key]["image"]; ?>" alt="product">
                        <figcaption>
                            <h4><?php echo $product_array[$key]["name"]; ?></h4>
                            <p>RM<?php echo $product_array[$key]["price"]; ?></p>

                            <div class="rating">
                                <!-- loop to print stars for ratings -->
                                <?php
                                    for($i=0; $i < $product_array[$key]['review']; $i++){ ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                <?php }?>
                            </div>
                            <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                    <!-- Post method for adding to Cart  -->
                                    <input type="submit" value="Add to Cart"/>
                        </figcaption>
                </figure>

            </form>
            </div>

        <?php
            }
        }
        ?>
    </div>

<!-- Footer -->
<?php include 'templates/footer.php'; ?>