<?php
	$path="../";
	session_start();
	require($path."config.php");
	require($path."sitefiles/public_functions.php");
	require($path."sitefiles/header.php"); 
	
	if (isset($_GET['category'])) $items = getItems($_GET['category'],$_GET['isWoman']);
	else $items= getItems('all',$_GET['isWoman']);
?>	
<body>

<?php require($path."sitefiles/menu.php"); ?>
<script src="<?php echo $path;?>scripts/menucoll.js"></script>

<div id="items_container">
<?php foreach ($items as $item): ?>
	<div class="item_div">
		<div class="item_image">
			<a href="viewoneitem.php?id=<?php echo $item['id']; ?>&isWoman=<?php echo $item['isWoman']; ?>">
				<img src="<?php echo $path.'img/images_min/'.$item['image']; ?>" class="item_image" alt="Brak zdjęcia. Zgłoś to administratorowi serwisu.">
			</a>
		</div>
		<a class="itemtexta" href="viewoneitem.php?id=<?php echo $item['id']; ?>&isWoman=<?php echo $_GET['isWoman'];?>">
			<div class="item_info">
				<h3><?php echo $item['name']; ?></h3>
				<h4><?php echo $item['cost']; ?> zł</h4>
			</div>
		</a>
	</div>
<?php endforeach ?>
</div>

<?php include($path."sitefiles/footer.html"); ?>

</body>
</html>