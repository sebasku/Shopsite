<?php
	$path="../";
	session_start();
	require($path."config.php");
	require($path."sitefiles/public_functions.php");
	require($path."sitefiles/header.php"); 
?>  	
<body>

<?php require($path."sitefiles/menu.php"); ?>
<script src="<?php echo $path;?>scripts/menucoll.js"></script>

<div id="items_container">
<?php include($path.'sitefiles/errors.php'); ?>
<?php include($path.'sitefiles/messages.php') ?>

<?php if(!isset($_SESSION['id']) || $_SESSION['role']!=='User'): ?> <h1>By korzystać z koszyka musisz się zalogować</h1>
<?php else:
		$show_from_cart=ShowItemsFromCart();
		if($show_from_cart===false):?> <h1>Brak przedmiotów w koszyku</h1>
  <?php else: ?>
	<h1>Koszyk</h1>
			<div id="item_cart_top">
				<div class="item_img">
					<p>Zdjęcie produktu</p>
				</div>
				<div class="item_name">
					<p>Nazwa produktu</p>
				</div>
				<div class="item_quantity">
					<p>Ilość produktu</p>
				</div>
				<div class="item_cost">
					<p>Cena produktu</p>	
				</div>
			</div>
		<?php $items_value=0;
			foreach($show_from_cart as $item): ?>
			<div class="item_cart">
				<div class="item_img">
					<img src="../img/images_min/<?php echo $item['image']; ?>" alt="Brak zdjęcia. Poinformuj administratora"></img>
				</div>
				<div class="item_name">
					<p><?php echo $item['name']; ?></p>
				</div>
				<div class="item_quantity">
					<?php $item_quantity=GetQuantity($item['id'], $_SESSION['id']);?>
					<p><?php echo $item_quantity; ?>
						<a href="cart.php?add-quantity=<?php echo $item['id']; ?>&user_id=<?php echo $_SESSION['id'];?>&quantity=<?php echo $item_quantity;?>">+</a>
						<a href="cart.php?dec-quantity=<?php echo $item['id']; ?>&user_id=<?php echo $_SESSION['id'];?>&quantity=<?php echo $item_quantity;?>">-</a>
					</p>
				</div>
				<div class="item_cost">
					<p><?php echo $item['cost']; ?> zł</p>
				</div>
				<div class="item_remove">
					<a href="cart.php?remove-cart=<?php echo $item['id']; ?>&user_id=<?php echo $_SESSION['id']; ?>">Usuń</a>
				</div>
			</div>
			  <?php $items_value+=$item_quantity*$item['cost']; ?>
		<?php endforeach; ?>
			<div id="item_cart_bottom">
				<div id="item_cart_confirm">
					<p>Całkowity koszt:<span><?php echo $items_value;?> zł</span></p>
					<a href="cart.php?buy-confirmed">Zakup</a>
				</div>
				<div id="item_cart_clear">
					<a href="cart.php?clear-cart=<?php echo $_SESSION['id']; ?>">Wyczyść koszyk</a>
				</div>
			</div>
	<?php endif; ?>
	<?php endif; ?>
</div>

<?php include($path."sitefiles/footer.html"); ?>

</body>
</html>