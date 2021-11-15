<?php
    require_once("phpfiles/dbcontroller.php");
    require_once("phpfiles/utilities.php");
    require_once("phpfiles/sessionControl.php");
    $db_handle = new DBController();

    if($_SESSION['admin'] == true){
        $query = $mysqli->prepare("SELECT * FROM admins WHERE email=?");
        $query ->bind_param('s', $_SESSION['email']);
        $query -> execute();
        $isAdmin = $query->get_result();
    }

    if(!empty($_GET["action"]) && $_GET['action']=='remove') {
        $query = $mysqli->prepare("DELETE FROM products WHERE id=?");
        $query ->bind_param("s", $_GET['id']);
        $status = $query -> execute();
        if ($status)
            alert("Product deleted.");
        else
            alert("Something went wrong.");
    }
    else if(!empty($_GET["action"]) && $_GET['action']=='add') {
        $query = $mysqli->prepare("INSERT INTO products (id,name, price, image, review, code)
                                    VALUES (null,?,?,?,?,?)");
        $query ->bind_param("sssss", $_POST['name'],$_POST['price'],$_POST['image'],$_POST['review'], $_POST['code']);
        $status = $query -> execute();

        if ($status)
            alert("New product added.");
        else
            alert("Something went wrong. Please ensure Item Name and Code are UNIQUE");
    }
?>


<?php
if($isAdmin){ ?>
<!-- body -->
<main class="index">

    <div class="intro">
            <h1>Admin Dashboard</h1>
    </div>

    <div class="center">
        <table cellpadding="10" cellspacing="1">
        <tbody>
            <tr>
            <th style="text-align:center;" >ProductID</th>
            <th style="text-align:center;" >Item Name</th>
            <th style="text-align:center;" >Price</th>
            <th style="text-align:center;" >Image</th>
            <th style="text-align:center;" >Reviews</th>
            <th style="text-align:center;" >Code</th>
            <th style="text-align:center;" >Delete</th>
            </tr>

            <?php
                $res = $db_handle -> runQuery( "SELECT * FROM products ORDER BY id ASC");
                if(!empty($res)){
                    foreach($res as $k => $v){
                        echo "<tr>";
                        foreach($res[$k] as $key => $value){
                            if($key == 'image')
                                echo "<td><img src='" . $res[$k][$key] . "' style='width: 40px; height: 40px;'/></td>";
                            else
                                echo "<td>" . $res[$k][$key] . "</td>";
                        } ?>
                    <!-- remove button -->
                    <td>
                        <a href="dashboard.php?action=remove&id=<?php echo $res[$k]['id']; ?>" class="btnRemoveAction">
                        <img src="style/images/icon-delete.png" alt="Remove Item" /></a>
                    </td>
                <?php echo "</tr>";
                    }
                }
            ?>
            <tr>
                <form action="dashboard.php?action=add" method="POST">
                <td></td>
                <td><input type="text" name="name" id="name" placeholder="Item name"></td>
                <td><input type="number" name="price" id="price" placeholder="Price"></td>
                <td><input type="text" name="image" id="image" placeholder="Image link"></td>
                <td><input type="number" name="review" id="review"placeholder="Item rating out of 5"></td>
                <td><input type="text" name="code" id="code" placeholder="Item code"></td>
                <td><input type="submit" value="Add new Product"></td>
            </form>
            </tr>
            <a href="index.php">Back to homepage</a>
</main>
<?php }
else{
    alert("Admins only");
    redirect();
}