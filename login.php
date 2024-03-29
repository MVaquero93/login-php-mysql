<?php

session_start();
require_once "inc/config.inc.php";

$email = '';
$password = '';
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['password']);
	
	//validation	
	if(empty($email)) {
		$errors[] = "Email field is required"; 
	}
	if(empty($password)) {
		$errors[] = "Password field is required"; 
	}
	
	//If no error do query
	if(empty($errors)) {
		$sth = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
		$sth->bindParam(':email', $email, PDO::PARAM_STR);
		$sth->execute();
		$user = $sth->fetch(PDO::FETCH_OBJ);
		if(!empty($user)) {
			//Verifying the password
			$hashedPwdDB = $user->password;
			if (password_verify($password, $hashedPwdDB)) {
				$_SESSION['id'] =  $user->id;
				$_SESSION['name'] = $user->name;
				$_SESSION['email'] = $user->email;
				header("Location:dashboard.php");
				exit;
			}	
			else {
				$errors[] = "Invalid login"; 
			}	
			
		}
		else {
			$errors[] = "Invalid login"; 
		}
	}
	
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
 	<script src="js/jquery.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="css/all.css" rel="stylesheet"  integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
    
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="">
				<div class="d-flex justify-content-center">
	
						<img src="img/logo.jpg" alt="Logo">

				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="post">
					    <?php if(!empty($errors)):?>
						<div class="alert alert-danger">
						<?php foreach($errors as $error):?>
						<?php echo $error,"<br>";?>
						<?php endforeach;?>
						<?php endif;?>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="email" class="form-control" value="" placeholder="email">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control" value="" placeholder="password">
						</div>			
						<button type="submit" name="button" class="btn-block mt-3 btn btn-warning"><span style="color:white; font-weight:600">Login</span></button>
					</form>
				</div>				
			</div>
		</div>
	</div>
</body>
</html>