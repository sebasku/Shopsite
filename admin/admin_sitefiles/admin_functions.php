<?php
$user_id = 0;
$isEditingUser = false;
$mainpanel = false;
$username = "";
$role = "";
$email = "";

//ZMIENNE DO PRZEDMIOTÓW
$item_id = 0;
$isEditingItem = false;
$item_name = "";
$item_descr = "";
$item_image = "";
$item_miniature = "";
$isWoman = "";
$item_category = "";
$item_quantity = 0;
$item_cost = 0;

$errors = [];

if(isset($_POST['create_user'])){
	createUser($_POST);
}

if(isset($_GET['edit-user'])){
	$isEditingUser = true;
	$user_id = $_GET['edit-user'];
	editUser($user_id);
}

if(isset($_POST['update_user'])){
	updateUser($_POST);
}

if(isset($_GET['delete-user'])){
	$user_id = $_GET['delete-user'];
	$user_role = $_GET['user-role'];
	deleteUser($user_id, $user_role);
}

//WYWOŁYWANIE FUNKCJI DO PRZEDMIOTÓW

if(isset($_POST['create_item'])){ 
	createItem($_POST); 
}

if(isset($_GET['edit-item'])){
	$isEditingItem = true;
	$item_id = $_GET['edit-item'];
	$isWoman = $_GET['isWoman'];
	editItem($item_id, $isWoman);
}

if(isset($_POST['update_item'])){
	updateItem($_POST);
}

if(isset($_GET['delete-item'])){
	$post_id = $_GET['delete-item'];
	$isWoman = $_GET['isWoman'];
	deleteItem($post_id, $isWoman);
}

function createUser($request_values){
	global $conn, $errors, $role, $username, $email;
	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$role = esc($request_values['role']);
	$password1 = esc($request_values['password1']);
	$password2 = esc($request_values['password2']);
    
    if(empty($username)) array_push($errors, "Nie podano nazwy użytkownika");
    if(empty($role)) array_push($errors, "Użytkownik musi mieć nadaną rolę");
	if(empty($email)) array_push($errors, "Nie podano adresu email");
	if(empty($role)) array_push($errors, "Nie wybrano roli użytkownika");
    if(empty($password1) || empty($password2)) array_push($errors, "Nie podano hasła");
    if($password1 != $password2) array_push($errors, "Podane hasła nie są zgodne");

	$usercheck = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $usercheck);

	if(mysqli_num_rows($result)<1){
		$sql = "SELECT * FROM employee WHERE username='$username' OR email='$email' LIMIT 1";
		$result = mysqli_query($conn, $sql);
	}

	$user = mysqli_fetch_assoc($result);
    if($user){
        if ($user['username'] === $username) array_push($errors, "Użytkownik o tej nazwie już istnieje");
        if ($user['email'] === $email) array_push($errors, "Ten adres email już został wykorzystany");
	}
	$_SESSION['message'] = $role;
	if(empty($errors)) {
		$password1 = md5($password1);

		if($role=='user'){
			$query = "INSERT INTO users (username, email, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$password1', now(), now())";
		}else{
			$query = "INSERT INTO employee (username, email, role, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$role', '$password1', now(), now())";
		}
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Użytkownik został utworzony";
		
		header('location: users.php');
		exit(0);
	}
}

function editUser($user_id){
	global $conn, $username, $role, $isEditingUser, $user_id, $email;

	$sql = "SELECT * FROM users WHERE id=$user_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)<1){
		$sql = "SELECT * FROM employee WHERE id=$user_id LIMIT 1";
		$result = mysqli_query($conn, $sql);
	}
	$user = mysqli_fetch_assoc($result);

	$username = $user['username'];
	$email = $user['email'];
}

function updateUser($request_values){
	global $conn, $errors, $role, $username, $isEditingUser, $admin_id, $email;
	$user_id = $request_values['user_id'];
	$isEditingUser = false;

	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password1 = esc($request_values['password1']);
	$password2 = esc($request_values['password2']);
	$role = $request_values['role'];
	
    if(isset($password1) && isset($password2))
    if($password2 !== $password2) array_push($errors, "Podane hasła nie są zgodne");
    if(!empty($password1) && empty($password2)) array_push($errors, "Nie podano potwierdzenia hasła");
	if(!empty($password2) && empty($password1)) array_push($errors, "Nie podano hasła");
	if(empty($role)) array_push($errors, "Nie wybrano roli użytkownika");
	if($role!=='User') if($user_id==1 || $user_id==3) array_push($errors, "Nie możesz modyfikować podstawowego konta administratora/moderatora");
	

	if(empty($errors)){
		if($role!=='User') $query = "UPDATE employee SET updated_at=now()";
		else $query = "UPDATE users SET updated_at=now()";
        if(!empty($username)) $query .= ', username="'.$username.'"';
        if(!empty($email)) $query .= ', email="'.$email.'"';
        if(!empty($password1) && !empty($password2)){
            $password1 = md5($password1);
            $query .= ', password="'.$password1.'"';
        }
        if(!empty($role) && $role!=='User') $query .= ', role="'.$role.'"';
        $query .= " WHERE id=$user_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Użytkownik został zedytowany";
		header('location: users.php');
		exit(0);
	}
}

function deleteUser($user_id, $role){
	global $conn, $errors;

	if($role!=='User'){
		if($user_id==1 || $user_id==3) array_push($errors, "Nie możesz usunąć podstawowego konta administratora/moderatora");
	}else{
		if($role!=='User'){
				$sql = "UPDATE products SET employee_id=1 WHERE employee_id=$user_id";
				mysqli_query($conn, $sql);
				$sql = "UPDATE products SET employee_id=1 WHERE employee_id=$user_id";
				mysqli_query($conn, $sql);
		}
		if($role=='User') $sql = "DELETE FROM user_cart WHERE user_id=$user_id";
		if(mysqli_query($conn, $sql)){
			if($role=='User') $sql = "DELETE FROM users WHERE id=$user_id";
			else $sql = "DELETE FROM employee WHERE id=$user_id";
			if(mysqli_query($conn,$sql)){
				$_SESSION['message'] = "Użytkownik został usunięty";
				header("location: users.php");
				exit(0);
			}
		}
	}
}

function getUsers(){
	global $conn, $mainpanel;

	if($_SESSION['role']!="Moderator"){
		$sql = "SELECT * FROM users";
		if($mainpanel===true) $sql.=" ORDER BY created_at DESC LIMIT 5";
		$result = mysqli_query($conn, $sql);
		$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

		return $users;
	}
}

function getEmployees(){
	global $conn, $mainpanel;

	if($_SESSION['role']!=="User"){
		$sql = "SELECT * FROM employee";
		if($mainpanel===true) $sql.=" ORDER BY created_at DESC LIMIT 5";
		$result = mysqli_query($conn, $sql);
		$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

		return $users;
	}
}

//FUNKCJE DO PRZEDMIOTÓW
function getAllItems($isWoman){
	global $conn, $mainpanel;

	$sql = 'SELECT products.*, product_type.product_type as type FROM products 
	LEFT JOIN product_type ON products.type_id=product_type.id WHERE isWoman='.$isWoman.'';

	if($_SESSION['role'] == "Moderator") {
		$employee_id = $_SESSION['id'];
		$sql .= " AND employee_id=$employee_id";
	}
	if($mainpanel===true) $sql.=" ORDER BY created_at DESC LIMIT 5";
	$result = mysqli_query($conn, $sql);
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_items = array();
	foreach ($items as $item) {
		$item['creator'] = getItemCreatorById($item['employee_id']);
		array_push($final_items, $item);
	}
	return $final_items;
}

function getItemCreatorById($employee_id){
	global $conn;
	$sql = "SELECT username FROM employee WHERE id=$employee_id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}

function createItem($request_values){
	global $conn, $errors, $item_name, $item_image, $item_miniature, $isWoman, $item_descr, $item_cost, $item_category, $item_quantity;
	$item_name = escit($request_values['item_name']);
	$item_descr = escit($request_values['item_descr']);
	$item_quantity = escit($request_values['item_quantity']);
	$item_cost = escit($request_values['item_cost']);
	$item_image = $_FILES['item_image']['name'];
	$item_miniature = $_FILES['item_miniature']['name'];

	if(isset($request_values['isWoman'])) {
		$isWoman = escit($request_values['isWoman']);
	}
	if(isset($request_values['item_category'])) {
		$item_category = escit($request_values['item_category']);
	}

	if(empty($item_name)) array_push($errors, "Wymagana nazwa przedmiotu");
	if(!is_numeric($item_quantity)) array_push($errors, "Wymagana ilość przedmiotu");
	if(!is_numeric($item_cost)) array_push($errors, "Wymagana cena przedmiotu");
	if(empty($item_descr)) array_push($errors, "Wymagany opis przedmiotu");
	if(empty($isWoman)) array_push($errors, "Wymagane wybranie płci");
	if(empty($item_category)) array_push($errors, "Wymagane wybranie kategorii przedmiotu");

	$itemcheck = "SELECT * FROM products WHERE name='$item_name' LIMIT 1";
	$result = mysqli_query($conn, $itemcheck);
	if(mysqli_num_rows($result)>0) array_push($errors, "Przedmiot o tej nazwie już istnieje w bazie");


	if(count($errors) == 0) {
		$type_id = getItemTypeId($item_category);
		$query = "INSERT INTO products (employee_id, name, isWoman, image, descr, cost, quantity, created_at, updated_at, type_id) 
				  VALUES(".$_SESSION['id'].", '$item_name',$isWoman, img1.jpg, '$item_descr', $item_cost, $item_quantity, now(), now(), $type_id)";
		mysqli_query($conn, $query);
		$_SESSION['message'] = "Przedmiot został utworzony";
		header('location: items.php');
		exit(0);	
	}
}

function getItemTypeId($type){
	global $conn;
	$query = 'SELECT id FROM product_type WHERE product_type="'.$type.'"';
	$result=mysqli_query($conn, $query);
	if ($result) {
		return mysqli_fetch_assoc($result)['id'];
	} else {
		return null;
	}
}

function editItem($item_id, $isWoman){
	global $conn, $item_name, $item_descr, $item_cost, $item_category, $item_quantity;
	$sql = "SELECT * FROM products WHERE id=$item_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$item = mysqli_fetch_assoc($result);

	$item_name = $item['name'];
	$item_descr = $item['descr'];
	$item_quantity = $item['quantity'];
	$item_cost = $item['cost'];
	$item_category = $item['type_id'];
}

function updateItem($request_values){
	global $conn, $errors, $item_name, $isWoman, $item_image, $item_miniature, $item_descr, $item_cost, $item_category, $item_quantity;

	$item_id = escit($request_values['item_id']);
	$item_name = escit($request_values['item_name']);
	$item_descr = escit($request_values['item_descr']);
	$item_quantity = escit($request_values['item_quantity']);
	$item_cost = escit($request_values['item_cost']);
	$item_gender_org = escit($request_values['item_genderh']);

	if(isset($request_values['item_category'])){
		$item_category = escit($request_values['item_category']);
	}

	if(isset($request_values['isWoman'])){
		$item_gender_new = escit($request_values['isWoman']);
	}
	if(empty($item_name)) array_push($errors, "Wymagana nazwa przedmiotu");
	if(!is_numeric($item_quantity)) array_push($errors, "Wymagana ilość przedmiotu");
	if(!is_numeric($item_cost)) array_push($errors, "Wymagana cena przedmiotu");
	if(empty($item_descr)) array_push($errors, "Wymagany opis przedmiotu");

	if(count($errors) == 0){
		$query = "UPDATE products SET name='$item_name', descr='$item_descr', updated_at=now(), quantity=$item_quantity, cost=$item_cost";
		if(!empty($item_category)){
			$type_id = getItemTypeId($item_category);
			$query .=", type_id='$type_id'";
		}
		$query .= " WHERE id=$item_id";
		mysqli_query($conn, $query);
		if(isset($item_gender_new) && $item_gender_new != $item_gender_org){
			
			$query = "UPDATE products SET isWoman=$item_gender_new WHERE id=$item_id";
			mysqli_query($conn, $query);
		}
	
		$_SESSION['message'] = "Przedmiot został zedytowany";
		header('location: items.php');
		exit(0);
	}
}

function deleteItem($item_id, $isWoman){
	global $conn;

	$sql = "DELETE FROM products WHERE id=$item_id LIMIT 1";
	if(mysqli_query($conn, $sql)) {
		$sql = "DELETE FROM user_cart WHERE product_id=$item_id";
		if(mysqli_query($conn,$sql)){
			$_SESSION['message'] = "Przedmiot został usunięty";
			header("location: items.php");
			exit(0);
		}
	}
}

function esc(String $clearsec){	
	global $conn;

	$clearsec = trim($clearsec);
	$clearsec = strtolower($clearsec);
	$clearsec = stripslashes($clearsec);
	$clearsec = strip_tags($clearsec);
	$clearsec = mysqli_real_escape_string($conn, $clearsec);
	
	return $clearsec;
}

function escit(String $clearsec){	
	global $conn;

	$clearsec = trim($clearsec);
	$clearsec = stripslashes($clearsec);
	$clearsec = strip_tags($clearsec);
	
	return $clearsec;
}
?>