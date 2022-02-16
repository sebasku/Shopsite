<?php
	session_start();
	$path="../../";

	require($path."config.php");
	require("../admin_sitefiles/admin_functions.php");
	
	$users = getUsers();
	$roles = ['Admin', 'Moderator', 'User'];

    require($path."sitefiles/header.php");

    if(empty($_SESSION['user']) || $_SESSION['role']!=='Admin'){
    	header('location: '.$path.'index.php');	
		exit();
	}
?>
<body>

<?php require($path."sitefiles/menu.php"); ?>
<script src="<?php echo $path;?>scripts/menucoll.js"></script>

<div id="items_container">
	<div id="adminpanel_links">
			<a href="../adminpanel.php">Wróć</a>
	</div>
	<?php include($path.'sitefiles/errors.php'); ?>
	<?php include($path.'sitefiles/messages.php') ?>
    <div id="admin_actionform">
			<?php if($isEditingUser === true): ?>
			<h1>Edytuj użytkownika</h1>
			<?php else: ?>
			<h1>Stwórz użytkownika</h1>
			<?php endif; ?>
			<form method="post" action="../admin_usites/users.php" >
                
				<?php if ($isEditingUser === true): ?>
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				<?php endif ?>

				<label>Nazwa użytkownika: <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Nazwa użytkownika"></label><br>
				<label>Adres email: <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Adres email"></label><br>
				<label>Hasło: <input type="password" name="password1" placeholder="Hasło"></label><br>
				<label>Ponów hasło: <input type="password" name="password2" placeholder="Ponów hasło"></label><br>
				<div id="form_bottom">
					<select name="role"><br>
						<option selected disabled>Nadaj rolę</option>
						<?php foreach ($roles as $role0): ?>
							<option value="<?php echo $role0; ?>"><?php echo $role0; ?></option>
						<?php endforeach; ?>
					</select>
					
					<?php if ($isEditingUser === true): ?> 
						<button type="submit" name="update_user">Zedytuj</button>
					<?php else: ?>
						<button type="submit" name="create_user">Stwórz</button>
					<?php endif; ?>
				</div>
			</form>	
	</div>
		<div id="tablediv">
            <h1>Użytkownicy</h1>
			<?php if (empty($users)): ?> <h1>Brak użytkowników w bazie</h1>
			<?php else: ?>
				<table>
					<thead>
						<th>Nr.</th>
                        <th>Nazwa użytkownika</th>
                        <th>Adres email</th>
                        <th colspan="2">Akcja</th>
						<th>Stworzony:</th>
						<th>Ostatnio edytowany:</th>
					</thead>
					<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo $user['id']; ?></td>
							<td>
								<?php echo $user['username']; ?>
                            </td>
                            <td>
                                <?php echo $user['email']; ?>	
							</td>
							<td>
								<a class="" href="users.php?edit-user=<?php echo $user['id']; ?>&user-role=User">Edytuj</a>
							</td>
							<td>
								<a class="" href="users.php?delete-user=<?php echo $user['id']; ?>&user-role=User">Usuń</a>
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
			<?php endif ?>
		</div>
		<div id="tablediv">
	<?php
		$users = getEmployees();
	?>
	<h1>Pracownicy</h1>

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
						<a class="" href="users.php?edit-user=<?php echo $user['id'] ?>&user-role=<?php echo $user['role']; ?>">Edytuj</a>
					</td>
					<td>
						<a class="" href="users.php?delete-user=<?php echo $user['id'] ?>&user-role=<?php echo $user['role']; ?>">Usuń</a>
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
</div>

<?php include($path."sitefiles/footer.html"); ?>

</body>
</html>