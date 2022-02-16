<?php
    $conn = mysqli_connect("localhost", "root", "", "shopsite");
	if (!$conn) {
		die("Błąd w połączeniu z bazą danych: ".mysqli_connect_error());
	}
?>