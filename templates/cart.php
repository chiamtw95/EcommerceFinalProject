<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>

<a id="btn-empty" href="product.php?action=empty"> Empty Cart</a>
<!-- This table is the shopping cart.  -->
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:right;" width="15%">Quantity</th>
<th style="text-align:right;" width="20%">Unit Price</th>
<th style="text-align:right;" width="20%">Price</th>
<th style="text-align:center;" width="15%">Remove</th>
</tr>
<?php
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td>
					<img src="<?php echo $item["image"]; ?>" class="cart-item-image" />
					<!-- <img src="style/images/blue.jpg" class="cart-item-image" /> -->
					<?php echo $item["name"]; ?>
				</td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;">
					<!-- Get method to remove item in Cart -->
					<a href="product.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">
					<img src="style/images/icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
	<?php if(!isset($_SESSION['checkout']) && $_SESSION['checkout'] == false) {?>
	<tr>
			<td colspan="5" align="right">
				<a href="checkout.php"><input type="submit" value="Checkout"/></a>
			</td>
	</tr>
	<?php }?>
</tbody>
</table>

<?php
}
else{
?>
	<!-- When cart is empty  -->
	<div class="intro"> <p class="center"></p> Your Cart is Empty</div>

<?php } ?>
</div>