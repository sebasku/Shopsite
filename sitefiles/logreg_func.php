<?php 
	$username = "";
	$email = "";
	$errors = array(); 

if(isset($_POST['reg_user'])){
	$username = esc($_POST['username']);
	$email = esc($_POST['email']);
	$password1 = esc($_POST['password1']);
	$password2 = esc($_POST['password2']);

	if(empty($username)) array_push($errors, "Nie podano nazwy użytkownika");
	if(empty($email)) array_push($errors, "Nie podano adresu email");
	if(empty($password1) || empty($password2)) array_push($errors, "Nie podano hasła");
	if($password1 != $password2) array_push($errors, "Podane hasła nie są zgodne");

	$usercheck = "SELECT username, email FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $usercheck);
	$user = mysqli_fetch_assoc($result);
	if($user){
		if($user['username'] === $username) array_push($errors, "Użytkownik o tej nazwie już istnieje");
		if($user['email'] === $email) array_push($errors, "Ten adres email już został wykorzystany");
    }
        
	if(empty($errors)){
		$password = md5($password1);
		$query = "INSERT INTO users (username, email, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$password', now(), now())";
		mysqli_query($conn, $query);
		$reguserid = mysqli_insert_id($conn);
		setUserInfo($reguserid);
		$_SESSION['message'] = "Zostałeś zarejestrowany i zalogowany!";

		header('location: '.$path.'index.php');				
		exit(0);
	}
}

if(isset($_POST['log_user'])) {
	$username = esc($_POST['username']);
	$password = esc($_POST['password']);

	if(empty($username)) array_push($errors, "Nie podano nazwy użytkownika");
	if(empty($password)) array_push($errors, "Nie podano hasła użytkownika");

	if(empty($errors)){
		$password = md5($password);
		$sql = "SELECT id, username FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result)<1){
			$sql = "SELECT id, username, role FROM employee WHERE username='$username' AND password='$password' LIMIT 1";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result)<1) array_push($errors, 'Podano błędny login lub hasło');
		}else if(mysqli_num_rows($result)==1){}
		else array_push($errors, 'Podano błędny login lub hasło');

		if(mysqli_num_rows($result)>0){
			$user = mysqli_fetch_assoc($result);

			$_SESSION['id'] = $user['id'];
			$_SESSION['user'] = $user['username'];
			if(isset($user['role'])){
				$_SESSION['role'] = $user['role'];
			} else {
				$_SESSION['role'] = 'User';
			}
			
			$_SESSION['message'] = "Zostałeś zalogowany";

			header('location: '.$path.'index.php');				
			exit(0);
	
		} else array_push($errors, 'Podano błędny login lub hasło');
	}
}
    
function esc(String $clearsec){	
	global $conn;

	$clearsec = trim($clearsec);
	$clearsec = strtolower($clearsec);
	$clearsec = stripslashes($clearsec);
	$clearsec = strip_tags($clearsec);

	return $clearsec;
}
 
function setUserInfo($id){
	global $conn;
	$sql = "SELECT id, username FROM users WHERE id=$id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$user = mysqli_fetch_assoc($result);
	if(!$user){
		$sql = "SELECT id, username, role FROM employee WHERE id=$id LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $user['id'];
		$_SESSION['user'] = $user['username'];
		$_SESSION['role'] = $user['role'];
	}else{
		$_SESSION['id'] = $user['id'];
		$_SESSION['user'] = $user['username'];
		$_SESSION['role'] = 'User';
	}
}
?>