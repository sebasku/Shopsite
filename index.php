<?php
	session_start();
	$path="";
	require("sitefiles/header.php"); 
?>	
<body>

<?php require("sitefiles/menu.php"); ?>
<script src="scripts/menucoll.js"></script>

<div id="items_container">
<?php require("sitefiles/messages.php"); ?>
	<div id="slidegallery">
		<h2>Nasze produkty</h2>
		<img class="slideShow" src="img/images/img1.jpg" alt="Brak zdjęcia. Zgłoś to administratorowi.">
		<img class="slideShow" src="img/images/img1.jpg" alt="Brak zdjęcia. Zgłoś to administratorowi.">
		<img class="slideShow" src="img/images/img1.jpg" alt="Brak zdjęcia. Zgłoś to administratorowi.">
		<img class="slideShow" src="img/images/img1.jpg" alt="Brak zdjęcia. Zgłoś to administratorowi.">
		<img class="slideShow" src="img/images/img1.jpg" alt="Brak zdjęcia. Zgłoś to administratorowi.">
		<img class="slideShow" src="img/images/img1.jpg" alt="Brak zdjęcia. Zgłoś to administratorowi.">		
	</div>
</div>
<script src="scripts/slideShow.js"></script>

<?php include("sitefiles/footer.html"); ?>

</body>
</html>