<?php
$errors=array();

if(isset($_GET['add-item'])){
	$item_id=$_GET['add-item'];
	$isWoman=$_GET['isWoman'];
	addItemToCart($item_id, $isWoman);
}

if(isset($_GET['clear-cart'])){
	$user_id=$_GET['clear-cart'];
	ClearItemsFromCart($user_id);
}

if(isset($_GET['remove-cart'])){
	$item_id=$_GET['remove-cart'];
	$user_id=$_GET['user_id'];
	RemoveItemFromCart($item_id, $user_id);
}

if(isset($_GET['add-quantity'])){
	$item_id=$_GET['add-quantity'];
	$user_id=$_GET['user_id'];
	$item_quantity=$_GET['quantity'];
	AddItemQuantity($item_id, $user_id, $item_quantity);
}

if(isset($_GET['dec-quantity'])){
	$item_id=$_GET['dec-quantity'];
	$user_id=$_GET['user_id'];
	$item_quantity=$_GET['quantity'];
	DecItemQuantity($item_id, $user_id, $item_quantity);
}

if(isset($_GET['buy-confirmed'])){
	$user_id=$_SESSION['id'];
	ClearItemsFromCart($user_id);
}

function getItems($type,$isWoman){
	global $conn;
	
	$sql = 'SELECT products.*, product_type.product_type FROM products 
			LEFT JOIN product_type ON products.type_id=product_type.id';
	if($type!=='all'){
		$sql.=' WHERE product_type.product_type="'.$type.'"';
		if($isWoman) $sql.=" AND isWoman=1";
		else $sql.=" AND isWoman=0";
	}
	else{
		if($isWoman) $sql.=" WHERE isWoman=1";
		else $sql.=" WHERE isWoman=0";
	}
	
	$result = mysqli_query($conn, $sql);
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $items;
}

function getItem($id,$isWoman){
	global $conn;
	if($isWoman == 'all'){
		$sql = 'SELECT products.*, product_type.product_type FROM products 
		LEFT JOIN product_type ON products.type_id=product_type.id WHERE products.id='.$id.'';
	} else {
		$sql = 'SELECT products.*, product_type.product_type FROM products 
			LEFT JOIN product_type ON products.type_id=product_type.id WHERE products.isWoman='.$isWoman.' AND products.id='.$id.'';
	}
	$result = mysqli_query($conn, $sql);
	$item = mysqli_fetch_assoc($result);
		
	return $item;
}

function addItemToCart($item_id, $isWoman){
	global $conn, $errors;

	$sql = "SELECT id FROM products WHERE id=$item_id";
	$result = mysqli_query($conn, $sql);
	if(isset($_SESSION['id'])) $user_id=$_SESSION['id'];
	else array_push($errors, "Musisz być zalogowany by dodać przedmiot do koszyka");

	if(isset($_SESSION['role']) && ($_SESSION['role'] == 'User')) {}
	else array_push($errors, "Administrator i moderator nie może tworzyć koszyka");
	if(count($errors)==0){
		if(mysqli_num_rows($result)>0){
			$item = mysqli_fetch_assoc($result);
			$sql = 'SELECT * FROM user_cart WHERE user_id='.$user_id.' AND product_id='.$item['id'].'';
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0) array_push($errors, "Ten przedmiot już się znajduje w Twoim koszyku");
			else{
				$sql = "INSERT INTO user_cart (user_id, product_id, product_quantity) 
						VALUES($user_id, ".$item['id'].", 1)";
				if(mysqli_query($conn,$sql))
					$_SESSION['message']="Przedmiot został dodany do koszyka";
				
			}
		}
	}
}

function ShowItemsFromCart(){
	global $conn;

	$sql = "SELECT product_id, product_quantity FROM user_cart WHERE user_id=".$_SESSION['id']."";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result)>0){
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		$sql = "SELECT id, name, type_id, image, cost FROM products WHERE";
		foreach($items as $id => $item){
			if(mysqli_num_rows($result)==$id || $id==0) $sql .= " id=".$item['product_id']." ";
			else $sql .= "OR id=".$item['product_id']." ";
		}
		$result = mysqli_query($conn,$sql);
		$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $items;
	} else return false;
}

function GetQuantity($item_id, $user_id){
	global $conn;

	$sql = "SELECT product_quantity FROM user_cart WHERE product_id=$item_id AND user_id=$user_id";
	$result = mysqli_query($conn,$sql);
	$items = mysqli_fetch_assoc($result);

	return $items['product_quantity'];
}

function ClearItemsFromCart($user_id){
	global $conn;

	$sql = "DELETE FROM user_cart WHERE user_id=$user_id";
	if(mysqli_query($conn,$sql)){
		if(isset($_GET['buy-confirmed'])) $_SESSION['message']="Dziękujemy za zakup";
		else $_SESSION['message']="Przedmioty zostały usunięte z koszyka";
	}
}

function AddItemQuantity($item_id, $user_id, $item_quantity){
	global $conn;

	$item_quantity++;
	$sql = "UPDATE user_cart SET product_quantity=$item_quantity WHERE user_id=$user_id AND product_id=$item_id";
	mysqli_query($conn,$sql);
}

function DecItemQuantity($item_id, $user_id, $item_quantity){
	global $conn;

	$item_quantity--;
	if($item_quantity<1) $sql = "DELETE FROM user_cart WHERE product_id=$item_id AND user_id=$user_id";
	else $sql = "UPDATE user_cart SET product_quantity=$item_quantity WHERE user_id=$user_id AND product_id=$item_id";
	mysqli_query($conn,$sql);
}

function RemoveItemFromCart($item_id, $user_id){
	global $conn;

	$sql = "DELETE FROM user_cart WHERE product_id=$item_id AND user_id=$user_id";
	if(mysqli_query($conn,$sql)){
		$_SESSION['message']="Przedmiot został usunięty z koszyka";
	}
}

?>