<?php
	session_start();
	$path="../";
	require($path."config.php");
	require("admin_sitefiles/admin_functions.php");
	
	$mainpanel=true;
	$users = getUsers();

	require($path."sitefiles/header.php");

	if(empty($_SESSION['user']) || $_SESSION['role']==='user'){
		header('location: '.$path.'index.php');
		exit();
	}

?>
<body>

<?php require($path."sitefiles/menu.php"); ?>
<script src="<?php echo $path;?>scripts/menucoll.js"></script>

<div id="items_container">
	<div id="adminpanel_links">
			<?php if($_SESSION['role']==='Admin'): ?>
			<a href="admin_usites/users.php">Dodaj użytkownika</a>
			<?php endif ?>
			<a href="admin_usites/items.php">Dodaj przedmiot</a>
	</div>
	<?php include($path.'sitefiles/messages.php') ?>
	<div id="tablediv">
		<h1>Nowo zarejestrowani użytkownicy(5 ostatnich)</h1>

			<?php if(empty($users)): ?>
				<h1>Brak użytkowników w bazie</h1>
			<?php else: ?>
				<table class="table">
					<thead>
						<th>Nr.</th>
                        <th>Nazwa użytkownika</th>
                        <th>Adres email</th>
						<th colspan="2">Action</th>
						<th>Stworzony:</th>
						<th>Ostatnio edytowany:</th>
					</thead>
					<tbody>
					<?php foreach ($users as $id => $user): ?>
						<tr>
							<td><?php echo $id + 1; ?></td>
							<td>
								<?php echo $user['username']; ?>
                            </td>
                            <td>
                                <?php echo $user['email']; ?>	
							</td>
							<td>
								<a class="" href="admin_usites/users.php?edit-user=<?php echo $user['id'] ?>">Edytuj</a>
							</td>
							<td>
								<a class="" href="admin_usites/users.php?delete-user=<?php echo $user['id'] ?>&user-role=<?php echo $user['role']; ?>">Usuń</a>
							</td>
							<td>
                                <?php echo $user['created_at']; ?>	
							</td>
							<td>
                                <?php echo $user['updated_at']; ?>	
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
				<?php endif; ?>

	</div>
	<div id="tablediv">
	<?php
		$users = getEmployees();
	?>
	<h1>Nowo stworzeni pracownicy(5 ostatnich)</h1>

	<?php if(empty($users)): ?>
		<h1>Brak użytkowników w bazie</h1>
	<?php else: ?>
		<table class="table">
			<thead>
				<th>Nr.</th>
				<th>Nazwa użytkownika</th>
				<th>Adres email</th>
				<th>Rola</th>
				<th colspan="2">Action</th>
				<th>Stworzony:</th>
				<th>Ostatnio edytowany:</th>
			</thead>
			<tbody>
			<?php foreach ($users as $id => $user): ?>
				<tr>
					<td><?php echo $id + 1; ?></td>
					<td>
						<?php echo $user['username']; ?>
					</td>
					<td>
						<?php echo $user['email']; ?>	
					</td>
					<td>
						<?php echo $user['role']; ?>
					</td>
					<td>
						<a class="" href="admin_usites/users.php?edit-user=<?php echo $user['id'] ?>">Edytuj</a>
					</td>
					<td>
						<a class="" href="admin_usites/users.php?delete-user=<?php echo $user['id'] ?>&user-role=<?php echo $user['role']; ?>">Usuń</a>
					</td>
					<td>
						<?php echo $user['created_at']; ?>	
					</td>
					<td>
						<?php echo $user['updated_at']; ?>	
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
		<?php endif; ?>
	</div>
	<div id="tablediv">
            <h1>Przedmioty(kobieta)(5 ostatnich)</h1>
			<?php 	$items = getAllItems(1);
					if (empty($items)): ?> <h1>Brak przedmiotów w bazie</h1>
			<?php   else: ?>
				<table>
					<thead>
						<th>Nr.</th>
                        <th>Nazwa przedmiotu</th>
                        <th>Rodzaj</th>
						<th>Koszt</th>
						<th>Ilość</th>
                        <th colspan="2">Akcja</th>
						<th>Stworzony:</th>
						<th>Ostatnio edytowany:</th>
					</thead>
					<tbody>
					<?php foreach ($items as $id => $item): ?>
						<tr>
							<td><?php echo $id + 1; ?></td>
							<td>
								<?php echo $item['name']; ?>
                            </td>
                            <td>
								<?php  
									for($i=0;$i<count($category);$i++){
										if($item['type']==$category[$i])
											echo $name[$i];
									}
								?>	
							</td>
							<td>
								<?php echo $item['cost']; ?>
							</td>
							<td>
								<?php echo $item['quantity']; ?>
							</td>
							<td>
								<a class="" href="admin_usites/items.php?edit-item=<?php echo $item['id']; ?>&isWoman=1">Edytuj</a>
							</td>
							<td>
								<a class="" href="admin_usites/items.php?delete-item=<?php echo $item['id']; ?>&isWoman=1">Usuń</a>
                            </td>
                            <td>
                                <?php echo $item['created_at']; ?>	
                            </td>
                            <td>
                                <?php echo $item['updated_at']; ?>	
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<div id="tablediv">
            <h1>Przedmioty(mężczyzna)(5 ostatnich)</h1>
			<?php 	$items = getAllItems(0);
					if (empty($items)): ?> <h1>Brak przedmiotów w bazie</h1>
			<?php   else: ?>
				<table>
					<thead>
						<th>Nr.</th>
                        <th>Nazwa przedmiotu</th>
                        <th>Rodzaj</th>
						<th>Koszt</th>
						<th>Ilość</th>
                        <th colspan="2">Akcja</th>
						<th>Stworzony:</th>
						<th>Ostatnio edytowany:</th>
					</thead>
					<tbody>
					<?php foreach ($items as $id => $item): ?>
						<tr>
							<td><?php echo $id + 1; ?></td>
							<td>
								<?php echo $item['name']; ?>
                            </td>
                            <td>
							   <?php  
									for($i=0;$i<count($category);$i++){
										if($item['type']==$category[$i])
											echo $name[$i];
									}
								?>	
							</td>
							<td>
								<?php echo $item['cost']; ?>
							</td>
							<td>
								<?php echo $item['quantity']; ?>
							</td>
							<td>
								<a class="" href="admin_usites/items.php?edit-item=<?php echo $item['id']; ?>&isWoman=0">Edytuj</a>
							</td>
							<td>
								<a class="" href="admin_usites/items.php?delete-item=<?php echo $item['id']; ?>&isWoman=0">Usuń</a>
                            </td>
                            <td>
                                <?php echo $item['created_at']; ?>	
                            </td>
                            <td>
                                <?php echo $item['updated_at']; ?>	
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
</div>

<?php include($path."sitefiles/footer.html"); ?>

</body>
</html>