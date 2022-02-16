<?php
	$path="../";
	session_start();
	require($path."config.php");
	require($path."sitefiles/public_functions.php");
	require($path."sitefiles/header.php"); 
	
	$item = getItem($_GET['id'], $_GET['isWoman']);
?>	
<body>

<?php require($path."sitefiles/menu.php"); ?>
<script src="<?php echo $path;?>scripts/menucoll.js"></script>

<div id="items_container">
	<div id="oneitem_image">
		<img src="<?php echo $path.'img/images/'.$item['image'];?>" alt="Brak zdjęcia. Zgłoś to administratorowi serwisu.">
	</div>
	
	<div id="oneitem_info">
		<div id="oneitem_info2">
		<h3><?php echo $item['name']; ?></h3>
		<h4><?php echo $item['cost']; ?> zł</h4>
		<div id="oneitem_infocart"><a href="<?php echo $path;?>usites/cart.php?add-item=<?php echo $_GET['id']; ?>&isWoman=<?php echo $item['isWoman']; ?>">Do koszyka</a></div>
		</div>
	</div>

	<div id="oneitem_descr">
		<p><?php echo $item['descr']; ?></p>
	</div>
</div>

<?php include($path."sitefiles/footer.html"); ?>

</body>
</html>