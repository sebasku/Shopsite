<?php
	$path="../";
	session_start();
	require($path."config.php");
	require($path."sitefiles/logreg_func.php");
	require($path."sitefiles/header.php"); 
?>
<body>

<?php require($path."sitefiles/menu.php"); ?>
<script src="<?php echo $path; ?>scripts/menucoll.js"></script>

<div id="items_container">
	<?php include($path."sitefiles/errors.php"); ?>
	<div id="logreg_container">
			

		<div id="login_div">
			<form method="post" action="logreg.php" >
				<h2>Logowanie</h2>		
				<label>Nazwa użytkownika:</label><input type="text" name="username" placeholder="Nazwa użytkownika"><br>
				<label>Hasło:</label><input type="password" name="password" placeholder="Hasło"><br>
				<button type="submit" class="btn" name="log_user">Zaloguj</button>
			</form>
		</div>

		<div id="register_div">
			<form method="post" action="logreg.php" >
				<h2>Rejestracja</h2>
				<label>Nazwa użytkownika:</label><input type="text" name="username" placeholder="Nazwa użytkownika"><br>
				<label>Adres email:</label><input type="email" name="email" placeholder="Adres email"><br>
				<label>Hasło:</label><input type="password" name="password1" placeholder="Hasło"><br>
				<label>Ponów hasło:</label><input type="password" name="password2" placeholder="Ponów hasło"><br>
				<button type="submit" class="btn" name="reg_user">Zarejestruj</button>
			</form>
		</div>
	</div>
</div>

<?php include($path."sitefiles/footer.html"); ?>

</body>
</html>
