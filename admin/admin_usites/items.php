<?php
	session_start();
	$path="../../";
	require($path."config.php");
    require("../admin_sitefiles/admin_functions.php");
    require($path."sitefiles/header.php");

    if(empty($_SESSION['user']) || $_SESSION['role']=='User'){
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
		<div id="admin_actionitem">
            <?php if($isEditingItem === true): ?>
			<h1>Edytuj przedmiot</h1>
			<?php else: ?>
			<h1>Dodaj przedmiot</h1>
			<?php endif; ?>
			<div id="formp">
				<p>Nazwa przedmiotu:</p>
				<p>Ilość przedmiotu:</p>
				<p>Cena przedmiotu:</p>
				<p>Główne zdjęcie(~1140px x ~1520px):</p>
				<p>Miniaturka(~450px x ~600px):</p>
				<p>Opis przedmiotu:</p>
			</div>
			<form method="post" enctype="multipart/form-data" action="items.php" >
				<?php if ($isEditingItem === true): ?>
					<input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
					<input type="hidden" name="item_genderh" value="<?php echo $isWoman; ?>">
				<?php endif ?>
				<input type="text" name="item_name" value="<?php echo $item_name; ?>"><br>
				<input type="number" name="item_quantity" value="<?php echo $item_quantity; ?>"><br>
				<input type="number" name="item_cost" value="<?php echo $item_cost; ?>"><br>
				<input type="file" name="item_image"><br>
				<input type="file" name="item_miniature"><br>
				<textarea name="item_descr" id="body" cols="30" rows="10"><?php echo $item_descr; ?></textarea><br>
				<select name="isWoman"><br>
					<option value="" selected disabled>Wybierz płeć</option>
                    <?php for($i=0;$i<count($whopl);$i++): ?>
                        <option value="<?php echo $whoen[$i]; ?>"><?php echo $whopl[$i]; ?></option>
                    <?php endfor; ?>
                </select><br>
                <select name="item_category">
                    <option value="" selected disabled>Wybierz rodzaj</option>
                        <?php for($i=0;$i<count($category);$i++): ?>
                        <option value="<?php echo $category[$i]; ?>"><?php echo $name[$i]; ?></option>
                        <?php endfor; ?>
				</select><br>

				<?php if ($isEditingItem === true): ?> 
					<button type="submit" name="update_item">Zedytuj</button>
				<?php else: ?>
					<button type="submit" name="create_item">Zapisz</button>
				<?php endif ?>

			</form>
		</div>         
		<div id="tablediv">
            <h1>Przedmioty(kobieta)</h1>
			<?php 	$items = getAllItems(1);
					if (empty($items)): ?> <h1>Brak przedmiotów w bazie</h1>
			<?php   else: ?>
				<table>
					<thead>
						<th>id</th>
                        <th>Nazwa przedmiotu</th>
                        <th>Rodzaj</th>
						<th>Koszt</th>
						<th>Ilość</th>
                        <th colspan="2">Akcja</th>
						<th>Stworzony:</th>
						<th>Ostatnio edytowany:</th>
					</thead>
					<tbody>
					<?php foreach ($items as $item): ?>
						<tr>
							<td><?php echo $item['id']; ?></td>
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
								<a class="" href="items.php?edit-item=<?php echo $item['id']; ?>&isWoman=1">Edytuj</a>
							</td>
							<td>
								<a class="" href="items.php?delete-item=<?php echo $item['id']; ?>&isWoman=1">Usuń</a>
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
            <h1>Przedmioty(mężczyzna)</h1>
			<?php 	$items = getAllItems(0);
					if (empty($items)): ?> <h1>Brak przedmiotów w bazie</h1>
			<?php   else: ?>
				<table>
					<thead>
						<th>id</th>
                        <th>Nazwa przedmiotu</th>
                        <th>Rodzaj</th>
						<th>Koszt</th>
						<th>Ilość</th>
                        <th colspan="2">Akcja</th>
						<th>Stworzony:</th>
						<th>Ostatnio edytowany:</th>
					</thead>
					<tbody>
					<?php foreach ($items as $item): ?>
						<tr>
							<td><?php echo $item['id']; ?></td>
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
								<a class="" href="items.php?edit-item=<?php echo $item['id']; ?>&isWoman=0">Edytuj</a>
							</td>
							<td>
								<a class="" href="items.php?delete-item=<?php echo $item['id']; ?>&isWoman=0">Usuń</a>
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